@extends('layouts.app')

@section('title', 'Edit |')

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }

    .dt-search {
        margin-bottom: 12px;
    }

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

                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="{{ $user->getAvatarFullUrl() }}" class="img-size-50 rounded-circle me-3 avatar-border" style="height: 80px; width: 80px;">
                    </div>
                    <div class="flex-grow-1" style="margin-top: 20px">
                        <h3 class="dropdown-item-title" style="font-size: 20px;">
                            {{ $user->getFullName() }} <span class="{{ $user->getStatusClass() }} status-size-12"><i class="bi bi-patch-{{ $user->isBlocked() ? 'exclamation' : 'check' }}"></i> {{ $user->getStatus() }}</span>
                        </h3>
                        <p class="fs-7">
                            <span class="sub-info">Administrateur{{-- \Str::ucfirst($user->role) --}}</span> 
                        </p>
                    </div>
                </div>

                <div class="position-relative-left">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary"><i class="bi bi-reply"></i> </a>
                </div>

                {{-- <hr style="color: rgb(184, 184, 184)"> --}}

                {{-- @include('admin.users.settings.partials.tabs') --}}


                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                            <i class="bi bi-person"></i> Information personnelle
                            {{-- <i class="bi bi-house-door"></i> Information personnelle --}}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="securite-tab" data-bs-toggle="tab" data-bs-target="#securite" type="button" role="tab" aria-controls="securite" aria-selected="false">
                            <i class="bi bi-shield-lock"></i> Privilège & Sécurité
                        </button>
                    </li>
                </ul>
            
                <!-- Contenu des Tabs -->
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        @include('admin.users.settings.info')
                    </div>
            
                    <div class="tab-pane fade" id="securite" role="tabpanel" aria-labelledby="securite-tab">
                        @include('admin.users.settings.security')
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

    function generatePassword(length = 12) {
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
        let password = "";
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }
        document.getElementById("password").value = password;
    }
</script>
@endpush