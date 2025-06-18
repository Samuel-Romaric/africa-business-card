@extends('layouts.app')

@section('title', 'Affichage rapport vente|')

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
<style>
    /* Bordure externe du tableau */
    #Table.table.dataTable {
        border: 1px solid #dee2e6; /* Gris clair */
        border-radius: 45px; /* Coins légèrement arrondis */
        border-collapse: collapse; /* Éviter les espaces entre les bordures */
        width: 100%; /* Assurer une bonne mise en page */
    }

    /* Lignes internes entre les rangées */
    .table.dataTable tbody tr {
        border-bottom: 1px solid #ebeaea; /* Gris clair */
        /* border-bottom: 1px solid #dee2e6; Gris clair */
    }

    /* Effet hover léger */
    .table.dataTable tbody tr:hover {
        background-color: #f8f9fc; /* Gris clair au survol */
    }

    /* Alignement des en-têtes */
    .table.dataTable thead th {
         background-color: #0a0a33;/* Bleu foncé comme sur ton image */
        /* background-color: #e4e4e4;  */
        color: #ececfc;
        text-align: left;
    }

    /* Espacement et padding pour un rendu propre */
    .table.dataTable th, .table.dataTable td {
        padding: 10px 15px;
    }

    /************ Old CSS  **********/
    .table th, .table td {
        vertical-align: middle;
    }

    .table.table.dataTable{
        margin-bottom: 10px;
    }
    /* .table-bordered {
        border-color: #efefef;
    } */

    .dt-search {
        margin-bottom: 12px;
    }









    .table th, .table td {
        vertical-align: middle;
    }

    /* table.table.dataTable{
        margin-bottom: 10px;
    } */
    .table-bordered {
        border-color: #efefef;
    }

    .dt-search {
        margin-bottom: 12px;
    }

    #Table_info {
        margin-top: 20px;
        margin-bottom: 20px;
    }   
    
    /*** Banner */
    .banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        /* background-color: #FFD600; Couleur jaune */
        /* background-color: #fbf3c4; */
        padding: 20px 40px;
        border-radius: 15px;
        width: 158vh;
        height: 180px;
        margin-left: 1px;
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

        {{-- <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="banner">
                            <div class="logo">
                                <img class="logo" src="!is_null($sales) ? $sales?->first()->business->getBusinessLogoFullUrl() : 'N/A'" alt="">
                                <img class="logo" src="{{ $sales?->first()->business->getBusinessLogoFullUrl() ?? 'N/A' }}" alt="">
                            </div>
                            <div class="content-slide">
                                <div class="subtitle">{{ $sales->business->nom_commercial }}</div>
                                <div class="title">{{ \Str::limit($sales->business->description, 60) }} </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        Entreprise : $sales->first()->business->nom_commercial ?? 'N/A' <br>
                        Manager    : $sales->first()->manager->name ?? 'N/A'
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- {{ dd($sales) }} --}}

        <div class="card mx-4">
            @if (!empty($sales))
                <table id="Table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Manager</th>
                            <th>Entreprise</th>
                            <th>Offre</th>
                            <th>Type</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Montant Reçu</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->manager->name ?? 'N/A' }}</td>
                            <td>{{ $sale->business->nom_commercial ?? 'N/A' }}</td>
                            <td>{{ $sale->offer->titre ?? 'N/A' }}</td>
                            <td>{{ $sale->offer->type ?? 'N/A' }}</td>
                            <td>{{ number_format($sale->prix, 0, ',', '.') }} FCFA</td>
                            <td>{{ $sale->quantite }}</td>
                            <td>{{ number_format($sale->montant_recu, 0, ',', '.') }} FCFA</td>
                            <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="mx-auto my-auto">
                    <div class="text-center py-5">
                        <p><img src="{{ asset('/admin/assets/img/research-paper.png') }}" style="height: 70px" alt="" srcset=""></p>
                        <p class="text-gray" style="color: #a9a8a8; font-size: 20px">Aucun resultat trouvé</p>
                    </div>
                </div>
            @endif 
        </div>

        
            
        

        {{-- <table id="Table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Manager</th>
                    <th>Entreprise</th>
                    <th>Offre</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Montant Reçu</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                <tr>
                    <td>{{ $sale->manager->name ?? 'N/A' }}</td>
                    <td>{{ $sale->business->nom_commercial ?? 'N/A' }}</td>
                    <td>{{ $sale->offer->titre ?? 'N/A' }}</td>
                    <td>{{ number_format($sale->prix, 0, ',', '.') }} FCFA</td>
                    <td>{{ $sale->quantite }}</td>
                    <td>{{ number_format($sale->montant_recu, 0, ',', '.') }} FCFA</td>
                    <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">Aucune vente trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table> --}}
            
        <!--begin::Row-->
    </div>

    <!--end::Container-->
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.js"></script>

<script>
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
</script>
@endpush