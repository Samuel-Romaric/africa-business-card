@extends('layouts.app')

@section('title', 'Edit |')

@push('styles')
<style>
    /* .table th, .table td {
        vertical-align: middle;
    }

    .dt-search {
        margin-bottom: 12px;
    } */

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
                <h3 class="mb-0">Adminstrateur</h3>
                <h5 class="mb-0">Paramettre profile</h5>
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

                <form method="POST" action="{{ route('admin.user.add-user') }}" enctype="multipart/form-data"> 
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" name="name" required class="form-control" id="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" name="firstname" required class="form-control" id="firstname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input type="text" name="email" required class="form-control" id="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Photo de profile</label>
                                <input type="file" name="avatar" class="form-control" id="avatar">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="telephone" class="form-label">Numero de téléphone</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" name="telephone" class="form-control" id="telephone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="whatsapp" class="form-label">Numero WhatsApp</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                                <input type="text" name="whatsapp" class="form-control" id="whatsapp">
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-3">
                            <label for="telephone" class="form-label">Pays</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" name="telephone" class="form-control" id="telephone">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="telephone" class="form-label">Numero de téléphone</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" name="telephone" class="form-control" id="telephone">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="whatsapp" class="form-label">Numero WhatsApp</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                                <input type="text" name="whatsapp" class="form-control" id="whatsapp">
                            </div>
                        </div>
                    </div> --}}
                
                    <hr style="color: rgb(184, 184, 184)">
                
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Enregistrer l'utilisateur</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary"><i class="bi bi-reply"></i> Retour</a>
                        </div>
                    </div>
                </form>
            
                
            </div>
        </div>
        
        <!--begin::Row-->
    </div>

    <!--end::Container-->
</div>

@endsection

@push('scripts')
<script>
</script>
@endpush