@extends('layouts.app')

@section('title', 'Rapport |')

@push('styles')
<style>
    
</style>
@endpush


@section('content')
<div class="app-content-header">
    <!-- begin::Row -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Rapport</h3>
                <h5 class="mb-0">Effectuer un rapport mensuel des ventes</h5>
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
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 bg-light p-4 rounded shadow">
                    <form method="POST" action="{{ route('admin.report.show') }}">
                        @csrf
                        <!-- Première ligne : Choix du filtre et champ dynamique -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="filter_type" class="form-label">Filtrer par :</label>
                                <select id="filter_type" class="form-select">
                                    <option value="">Choisir...</option>
                                    <option value="manager">Nom du manager</option>
                                    <option value="business">Nom de l'entreprise</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label id="filter_label" class="form-label">Nom du manager:</label>
                                <input type="text" name="search_value" id="search_value" class="form-control" placeholder="Entrez un nom">
                            </div>
                        </div>

                        <!-- Deuxième ligne : Dates de début et de fin -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Date de début :</label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Date de fin :</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                            </div>
                        </div>

                        <!-- Troisième ligne : Bouton de recherche -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Effectuer le rapport</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

{{-- 
        <form class="mb-3" action="{{ route('admin.report.show') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-4">
                            <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                                <select class="form-select" id="inlineFormSelectPref">
                                <option selected>Choose...</option>
                                <option value="1">Entreprise</option>
                                <option value="2">Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <label for="name" class="form-label">Nom entreprise</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" name="name" placeholder="Business / Manager" id="name" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="name" class="form-label">Nom entreprise ou manager</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Business / Manager" id="name" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Date de début</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i></span>
                        <input type="date" class="form-control" name="start_date" placeholder="Date de debut" id="start_date" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i></span>
                        <input type="date" class="form-control" name="end_date" placeholder="Date de fin" id="end_date" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary" type="submit">Rechercher</button>
                    </div>
                </div>
            </div>
        </form> --}}

        {{-- <form action="">

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Nom du manager</option>
                                        <option value="2">Nom de l'entreprise</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i></span>
                                        <input type="text" class="form-control" placeholder="Date debut" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i></span>
                                        <input type="date" class="form-control" placeholder="Date debut" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i></span>
                                        <input type="date" class="form-control" placeholder="Date fin" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-primary" type="submit">Rechercher</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>

        </form> --}}


        {{-- <form action="" method="post">

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Nom du manager</option>
                                        <option value="2">Nom de l'entreprise</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i></span>
                                        <input type="text" class="form-control" placeholder="Date debut" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i></span>
                                        <input type="date" class="form-control" placeholder="Date debut" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date"></i></span>
                                        <input type="date" class="form-control" placeholder="Date fin" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-primary" type="submit">Rechercher</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>

        </form> --}}
            
        <!--begin::Row-->
    </div>

    @include('admin.sales.modals.update-sale')

    <!--end::Container-->
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const filterType = document.getElementById("filter_type");
        const filterLabel = document.getElementById("filter_label");
        const searchValue = document.getElementById("search_value");

        filterType.addEventListener("change", function () {
            if (this.value === "manager") {
                filterLabel.innerText = "Nom du manager :";
                searchValue.placeholder = "Entrez le nom du manager";
            } else if (this.value === "business") {
                filterLabel.innerText = "Nom de l'entreprise :";
                searchValue.placeholder = "Entrez le nom de l'entreprise";
            } else {
                filterLabel.innerText = "Nom :";
                searchValue.placeholder = "Entrez un nom";
            }
        });
    });
</script>
@endpush