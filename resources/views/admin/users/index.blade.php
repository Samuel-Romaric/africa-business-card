@extends('layouts.app')

@section('title', 'Commerciaux |')

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
<style>
    /* Bordure externe du tableau */
    #Table.table.dataTable {
        border: 1px solid #dee2e6; /* Gris clair */
        border-radius: 45px; /* Coins légèrement arrondis */
        /*overflow: hidden;  Évite les débordements */
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

    .dt-search {
        margin-bottom: 12px;
    }

    .card-title {
        font-weight: bold
    }

    .location {
        font-style: italic;
        font-size: 12px;
        color: rgb(152, 153, 153);
    }

    .business {
        /* font-style: italic; */
        margin-top: 5px;
        font-size: 15px;
        color: rgb(152, 153, 153);
    }

    .size-10 {
        color: #bdbdbd;
        height: 2px;
    }

    .avatar {
        border: 0.5px solid rgb(211, 200, 200);
    }

    .sub-info {
        color: #8c8c8c;
    }

    .btn-dots-action {
        cursor: pointer;
    }

    .sub-info-size {
        font-size: 15px;
    }

    .status-success {
        border: 0.5px solid #ddfff3;
        color: #0fac82; /** #3dc094; /** #58be9c */
        background-color: #ddfff3;
        padding: 1.5px 10px 1.5px 10px;
        border-radius: 50px;
        font-weight: bold;
    }

    .status-danger {
        border: 0.5px solid #fff1e8;
        color: #e34d2f; /** #ea745c */
        background-color: #fff1e8;
        padding: 1.5px 10px 1.5px 10px;
        border-radius: 50px;
    }

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

    .status-size {
        font-size: 40px;
    }

    .dot-action-rounde {
        background-color: #f4f3f3;
        padding: 0.8px 4.5px 0.8px 4.5px;
        border-radius: 50%;
        color: #8c8c8c;
    }
</style>
@endpush


@section('content')
<div class="app-content-header">
    <!-- begin::Row -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Utilisateurs</h3>
                <h5 class="mb-0">Liste des utilisateurs</h5>
            </div>
            <div class="col-sm-6">
                <div class="mb-3 mt-3 row">
                    {{-- <div class="col-sm-10" style="transform: translate(60px)">
                        <input type="text" class="form-control" placeholder="Rechercher..." id="inputPassword">
                    </div> --}}
                </div>
                <ol class="breadcrumb float-sm-end" >
                    <div class="mb-3 mt-3 row">
                        <div class="col-sm-12">
                            <a href="{{ route('admin.user.add-form') }}" class="btn btn-primary"><i class="bi bi-person-plus"></i> Ajouter utilisateur</a>
                        </div>
                    </div>
                    
                </ol>
            </div>
        </div>
    </div> <!-- end::Row -->
