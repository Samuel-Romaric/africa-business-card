@extends('layouts.app')

@section('title', 'Tableau de bord |')

@push('styles')
<style>
    .chiffre-annuelle {
        color: #040404;
        color: #010140;
        font-weight: bold;
        font-size: 30px;
        font-family: 'Lexend Deca';
    }

    .chiffres {
        color: #010140;
        text-align: center;
        font-size: 16px;
        background-color: rgb(216, 216, 216);
        border-radius: 80px;
        width: 50px;
        /* margin: auto; */
        margin-top: 5px;
    }


    /* .card {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 200px;
        background: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    } */

    .card-content {
        display: flex;
        align-items: center;


        white-space: nowrap; /* Empêche le texte de passer à la ligne */
        overflow: hidden; /* Cache le débordement */
        text-overflow: ellipsis; /* Ajoute "..." si trop long */
        width: 100%; /* Pour uniformiser la largeur */
    }

    .icon-container {
        width: 45px;
        height: 45px;
        background: #F5F5F5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #000;
        margin-right: 15px;
        margin-left: 0px;
    }


    .text-container {
        display: flex;
        flex-direction: column;
        
        /* margin: 0px; */
    }

    .title {
        font-size: 15px;
        font-weight: bold;
        color: #7b7b7b;
        text-align: center;
    }

    .count {
        font-size: 25px;
        font-weight: bold;
        color: #000;
        text-align: center;
    }
/*
    .increase {
        font-size: 14px;
        color: #44B78B;
    } */
</style>
@endpush

@section('content')

<div class="app-content-header">
    <!-- begin::Row -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">
                    Tableau de bord
                </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Dashboard --}}
                    </li>
                </ol>
            </div>
        </div>
    </div> <!-- end::Row -->
</div>
<div class="app-content" >
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->

        <div class="row">
            <div class="col-md-4">
                <div class="">
                    Vente annuelle <!-- <i class="bi bi-cash-stack"></i> -->
                    <h6 class="chiffre-annuelle"><i class="bi bi-piggy-bank"></i> 105.000.000 <span style="color:#c7c7c7; font-size: 18px">F CFA</span></h6>
                    <span style="font-size: 11px; color: #b1b1b1; position:relative; top:-10px"><i class="bi bi-calendar-day"></i> Du 01 Jan. 2025 - 31 Déc. 2025</span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card" style="display: flex; align-items: center; justify-content: center; padding: 5%">
                    <div class="card-content">
                        <div class="icon-container">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div class="text-container">
                            <div class="title">Entreprises</div>
                            <div class="count">{{ formatNumber($totalBusiness) }} <!--span class="increase">▼ +8 tasks</span--></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card"  style="display: flex; align-items: center; justify-content: center; padding: 5%">
                    <div class="card-content">
                        <div class="icon-container">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="text-container">
                            <div class="title">Produits</div>
                            <div class="count">{{ formatNumber($totalProduct) }} <!--span class="increase">▼ +8 tasks</span--></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card"  style="display: flex; align-items: center; justify-content: center; padding: 5%">
                    <div class="card-content">
                        <div class="icon-container">
                            <i class="bi bi-wallet"></i>
                        </div>
                        <div class="text-container">
                            <div class="title">Services</div>
                            <div class="count">{{ formatNumber($totalService) }} <!--span class="increase">▼ +8 tasks</span--></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card"  style="display: flex; align-items: center; justify-content: center; padding: 5%">
                    <div class="card-content">
                        <div class="icon-container">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <div class="text-container">
                            <div class="title">Souscriptº</div>
                            <div class="count">{{ formatNumber(0) }} <!--span class="increase">▼ +8 tasks</span--></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-9">
                <div class="card">
                    <canvas id="salesChart" style="margin: 3%"></canvas>
                </div>
            </div>
            <div class="col-md-3">
                <div style="display: grid; grid-template-columns: 2fr 1fr; align-items: center; width: 100%; margin-bottom: 5px">
                    <h5 style="justify-self: start;">Utilisateurs Total</h5>
                    <span style="justify-self: end; background-color: #e7e7e7e7; color: #f7b02b; font-weight: bold; padding: 4px 8px 4px 8px; border-radius: 70%; margin-top: -15px;">
                        {{ formatNumber($totalUserData['totalUser']) }}
                    </span>
                </div>
                
                <div class="card" style="padding-top: 4%; padding-bottom: 4%; padding-left: 8%; padding-right: 8%">
                    <h6 class="mt-2">Managers</h6> 
                    <div class="row">
                        <div class="col-md-4" style="color: #ababab">Statut</div>
                        <div class="col-md-4" style="color: rgb(252, 119, 119)"><i class="bi bi-person-lock"></i> {{ formatNumber($totalUserData['managerBlocked']) }}</div>
                        <div class="col-md-4" style="color: rgb(68, 164, 64)"><i class="bi bi-person-check"></i> {{ formatNumber($totalUserData['managerActif']) }}</div>
                    </div>
                    <hr style="color: rgb(184, 184, 184);">
                    <h6>Entreprises</h6>
                    <div class="row">
                        <div class="col-md-4" style="color: #ababab">Statut</div>
                        <div class="col-md-4" style="color: rgb(252, 119, 119)"><i class="bi bi-building-lock"></i> {{ formatNumber($totalUserData['businessBlocked']) }}</div>
                        <div class="col-md-4" style="color: rgb(68, 164, 64)"><i class="bi bi-building-check"></i> {{ formatNumber($totalUserData['businessActif']) }}</div>
                    </div>
                    <hr style="color: rgb(184, 184, 184);">
                    <h6>Commerciaux</h6>
                    <div class="row">
                        <div class="col-md-4" style="color: #ababab">Statut</div>
                        <div class="col-md-4" style="color: rgb(252, 119, 119)"><i class="bi bi-person-lock"></i> {{ formatNumber($totalUserData['commercialBlocked']) }}</div>
                        <div class="col-md-4" style="color: rgb(68, 164, 64)"><i class="bi bi-person-check"></i> {{ formatNumber($totalUserData['commercialActif']) }}</div>
                    </div>
                    <hr style="color: rgb(184, 184, 184);">
                    <h6>Administrateurs</h6> 
                    <div class="row mb-3">
                        <div class="col-md-4" style="color: #ababab">Statut</div>
                        <div class="col-md-4" style="color: rgb(252, 119, 119)"><i class="bi bi-person-lock"></i> {{ formatNumber($totalUserData['adminBlocked']) }}</div>
                        <div class="col-md-4" style="color: rgb(68, 164, 64)"><i class="bi bi-person-check"></i> {{ formatNumber($totalUserData['adminActif']) }}</div>
                    </div>
                </div>
            </div>
        </div>
       
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('salesChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($data['monthlyLabels']), // Labels des mois
                datasets: [
                    {
                        label: "Ventes mensuelles",
                        data: @json($data['monthlyData']), // Données des ventes mensuelles
                        borderColor: "#4CAF50",
                        backgroundColor: "rgba(76, 175, 80, 0.2)",
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: "Ventes journalières (Mois en cours)",
                        data: @json($data['dailyData']), // Données des ventes journalières
                        borderColor: "#FF5733",
                        backgroundColor: "rgba(255, 87, 51, 0.2)",
                        fill: true,
                        tension: 0.3
                    }
                ]
            }
        });
    });
</script>
@endpush