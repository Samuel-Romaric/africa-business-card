@extends('layouts.app')

@section('title', 'Entreprise - Ajouter offres | ')

@push('styles')
<style>
    .banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        /* background-color: #FFD600; Couleur jaune */
        background-color: #fbf3c4;
        padding: 20px 40px;
        border-radius: 15px;
        width: 158vh;
        height: 180px;
        margin-left: 10px;
    }

    .banner .logo {
        background-color: #001a4d;
        color: white;
        font-size: 36px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 120px;
        height: 120px;
        border-radius: 50%;
    }

    .banner .content-slide {
        flex-grow: 1;
        margin-left: 20px;
    }

    .banner .content-slide .subtitle {
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .banner .content-slide .title {
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px;
    }

    .card-title {
        font-weight: bold
    }

    .description {
        /* font-style: italic; */
        font-size: 15px;
        color: #777676;
        padding-bottom: 8px;
    }

    .business {
        /* font-style: italic; */
        margin-top: 5px;
        font-size: 15px;
        color: rgb(152, 153, 153);
    }

    .btn-outline-primary {
        border-color: #3f50d5;
        color: #3f50d5;
    }

    .btn-outline-primary:hover {
        background-color: #3f50d5;
        border-color: #3f50d5;
    }

    .product-title {
        color: #001a4d;
        font-size: 25px;
    }

    .information {
        display: grid;
        grid-template-columns: auto auto; /* Deux colonnes */
        justify-content: space-between;
        width: 100%;
        padding: 5px 0px 5px 0px;
        /* border: 1px solid #ddd; */
    }

    .price {
        padding: 5px 0px 5px 0px;
        color: #948c8c;
    }

    .btn-search {
        cursor: pointer;
    }
</style>
@endpush


@section('content')
<div class="app-content-header">

    <div class="banner">
        <div class="logo">
            <img class="logo" src="{{ $business->getBusinessLogoFullUrl() }}" alt="">
        </div>
        <div class="content-slide">
            <div class="subtitle">{{ $business->nom_commercial }}</div>
            <div class="title">{{ \Str::limit($business->description, 60) }} </div>
        </div>
    </div>

    <!-- begin::Row -->
    <div class="container-fluid mt-5"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Entreprise</h3>
                <h5 class="mb-0">Ajout d'offre pour {{ $business->nom_commercial }}</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">

                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <button class="btn btn-outline-secondary"><i class="bi bi-filter"></i> Filter</button>
                            <a href="{{ route('admin.business.offer.create', ['item_id' => $business->id, 'slug' => $business->slug]) }}" class="btn btn-primary mx-2"><i class="bi bi-plus-circle"></i> Ajouter une offre</a> --}}
                        </div>
                    </div>
                    
                </ol>
                {{-- <div class="row">
                    <div class="col-sm-12">
                        <form action="">
                            <div class="input-group mb-3 float-end">
                                <input type="text" class="form-control" placeholder="Rechercher..." id="inputSearch">
                                <span class="input-group-text">
                                    <a class="btn-search"><i class="bi bi-search"></i></a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div> <!-- end::Row -->
</div>
<div class="app-content" >
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->

        {{-- @include('layouts.partials.flash-message') --}}

            <div class="card" style="width: 100%; padding: 2%;">

                <form method="POST" action="{{ route('admin.business.offer.add', ['item_id' => $business->id, 'slug' => $business->slug]) }}" enctype="multipart/form-data" id="addOfferForm">
                    <!--begin::Body-->
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="business_id" value="{{ $business->id }}" id="business_id">
                        <input type="hidden" name="slug" value="{{ $business->slug }}" id="slug">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Titre de l'offre</label>
                                    <input type="text" name="titre" required class="form-control" id="title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="coverOffer" class="form-label">Image de couverture</label>
                                    <input type="file" name="coverOffer" class="form-control" id="coverOffer">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type d'offre</label>
                                    <select class="form-control" name="type" required id="type">
                                        <option value="">Choisir le type d'offre</option>
                                        <option value="produit">Produit</option>
                                        <option value="service">Service</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Prix unitaire</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="price" required class="form-control" id="price" aria-label="Amount (to the nearest franc cfa)">
                                        <span class="input-group-text">F CFA</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Ici votre description de l'offre..."></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Enregister</button>
                        <a href="{{ route('admin.business.offers.show', ['item_id' => $business->id, 'slug' => $business->slug]) }}" class="btn btn-outline-secondary mx-2"><i class="bi bi-reply"></i> Retour</a>
                    
                    </div>
                </form>
            </div>
            
        </div>
       
    </div>
    <!--end::Container-->
</div>

@endsection



@push('scripts')
<script>
    let get_user_saller_route = "{{ route('admin.business.get-saler-by-ajax') }}";

    function openModal(offer_id) {
        $('#saleOfferForm').trigger('reset');
        $('#offer_id').val(offer_id);
        $('#codeHelp').html(`
            <div class="text-muted">
                <i class="bi bi-info-circle"></i> Detenteur du code
            </div>
        `);
        
        $('#saleModal').modal('show');
    }

    $('#saleProductBtn').on('click', function (e) {
        e.preventDefault();

        const form = $('#saleOfferForm')[0];

        if (form.reportValidity()) {
            $('#saleOfferForm').submit();
        } else {
            form.reportValidity();
        }
    });

    $('#code').on('change', function () {
        let codeSaler = $('#code').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: get_user_saller_route+"?codeSaler="+codeSaler,
            success: function(result) {
                console.log(result);
                
                if (result.action == true) {

                    $('#codeHelp').html(`
                        <div class="text-success">
                            <i class="bi bi-check2-all"></i> 
                            ${result.message} 
                        </div>`);
                    $('#saler_id').val(result.data.saler_id);
                    $('#marchandName').val(result.data.fullname);

                } else {
                    console.log('No user find...');
                    $('#codeHelp').html(`
                        <div class="text-danger">
                            <i class="bi bi-exclamation-triangle"></i> 
                            ${result.message}
                        </div>
                    `);
                    $('#saler_id').val('');
                    $('#marchandName').val('');
                }
            },
            error: (e) => {
                console.log(e);
                console.log(e.responseJSON);
            }
        });
    });
</script>
@endpush