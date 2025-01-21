@extends('layouts.app')

@section('title', '| Manager')

@push('styles')
{{-- <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine"> --}}
{{-- <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Century+gothic"> --}}
<style>
    .banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
         background-color: #FFD600; /* Couleur jaune */
        /* background-color: #fbf3c4; */
        padding: 20px 40px;
        border-radius: 15px;
        width: 158vh;
        height: 180px;
    }

    .banner .logo {
        /* background-color: black; */
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
        font-size: 16px;
        color: #555555;
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
</style>
@endpush


@section('content')
<div class="app-content-header">

    <div class="banner">
        <div class="logo">Logo</div>
        <div class="content-slide">
            <div class="subtitle">{{ $business->name }}</div>
            <div class="title">{{ \Str::limit($business->description, 60) }} </div>
        </div>
        {{-- <div class="sparkles"></div> --}}
    </div>

    <!-- begin::Row -->
    <div class="container-fluid mt-5"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Entreprise</h3>
                <h5 class="mb-0">Offre de l'entreprise {{ $business->name }}</h5>
            </div>
            <div class="col-sm-6">
                <div class="mb-3 mt-3 row">
                    {{-- <label for="inputPassword" class="col-sm-2 col-form-label">Password</label> --}}
                    <div class="col-sm-10" style="transform: translate(60px)">
                        <input type="text" class="form-control" placeholder="Rechercher..." id="inputPassword">
                    </div>
                </div>
                <ol class="breadcrumb float-sm-center">
                    {{-- <label for="exampleDataList" class="form-label">Filtre</label>
                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Rechercher..."> --}}
                    {{-- <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword">
                        </div>
                    </div> --}}
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
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->

        <div class="row g-4">
            @forelse ($products as $product)
            <div class="col-md-4">
                <div class="card h-100" style="width: 18rem;">
                    <img src="{{ $product->getCoverProductFullUrl() }}" style="height: 220px" class="card-img-top" alt="...">
                    <div class="card-body" style="margin-bottom: -12px;">
                        <h1 class="card-title">
                            <span class="badge text-bg-secondary">{{ $product->name }}</span>
                        </h1><br>
                        <p class="card-text">
                            <div class="description">
                                {{ \Str::limit($product->description, 80) }} <br>
                                <div class="d-grid">
                                    <a href="#" class="btn btn-sm btn-outline-primary mt-2">
                                        Vendre <i class="bi bi-cash"></i>
                                    </a>
                                </div>
                            </div>
                        </p>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                              <img src="{{ asset('/admin/assets/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                            </div>
                            <div class="flex-grow-1">
                              <h3 class="dropdown-item-title">
                                {{ $product->manager->name }}
                                {{-- <span class="float-end fs-7 text-secondary"><i class="bi bi-clock-fill me-1"></i></span> --}}
                              </h3>
                              <p class="fs-7">Manager chez {{ $business->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12">
                <div class="text-center py-5">
                    <p class="text-gray ">Aucun produit disponible</p>
                </div>
            </div>
            @endforelse

            <div class="col-lg-12" style="margin-top: 30px;">
                <div>
                    {{ $products->links('vendor.pagination.bootstrap-5-fr') }}
                </div>
            </div>
            
        </div>
       
    </div>
    <!--end::Container-->
</div>

@endsection

@push('styles')

@endpush