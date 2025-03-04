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

    .size-10 {
        color: #bdbdbd;
        height: 2px;
    }

    .avatar-border {
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
        color: #3dc094; /** #58be9c */
        background-color: #ddfff3;
        padding: 1.5px 18px 1.5px 18px;
        border-radius: 50px;
    }

    .status-danger {
        border: 0.5px solid #fff1e8;
        color: #e34d2f; /** #ea745c */
        background-color: #fff1e8;
        padding: 1.5px 12px 1.5px 12px;
        border-radius: 50px;
    }

    .status-size-12 {
        font-size: 12px;
    }

    .position-relative-left{
        position: absolute;
        top: 20px;
        left: 89%;
    }
</style>
@endpush


@section('content')
<div class="app-content-header">
    <!-- begin::Row -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Commercial</h3>
                <h5 class="mb-0">Information sur le commercial</h5>
            </div>
            <div class="col-sm-6">
                <div class="mb-3 mt-3 row">
                    {{-- <div class="col-sm-10" style="transform: translate(60px)">
                        <input type="text" class="form-control" placeholder="Rechercher..." id="inputPassword">
                    </div> --}}
                </div>
                <ol class="breadcrumb float-sm-center">
                    {{-- <li class="breadcrumb-item"><a href="#">Retour</a></li> --}}
                    {{-- <li class="breadcrumb-item active" aria-current="page">
                        Dashboard
                    </li>  --}}
                </ol>
            </div>
        </div>
    </div> <!-- end::Row -->
</div>
<div class="app-content" >
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
         
        {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> --}}
        
        <div class="card" style="width: 100%; margin-top: 0px">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="{{ $user->getAvatarFullUrl() }}" class="img-size-50 rounded-circle me-3 avatar-border" style="height: 80px; width: auto;">
                    </div>
                    <div class="flex-grow-1" style="margin-top: 20px">
                        <h3 class="dropdown-item-title" style="font-size: 20px;">
                            {{ $user->firstname }} {{ $user->name }} <span class="{{ $user->getStatusClass() }} status-size-12"><i class="bi bi-patch-{{ $user->isBlocked() ? 'exclamation' : 'check' }}"></i> {{ $user->getStatus() }}</span>
                        </h3>
                        <p class="fs-7">
                            <span class="sub-info">{{ \Str::ucfirst($user->role) }}<i class="bi bi-dot"></i>{{ \Str::ucfirst($user->commercial->type) }}</span> 
                        </p>
                    </div>
                </div>

                <div class="position-relative-left">
                    <a href="{{ route('admin.commerciaux.index') }}" class="btn btn-outline-secondary"><i class="bi bi-reply"></i> Retour </a>
                </div>

                <hr style="color: rgb(184, 184, 184)">

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-dot"></i>Information Générale</h6>
                        <div class="row">
                            <div class="col-md-4 text-muted">
                                {{-- <i class="bi bi-person-circle"></i> Identifiant <br> --}}
                                <i class="bi bi-person-badge"></i> Identifiant <br>
                                <i class="bi bi-person-vcard"></i> Nom complet <br>
                                <i class="bi bi-envelope-at"></i> Adresse email <br>
                                <i class="bi bi-phone"></i> Téléphone <br>
                                <i class="bi bi-whatsapp"></i> WhatsApp <br>
                                <i class="bi bi-calendar-date"></i> Né le  <br>
                            </div>
                            <div class="col-md-8">
                                {{ $user->code }} <br>
                                {{ $user->name }} <br>
                                {{ $user->email }} <br>
                                {{ $user->telephone }} <br>
                                {{ $user->whatsapp }} <br>
                                {{ $user->date_naissance }} <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-dot"></i>Information secondaire</h6>
                        <div class="row">
                            <div class="col-md-4 text-muted">
                                <i class="bi bi-mortarboard"></i> Diplôme <br>
                                <i class="bi bi-patch-check"></i> Grade <br>
                                <i class="bi bi-globe-europe-africa"></i> Pays <br>
                                <i class="bi bi-geo"></i> Ville <br>
                                <i class="bi bi-signpost"></i> Departement <br>
                                <i class="bi bi-briefcase"></i> Secteur <br>
                            </div>
                            <div class="col-md-8">
                                {{ $user->diplome }} <br>
                                {{ \Str::ucfirst($user->commercial->type) }} <br>
                                {{ $user->pays }} <br>
                                {{ $user->ville }} <br>
                                {{ $user->departement }} <br>
                                {{ $user->getAtivitySector()->titre }} <br>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="color: rgb(184, 184, 184)">
                <div class="row pt-3">
                    <div class="col-md-12">
                        <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-dot"></i>Description</h6>
                        <p>
                            {{ $user->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!--begin::Row-->
    </div>

    <!--end::Container-->
</div>

@endsection

@push('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
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

</script> --}}
@endpush