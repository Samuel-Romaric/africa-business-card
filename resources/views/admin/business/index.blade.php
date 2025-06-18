@extends('layouts.app')

@section('title', 'Entreprise |')

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
<style>

    /* Bordure externe du tableau */
    #Table.table.dataTable {
        border: 1px solid #dee2e6; /* Gris clair */
        border-radius: 45px; /* Coins légèrement arrondis */
        border-collapse: collapse; /* Éviter les espaces entre les bordures */
        width: 100%; /* Assurer une bonne mise en page */
    }

    /* Lignes internes entre les rangées */
    .table.dataTable tbody tr {
        border-bottom: 1px solid #ebeaea; /* Gris clair */
        /* border-bottom: 1px solid #dee2e6; Gris clair */
    }

    /* Effet hover léger */
    .table.dataTable tbody tr:hover {
        background-color: #f8f9fc; /* Gris clair au survol */
    }

    /* Alignement des en-têtes */
    .table.dataTable thead th {
         background-color: #0a0a33;/* Bleu foncé comme sur ton image */
        /* background-color: #e4e4e4;  */
        color: #ececfc;
        text-align: left;
    }

    /* Espacement et padding pour un rendu propre */
    .table.dataTable th, .table.dataTable td {
        padding: 10px 15px;
    }

    /************ Old CSS  **********/
    .table th, .table td {
        vertical-align: middle;
    }

    .table.table.dataTable{
        margin-bottom: 10px;
    }
    /* .table-bordered {
        border-color: #efefef;
    } */

    .dt-search {
        margin-bottom: 12px;
    }

    

    .badge-status {
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 12px;
    }

    /* .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: black;
    } */


    .status {
        padding: 1.5px 15px 1.5px 15px;
        border-radius: 30px;
        font-size: 15px;
        align-items: center;
        font-weight: bold;
    }

    .status2-success {
        color: #0fac82;
        /* background-color: #ddfff3; */
    }

    .status2-warning {
        color: #ff9b00;
        /* background-color: #fef7ea;* #fbe8ca; */
    }

    .status2-danger {
        color: #cf2213;
        /* background-color: #fdc5c5; */
    }
</style>
@endpush


@section('content')
<div class="app-content-header">
    <!-- begin::Row -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Entreprise</h3>
                <h5 class="mb-0">Liste des entreprises</h5>
            </div>
            <div class="col-sm-6">
                {{-- <ol class="breadcrumb float-sm-center">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Dashboard
                    </li> 
                </ol> --}}
            </div>
        </div>
    </div> <!-- end::Row -->
</div>

<div class="app-content" >
    <!--begin::Container-->
    <div class="container-fluid">
        
        <!--begin::Row-->
        <table id="Table" class="table table-hover">
            <thead class="">
                <tr>
                    <th>Entreprise</th>
                    <th>Secteur d'activité</th>
                    <th>Régistre de commerce</th>
                    <th>Offres</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="">
            @foreach($businesses as $item)
                <tr>
                    <td>
                        <div class="d-flex" style="justify-content: center;">
                            <div class="flex-shrink-0">
                                <a href="{{ route('admin.business.offers.show', ['item_id' => $item->id, 'slug' => $item->slug]) }}"><img src="{{ $item->getBusinessLogoFullUrl() }}" alt="Business Logo" class="img-size-50 rounded me-3" style="height: 50px; width: 50px; border: 1px solid #eeeeee"></a>
                            </div>
                            <div class="flex-grow-1" style="margin-top: 8px">
                                <h3 class="dropdown-item-title">
                                    {{ $item->nom_commercial }}
                                </h3>
                                <p class="fs-7 text-muted">
                                    <span class="sub-info">{{ $item->user->telephone }}</span>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $item->getActivitySectorTitle() }} <br> <span class="text-muted">{{ $item->getSubActivitySector()->titre }}</span></td>
                    <td class="text-muted">{{ $item->num_rccm }}</td>
                    <td class="text-muted">{{ $item->getTotalOffer() }}</td>
                    <td>{!! $item->isBlocked() ? '<span class="status status2-danger"><i class="bi bi-record-fill" style="font-size: 10px"></i> Bloqué</span>' : '<span class="status status2-success"><i class="bi bi-record-fill" style="font-size: 10px"></i> Actif</span>' !!}</td>
                    {{-- <td>{!! $item->isBlocked() ? '<span class="badge text-bg-danger">Bloqué</span>' : '<span class="badge text-bg-success">Actif</span>' !!}</td> --}}
                    <td>
                        <a href="{{ route('admin.business.offers.show', ['item_id' => $item->id, 'slug' => $item->slug]) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-cart3"></i> 
                        </a>
                        @if ($item->isBlocked())
                        <a onclick="return confirm('Voulez-vous vraiment débloquer cette entréprise ?')" href="{{ route('admin.business.blocked', ['item_id' => $item->id, 'slug' => $item->slug]) }}" class="btn btn-success btn-sm">
                            <i class="bi bi-unlock"></i> 
                        </a>
                        @else
                        <a onclick="return confirm('Voulez-vous vraiment bloquer cette entréprise ?')" href="{{ route('admin.business.blocked', ['item_id' => $item->id, 'slug' => $item->slug]) }}" class="btn btn-danger btn-sm">
                            <i class="bi bi-lock"></i> 
                        </a>
                        @endif
                    </td> 
                </tr>
            @endforeach
            </tbody>
        </table>
       
    </div>
    <!--end::Container-->
</div>

@endsection


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });
    });

    // function _isDelete(item_id) {
    //     if (item_id != "") {
    //         Swal.fire({
    //             title: 'Voulez vous supprimer ce slide?',
    //             icon: 'warning',
    //             showCloseButton: true,
    //             showCancelButton: true,
    //             confirmButtonText: 'Oui',
    //             cancelButtonText: 'Non',
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 _sendRequest(url_delete, item_id, 'POST');
    //             }
    //         });
    //     }
    // }
</script>
@endpush