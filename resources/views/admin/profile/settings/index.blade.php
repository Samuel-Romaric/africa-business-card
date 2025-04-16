@extends('layouts.app')

@section('title', 'Edit |')

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

    .status {
        padding: 1.5px 8px 1.5px 8px;
        border-radius: 30px;
        font-size: 15px;
        align-items: center;
        font-weight: bold;
    }

    .status2-success {
        color: #0fac82;
        /* background-color: #ddfff3; */
    }

    .status2-warning {
        color: #ff9b00;
        /* background-color: #fef7ea;* #fbe8ca; */
    }

    .status2-danger {
        color: #cf2213;
        /* background-color: #fdc5c5; */
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
                <h3 class="mb-0">Profile</h3>
                <h5 class="mb-0">Paramettre de mon profile</h5>
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
        
        <div class="card" style="width: 100%; margin-top: 0px">
            <div class="card-body">

                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="{{ $user->getAvatarFullUrl() }}" class="img-size-50 rounded-circle me-3 avatar-border" style="height: 80px; width: 80px;">
                    </div>
                    <div class="flex-grow-1" style="margin-top: 20px">
                        <h3 class="dropdown-item-title" style="font-size: 20px;">
                            {{ $user->getFullName() }} 
                        </h3>
                        <p class="fs-7">
                            <span class="sub-info">@compte_administrateur</span> <span class="{{ $user->getStatusClass() }}"><i class="bi bi-record-fill" style="font-size: 10px"></i> {{ $user->getStatus() }}</span>
                        </p>
                    </div>
                </div>

                <div class="position-relative-left">
                    <a href="{{ route('admin.profile.show') }}" class="btn btn-outline-secondary"><i class="bi bi-reply"></i> </a>
                </div>

                {{-- <hr style="color: rgb(184, 184, 184)"> --}}

                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                            <i class="bi bi-person"></i> Paramettre  de compte
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="securite-tab" data-bs-toggle="tab" data-bs-target="#securite" type="button" role="tab" aria-controls="securite" aria-selected="false">
                            <i class="bi bi-shield-lock"></i> Paramettre de Sécurité
                        </button>
                    </li>
                </ul>
            
                <!-- Contenu des Tabs -->
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        @include('admin.profile.settings.partials.info')
                    </div>
            
                    <div class="tab-pane fade" id="securite" role="tabpanel" aria-labelledby="securite-tab">
                        @include('admin.profile.settings.partials.security')
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
        document.getElementById("confirm_password").value = password;
    }
</script>
@endpush