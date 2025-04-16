@extends('layouts.app')

@section('title', 'Profile utilisateur |')

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
<style>
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


    

    .position-relative-left{
        position: absolute;
        top: 20px;
        left: 95%;
        /* left: 89%; */
    }
</style>
@endpush


@section('content')
<div class="app-content-header">
    <!-- begin::Row -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Profile</h3>
                <h5 class="mb-0">Profile personnel</h5>
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
        
        <div class="card" style="width: 100%; margin-top: 0px">
            <div class="card-body">
                
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="{{ $user->getAvatarFullUrl() }}" class="img-size-50 rounded-circle me-3 avatar-border" style="height: 80px; width: 80px;">
                    </div>
                    <div class="flex-grow-1" style="margin-top: 20px">
                        <h3 class="dropdown-item-title" style="font-size: 20px;">
                            {{ $user->getFullName() }}
                        </h3>
                        <p class="fs-7">
                            <span class="sub-info">@compte_administrateur</span> <span class="{{ $user->getStatusClass() }}"><i class="bi bi-record-fill" style="font-size: 10px"></i> {{ $user->getStatus() }}</span>
                        </p>
                    </div>
                </div>

                <div class="position-relative-left">
                    <a href="{{ route('admin.profile.settings', ['slug' => $user->slug]) }}" class="btn btn-outline-secondary"><i class="bi bi-gear"></i> </a>
                </div>

                {{-- <hr style="color: rgb(184, 184, 184)"> --}}

                <div class="row mt-4">
                    <div class="col-md-6" style="background-color: #f8f8f8; border-radius: 10px; padding: 20px; margin: 2px 20px 2px 20px; width: 45%">
                        <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-dot"></i>Information Générale</h6>
                        <div class="row">
                            <div class="col-md-4 text-muted">
                                <i class="bi bi-person-vcard"></i> Nom complet <br>
                                <i class="bi bi-envelope-at"></i> Adresse email <br>
                                <i class="bi bi-phone"></i> Téléphone <br>
                                <i class="bi bi-whatsapp"></i> WhatsApp <br>
                            </div>
                            <div class="col-md-8">
                                {{ $user->getFullName() }} <br>
                                {{ $user->email }} <br>
                                {{ $user->telephone }} <br>
                                {{ $user->whatsapp }} <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 float-md-end" style="background-color: #f8f8f8; border-radius: 10px; padding: 20px; margin: 2px 0px 2px 38px; width: 45%">
                        <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-dot"></i>Information supplementaire</h6>
                        <div class="row">
                            <div class="col-md-4 text-muted">
                                <i class="bi bi-globe-europe-africa"></i> Privilèges <br>
                                <i class="bi bi-geo"></i> Localisation <br>
                                <i class="bi bi-calendar-date"></i> Ajouté le <br>
                                <i class="bi bi-calendar-date"></i> Mis à jour le <br>
                            </div>
                            <div class="col-md-8">
                                {{ \Str::ucfirst($user->role) }} {{ $user->isGlobalAdmin() ? ', Super Admin' : '' }} <br>
                                {{ $user->pays }}, {{ $user->ville }} <br>
                                {{ $user->created_at->format('d M Y') }} <br>
                                {{ $user->updated_at->format('d M Y') }} <br>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <hr style="color: #b8b8b8"> --}}
                <div class="row pt-3 mb-2">
                    <div class="col-md-12">
                        {{-- <p>
                            <a href="{{ route('admin.user.edit', ['user_id' => $user->id, 'slug' => $user->slug]) }}" class="btn btn-primary"><i class="bi bi-gear"></i> Paramettre</a>
                        </p> --}}
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
<script>
    let get_user_route = "{{-- route('admin.user.get-user-byajax') --}}";

    function openModal(sale_id) {
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
            url: get_user_route+"?item_id="+sale_id,
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

    // function get_item(url, item_id) {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type: "GET",
    //         url: url+"?item_id="+item_id,
    //         success: function(result) {
    //             console.log(result);
    //             if (result.action == true) {

    //                 $('#titleU').val(result.data.title);
    //                 $('#iconU').val(result.data.icon);
    //                 $('#descriptionU').val(result.data.description);

    //             } else {
    //                 toastr.error(result.message);
    //             }
    //         },
    //         error: (e) => {
    //             console.log(e);
    //             console.log(e.responseJSON);
    //         }
    //     });
    // }

</script>
@endpush