@extends('layouts.app')

@section('title', 'Ventes |')

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
<style>
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
</style>
@endpush


@section('content')
<div class="app-content-header">
    <!-- begin::Row -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Ventes</h3>
                <h5 class="mb-0">Bilan des ventes</h5>
            </div>
            <div class="col-sm-6">
                <div class="mb-3 mt-3 row">
                    {{-- <div class="col-sm-10" style="transform: translate(60px)">
                        <input type="text" class="form-control" placeholder="Rechercher..." id="inputPassword">
                    </div> --}}
                </div>
                <ol class="breadcrumb float-sm-center">
                    {{-- <label for="exampleDataList" class="form-label">Filtre</label>
                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Rechercher..."> 
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword">
                        </div>
                    </div> 
                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Dashboard
                    </li> --}}
                </ol>
            </div>
        </div>
    </div> <!-- end::Row -->
</div>
<div class="app-content" >
    @if ($errors->any())
            <div class="alert alert-danger bg-opacity-15">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->

            <table id="Table" class="table table-bordered ">
                <thead>
                    <tr>
                        <th>Nom du produit</th>
                        <th>Entreprises</th>
                        <th>Manager</th>
                        <th>Quatité vendu</th>
                        <th>Prix unitaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($sales as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->business->name }}</td>
                        <td>{{ $item->manager->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->amount_received }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="openUpdateModal({{ $item->id }})"  class="btn btn-outline-success btn-sm">
                                <i class="bi bi-pencil-square"></i> Modifier
                                
                            </a>
                            <a onclick="return confirm('Voulez-vous supprimer cette vente ?')" href="{{ route('admin.sale.delete', $item->id) }}" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash"></i> Supprimer
                            </a>
                        </td> 
                    </tr>
                @endforeach
                </tbody>
            </table>
        
        <!--begin::Row-->
    </div>

    @include('admin.sales.modals.update-sale')

    <!--end::Container-->
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js"></script>
<script src="{{ asset('admin/js/sweetalert2@11.js') }}"></script>
<script>
    let get_sale_route = "{{ route('admin.sale.get-by-ajax') }}";

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

        
    function openUpdateModal(sale_id) {
        $('#updateSaleProductForm').trigger('reset');
        // $('#sale_id').val(sale_id);
        console.log(sale_id);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: get_sale_route+"?item_id="+sale_id,
            success: function(result) {
                console.log(result);
                
                if (result.action == true) {

                    $('#code').val(result.data.code);
                    $('#quantity').val(result.data.quantity);
                    $('#amount_received').val(result.data.amount_received);
                    $('#sale_id').val(result.data.id);

                } else {
                    // toastr.error(result.message);
                    console.log('No data find...');
                    
                }
            },
            error: (e) => {
                console.log(e);
                console.log(e.responseJSON);
            }
        });
        
        $('#saleUpdateModal').modal('show');
    }

    $('#saleProductBtn').on('click', function (e) {
        e.preventDefault();

        const form = $('#updateSaleProductForm')[0];

        if (form.reportValidity()) {
            $('#updateSaleProductForm').submit();
        } else {
            form.reportValidity();
        }
    });

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

    function get_item(url, item_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: url+"?item_id="+item_id,
            success: function(result) {
                console.log(result);
                if (result.action == true) {

                    $('#titleU').val(result.data.title);
                    $('#iconU').val(result.data.icon);
                    $('#descriptionU').val(result.data.description);

                } else {
                    toastr.error(result.message);
                }
            },
            error: (e) => {
                console.log(e);
                console.log(e.responseJSON);
            }
        });
    }

</script>
@endpush