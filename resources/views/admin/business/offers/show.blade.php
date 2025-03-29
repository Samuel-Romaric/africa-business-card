@extends('layouts.app')

@section('title', 'Entreprise - Produits | ')

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
        min-height: 90px;
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
                <h5 class="mb-0">Offre de l'entreprise {{ $business->nom_commercial }}</h5>
            </div>
            <div class="col-sm-6">
                <div class="mb-3 mt-3 row">
                </div>
                <ol class="breadcrumb float-sm-end">
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-outline-secondary mx-2" id="toggleFilter"><i class="bi bi-filter"></i> Filtre</button>
                            <a href="{{ route('admin.business.offer.create', ['item_id' => $business->id, 'slug' => $business->slug]) }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Ajouter une offre</a>
                        </div>
                    </div>
                </ol>
            </div>
        </div>
        <div class="mt-3 filter-block" style="display: none;">
            <form action="{{ route('admin.business.offers.show', ['item_id' => $business->id, 'slug' => $business->slug]) }}" method="GET" id="filter-form">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">
                        <select name="type" class="form-control" id="type">
                            <option value="all" {{ old('type', request('type')) == 'all' ? 'selected' : '' }}>Types d'offre</option>
                            <option value="produit" {{ old('type', request('type')) == 'produit' ? 'selected' : '' }}>Produits</option>
                            <option value="service" {{ old('type', request('type')) == 'service' ? 'selected' : '' }}>Services</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="validated" class="form-control" id="">
                            <option value="all" {{ old('validated', request('validated')) == 'all' ? 'selected' : '' }}>Statut</option>
                            <option value="0" {{ old('validated', request('validated')) == '0' ? 'selected' : '' }}>En attente</option>
                            <option value="1" {{ old('validated', request('validated')) == '1' ? 'selected' : '' }}>Valider</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group mb-3 float-end">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher..." id="inputSearch">
                            <span class="input-group-text">
                                <a id="btn-search" class="btn-search"><i class="bi bi-search"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> <!-- end::Row -->
