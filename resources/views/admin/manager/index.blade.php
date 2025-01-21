@extends('layouts.app')

@section('title', '| Manager')

@push('styles')
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
</style>
@endpush


@section('content')
<div class="app-content-header">
    <!-- begin::Row -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manager</h3>
                <h5 class="mb-0">Liste des managers</h5>
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
            @forelse ($managers as $manager)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ $manager->getCoverFullUrl() }}" style="height: 220px" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h1 class="card-title">{{ $manager->name }}</h1><br>
                      <p class="location">
                        <div class="location">
                            <i class="bi bi-geo-alt"></i> {{ $manager->location }} <br>
                            <i class="bi bi-house"></i> {{ $manager->business->name }}
                        </div>
                    </p>
                      {{-- <p class="business"><i class="bi bi-house"></i> {{ $manager->location }}</p> --}}
                      <p class="card-text">{{ \Str::limit($manager->description, 25) }}</p>
                      {{-- <a href="#" class="btn btn-primary">Voir plus</a> --}}
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12">
                <div class="text-center py-5">
                    <p class="text-gray ">Aucun manager pour l'instant</p>
                </div>
            </div>
            @endforelse

            <div class="col-lg-12" style="margin-top: 30px;">
                <div>
                    {{ $managers->links('vendor.pagination.bootstrap-5-fr') }}
                </div>
            </div>
            
        </div>
       
    </div>
    <!--end::Container-->
</div>

@endsection

@push('styles')

@endpush

@push('scripts')

@endpush