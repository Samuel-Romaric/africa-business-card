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
                    
                </div>
                <ol class="breadcrumb float-sm-center">
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
                    <form method="GET" action="{{ route('admin.report.show') }}">
                        @csrf
                        <!-- Première ligne : Choix du filtre et champ dynamique -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="filter_type" class="form-label">Filtrer par :</label>
                                <select id="filter_type" name="filter_type" class="form-select">
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
            
        <!--begin::Row-->
    </div>

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