</div>
<div class="app-content" >
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->

        {{-- @include('layouts.partials.flash-message') --}}

        <div class="row g-4">
            @forelse ($offers as $offer)
            <div class="col-md-4">
                <div class="card h-100" style="width: 100%;">
                    <img src="{{ $offer->getCoverOfferFullUrl() }}" style="height: 220px; width: auto" class="card-img-top" alt="...">
                    <div class="card-body" style="margin-bottom: -12px;">
                        {{-- <h1 class="card-title">
                            <span class="product-title">{{ $offer->name }}</span>
                        </h1> --}}
                        <div class="information">
                            <span class="product-title">{{ $offer->titre }}</span>
                            <span class="price">{{ formatPrice($offer->price) }}</span>
                            <span class="quantity">{{ \Str::ucfirst($offer->type) }}</span>
                            <span class="quantity">{{ \Str::ucfirst($offer->getStatus()) }}</span>
                        </div>
                        <div class="card-text">
                            <div class="description">
                                {{ \Str::limit($offer->description, 80) }} <br>

                                {{-- <div class="mt-3">{{ $offer->getStatus() }}</div> --}}
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        @if ($offer->isValidated())
                                        <div>
                                            <a href="javascript:void(0)" onclick="openModal({{ $offer->id }}, {{ $offer->price }})" class="btn btn-sm btn-primary mt-2">
                                                <i class="bi bi-cart-plus"></i> Faire une vente 
                                            </a>
                                        </div>
                                        @else
                                        <div>
                                            <a onclick="return confirm('Voulez-vous valider cette offre ?');" href="{{ route('admin.business.offer.validated', ['item_id' => $business->id, 'slug' => $business->slug, 'offer_id' => $offer->id]) }}" class="btn btn-sm btn-warning mt-2">
                                                <i class="bi bi-check-square"></i> Valider 
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative">
                                            <div class="position-absolute end-0">
                                                <a href="{{ route('admin.business.offer.edit', ['item_id' => $business->id, 'slug' => $business->slug, 'offer_id' => $offer->id]) }}" class="btn btn-sm btn-secondary rounded-pill mt-2">
                                                    <i class="bi bi-pencil-square"></i> 
                                                </a>
                                                @if ($offer->isValidated())
                                                <a onclick="return confirm('Voulez-vous rétirer cette offre ?');" href="{{ route('admin.business.offer.validated', ['item_id' => $business->id, 'slug' => $business->slug, 'offer_id' => $offer->id]) }}" class="btn btn-sm btn-secondary rounded-pill mt-2">
                                                    <i class="bi bi-bag-x"></i> 
                                                </a>
                                                @else
                                                <a onclick="return confirm('Voulez-vous vraiment supprimer cette offre ?');" href="{{ route('admin.business.offer.delete', ['item_id' => $business->id, 'slug' => $business->slug, 'offer_id' => $offer->id]) }}" class="btn btn-sm btn-secondary rounded-pill mt-2">
                                                    <i class="bi bi-trash"></i> 
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="d-flex">
                                    
                                    @if ($offer->isValidated())
                                    <div>
                                        <a href="javascript:void(0)" onclick="openModal({{ $offer->id }})" class="btn btn-sm btn-outline-primary mt-2">
                                            Faire une vente <i class="bi bi-cash"></i>
                                        </a>
                                    </div>
                                    @else
                                    <div>
                                        <a href="javascript:void(0)" onclick="openModal({{ $offer->id }})" class="btn btn-sm btn-warning mt-2">
                                            <i class="bi bi-check-square"></i> Valider 
                                        </a>
                                    </div>
                                    @endif
                                    <div class="d-flex end-0">
                                        <a href="{{ route('admin.business.offer.edit', ['item_id' => $business->id, 'slug' => $business->slug, 'offer_id' => $offer->id]) }}" class="btn btn-sm btn-secondary rounded-pill mt-2">
                                            <i class="bi bi-pencil-square"></i> 
                                        </a>
                                        <a onclick="return confirm('Voulez-vous valider cet offre ?');" href="{{ route('admin.business.offer.validated', ['item_id' => $business->id, 'slug' => $business->slug, 'offer_id' => $offer->id]) }}" class="btn btn-sm btn-secondary rounded-pill mt-2">
                                            <i class="bi bi-check-square"></i> 
                                        </a>
                                        <a href="{{ route('admin.business.offer.edit', ['item_id' => $business->id, 'slug' => $business->slug, 'offer_id' => $offer->id]) }}" class="btn btn-sm btn-secondary rounded-pill mt-2">
                                            <i class="bi bi-trash"></i> 
                                        </a>
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="{{ $offer->user->getAvatarFullUrl() }}" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                            </div>
                            <div class="flex-grow-1" style="margin-top: 5px">
                                <h3 class="dropdown-item-title">
                                    {{ $offer->user->firstname }} {{ $offer->user->name }}
                                </h3>
                                <p class="fs-7"><i class="bi bi-telephone"></i> {{ $offer->user->telephone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12">
                <div class="text-center py-5">
                    <p class="text-muted">
                        <i class="bi bi-box" style="font-size: 40px; color:#c0bfbf"></i> <br>
                        Aucune offre disponible
                    </p>
                </div>
            </div>
            @endforelse

            <div class="col-lg-12" style="margin-top: 30px;">
                <div>
                    {{ $offers->links('vendor.pagination.bootstrap-5-fr') }}
                </div>
            </div>
            
        </div>
       
    </div>
    <!--end::Container-->
</div>

@include('admin.business.modals.sale-modal')
@endsection



@push('scripts')
<script>
    let get_user_saller_route = "{{ route('admin.business.get-saler-by-ajax') }}";

    function openModal(offer_id, price) {
        $('#saleOfferForm').trigger('reset');
        $('#offer_id').val(offer_id);
        $('#price').val(price);
        $('#codeHelp').html(`
            <div class="text-muted">
                <i class="bi bi-info-circle"></i> Code du manager
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

    $('#quantite').on('change', function () {
        let total = 0;
        let priceU = 0;
        let quantity = null;
        priceU = $('#price').val();
        quantity = $('#quantite').val();
        total = priceU * quantity;
        $('#total').val(total);
    });


    // jQuery pour afficher et cacher la div avec un bouton
    $(document).ready(function() {
        $('#toggleFilter').click(function() {
            $('.filter-block').toggle(); // Alterne entre afficher et cacher
        });
    });
    
    $('#btn-search').on('click', function (e) {
        $('#filter-form').submit();
    })
</script>
@endpush