</div>
<div class="app-content" >
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->

        {{-- <div class="row g-4">
            @forelse ($commerciaux as $item)
                <div class="col-md-4">
                    <div class="card border-primary mb-3" style="max-width: 18rem;">
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="card-header">
                            Header
                        </div>
                        <div class="card-body">
                            <div class="btn-group" style="position: absolute; right: 10px; cursor: pointer">
                                <div class="btn-dots-action dot-action-rounde" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-primary" href="{{ route('admin.commercial.show', $item->user->id) }}"><i class="bi bi-eye"></i> Voir detail</a></li>
                                    <li><a class="dropdown-item {{ $item->user->isBlocked() ? 'text-success' : 'text-danger' }}" onclick="return confirm('Voulez-vous bloquer cet utilisateur ?')" href="{{ route('admin.commercial.blocked', $item->user->id) }}">
                                            {!! $item->user->isBlocked() ? '<i class="bi bi-unlock"></i> Débloquer' : '<i class="bi bi-lock"></i> Bloquer'!!} 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                  <img src="{{ $item->getAvatarFullUrl() }}" alt="User Avatar" class="img-size-50 rounded-circle me-3 avatar-border">
                                </div>
                                <div class="flex-grow-1" style="margin-top: 8px">
                                    <h3 class="dropdown-item-title">
                                        {{ $item->user->firstname }} {{ $item->user->name }}
                                    </h3>
                                    <p class="fs-7">
                                        <span class="sub-info">@commercial_{{ $item->type }}</span> <span class="{{ $item->user->getStatusClass() }} status-size-12"><i class="bi bi-patch-{{ $item->user->isBlocked() ? 'exclamation' : 'check' }}"></i> {{ $item->user->getStatus() }}</span>
                                    </p>
                                </div>
                            </div>
                            <hr style="color: rgb(184, 184, 184); margin-top: -4px; margin-bottom: 6px;">
                            <p class="card-text text-secondary">
                                <i class="bi bi-person-circle"></i> {{ $item->user->code }} <br>
                                <i class="bi bi-envelope-at"></i> {{ $item->user->email }} <br>
                                <i class="bi bi-telephone"></i> {{ $item->user->telephone }} <br>
                                <i class="bi bi-whatsapp"></i> {{ $item->user->whatsapp }} <br>
                                <i class="bi bi-geo"></i> {{ $item->user->pays }}, {{ $item->user->ville }} <br>
                            </p>
                        </div>
                      </div>
                </div>
            @empty
                <div class="col-lg-12">
                    <div class="text-center py-5">
                        <p><img src="{{ asset('/admin/assets/img/research-paper.png') }}" style="height: 100px" alt="" srcset=""></p>
                        <p class="text-gray" style="color: #a9a8a8">Aucun manager pour l'instant</p>
                    </div>
                </div>
            @endforelse

            @if (!empty($commerciaux))
                <div class="col-lg-12" style="margin-top: 30px;">
                    <div>
                        {{ $commerciaux->links('vendor.pagination.bootstrap-5-fr') }}
                    </div>
                </div>
            @endif
        </div> --}}

        {{-- @php
            $i = 1
        @endphp --}}

            <table id="Table" class="table table-hover">
                <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Profile utilisateur</th>
                        <th>Téléphone</th>
                        <th>Privilèges</th>
                        <th>Statut</th>
                        <th>Dernière modif</th>
                        <th>Date d'ajoute </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $item)
                    <tr>
                        {{-- <td>{{ $i++ }}</td> --}}
                        <td>
                            <div class="d-flex" style="justify-content: center;">
                                <div class="flex-shrink-0">
                                  <img src="{{ $item->getAvatarFullUrl() }}" alt="User Avatar" class="img-size-50 rounded-circle me-3 avatar" style="height: 50px; width: 50px;">
                                </div>
                                <div class="flex-grow-1" style="margin-top: 8px">
                                    <h3 class="dropdown-item-title">
                                        {{ $item->getFullName() }}
                                    </h3>
                                    <p class="fs-7">
                                        <span class="sub-info">{{ $item->email }}</span>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->telephone }}</td>
                        <td>{{ $item->getPrivilege() }}</td>
                        <td>
                            <span class="status {{ $item->getStatusClass() }}"><i class="bi bi-record-fill" style="font-size: 10px"></i> {{ $item->getStatus() }}</span>
                        </td>
                        <td>{{ $item->updated_at->format('d M Y') }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <div class="btn-dots-action" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-muted" href="{{ route('admin.user.show', ['user_id' => $item->id, 'slug' => $item->slug]) }}"><i class="bi bi-person"></i> Afficher Profile</a></li>
                                    {{-- <li><a class="dropdown-item text-warning" href="{{ route('admin.user.show', ['user_id' => $item->id, 'slug' => $item->slug]) }}"><i class="bi bi-arrow-repeat"></i> Reinitialiser</a></li>       --}}
                                    </li>
                                    <li><a class="dropdown-item {{ $item->isBlocked() ? 'text-success' : 'text-danger' }}" onclick="return confirm('Voulez-vous bloquer cet utilisateur ?')" href="{{ route('admin.user.blocked', $item->id) }}">
                                            {!! $item->isBlocked() ? '<i class="bi bi-unlock"></i> Débloquer' : '<i class="bi bi-lock"></i> Bloquer'!!} 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        
        <!--begin::Row-->
    </div>

    {{-- @include('admin.sales.modals.update-sale') --}}

    <!--end::Container-->
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js"></script>
{{-- <script src="{{ asset('admin/js/sweetalert2@11.js') }}"></script> --}}
<script>
    // let get_sale_route = "{{-- route('admin.sale.get-by-ajax') --}}";

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

        
    // function openUpdateModal(sale_id) {
    //     $('#updateSaleProductForm').trigger('reset');
    //     // $('#sale_id').val(sale_id);
    //     console.log(sale_id);
        
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type: "GET",
    //         url: get_sale_route+"?item_id="+sale_id,
    //         success: function(result) {
    //             console.log(result);
                
    //             if (result.action == true) {

    //                 $('#code').val(result.data.code);
    //                 $('#quantity').val(result.data.quantity);
    //                 $('#amount_received').val(result.data.amount_received);
    //                 $('#sale_id').val(result.data.id);

    //             } else {
    //                 // toastr.error(result.message);
    //                 console.log('No data find...');
                    
    //             }
    //         },
    //         error: (e) => {
    //             console.log(e);
    //             console.log(e.responseJSON);
    //         }
    //     });
        
    //     $('#saleUpdateModal').modal('show');
    // }

    // $('#saleProductBtn').on('click', function (e) {
    //     e.preventDefault();

    //     const form = $('#updateSaleProductForm')[0];

    //     if (form.reportValidity()) {
    //         $('#updateSaleProductForm').submit();
    //     } else {
    //         form.reportValidity();
    //     }
    // });

    // function deleteItem(item_id) {
    //     if (item_id != "") {
    //         Swal.fire({
    //             title: 'Voulez vous bloquer ce commentaire?',
    //             icon: 'warning',
    //             showCloseButton: true,
    //             showCancelButton: true,
    //             confirmButtonText: 'Oui',
    //             cancelButtonText: 'Non',
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 _sendRequest(url_make_action, item_id, 'POST');
    //             }
    //         });
    //     }
    // }

</script>
@endpush