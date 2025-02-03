@extends('layouts.app')

@section('title', 'Entreprise |')

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
<style>
    .table th, .table td {
        vertical-align: middle;
    }

    /* table.table.dataTable{
        margin-bottom: 10px;
    } */
    .table-bordered {
        border-color: #efefef;
    }

    .dt-search {
        margin-bottom: 12px;
    }

    .badge-status {
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 12px;
    }

    .badge-success {
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
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="">
                        </div>
                    </div>
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
        <table id="Table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Secteur d'activité</th>
                    <th>Régistre de commerce</th>
                    <th>Nombre d'offre</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($businesses as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->activity }}</td>
                    <td>{{ $item->commercial_registrar }}</td>
                    <td>{{ $item->getTotalProduct() }}</td>
                    <td>{!! $item->isBlocked() ? '<span class="badge text-bg-danger">Bloqué</span>' : '<span class="badge text-bg-success">Actif</span>' !!}</td>
                    <td>
                        <a href="{{ route('admin.business.show', ['item_id' => $item->id, 'slug' => $item->slug]) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye"></i> Voir
                        </a>
                        @if ($item->isBlocked())
                        <a onclick="return confirm('Voulez-vous vraiment débloquer cette entréprise ?')" href="{{ route('admin.business.blocked', ['item_id' => $item->id, 'slug' => $item->slug]) }}" class="btn btn-success btn-sm">
                            <i class="bi bi-unlock"></i> Débloquer
                        </a>
                        @else
                        <a onclick="return confirm('Voulez-vous vraiment bloquer cette entréprise ?')" href="{{ route('admin.business.blocked', ['item_id' => $item->id, 'slug' => $item->slug]) }}" class="btn btn-danger btn-sm">
                            <i class="bi bi-lock"></i> Bloquer
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