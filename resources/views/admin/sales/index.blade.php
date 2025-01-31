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
                        <th>Quatité vendu</th>
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
                            <a href="javascript:void(0)" onclick=""  class="btn btn-outline-success btn-sm">
                                <i class="bi bi-pencil-square"></i> Modifier
                                {{-- openUpdateModal({{ $item->id }}) --}}
                            </a>
                            <a onclick="" href="javascript:void(0)" class="btn btn-outline-danger btn-sm">
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
<script>
    let update_sale_route = "{{ route('admin.sales.show', $item->id) }}";

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

        
    function openUpdateModal(product_id) {
        $('#updateSaleProductForm').trigger('reset');
        $('#product_id').val(product_id);
        
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

</script>
@endpush