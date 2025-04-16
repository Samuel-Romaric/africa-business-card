@extends('layouts.app')

@section('title', 'Commerciaux |')

@push('styles')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/r-3.0.3/datatables.min.css" rel="stylesheet">
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

    .avatar {
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
        color: #0fac82; /** #3dc094; /** #58be9c */
        background-color: #ddfff3;
        padding: 1.5px 10px 1.5px 10px;
        border-radius: 50px;
        font-weight: bold;
    }

    .status-danger {
        border: 0.5px solid #fff1e8;
        color: #e34d2f; /** #ea745c */
        background-color: #fff1e8;
        padding: 1.5px 10px 1.5px 10px;
        border-radius: 50px;
    }

    .status-size {
        font-size: 40px;
    }

    .dot-action-rounde {
        background-color: #f4f3f3;
        padding: 0.8px 4.5px 0.8px 4.5px;
        border-radius: 50%;
        color: #8c8c8c;
    }

    .btn-search {
        cursor: pointer;
    }
</style>
@endpush


@section('content')
<div class="app-content-header">
    <!-- begin::Row -->
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Commerciaux</h3>
                <h5 class="mb-0">Liste des commerciaux</h5>
            </div>
            <div class="col-sm-6">
                <div class="mb-3 mt-3 row">
                </div>
                <ol class="breadcrumb float-sm-end">
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-outline-secondary" id="toggleFilter"><i class="bi bi-filter"></i> Filtre</button>
                        </div>
                    </div>
                </ol>
            </div>
        </div>
        <div class="mt-3 filter-block" style="display: none;">
            <form action="{{ route('admin.commerciaux.index') }}" method="GET" id="filter-form">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">
                        <select name="type" class="form-control" id="type">
                            <option value="all" {{ old('type', request('type')) == 'all' ? 'selected' : '' }}>Profiles</option>
                            <option value="junior" {{ old('type', request('type')) == 'junior' ? 'selected' : '' }}>Juniors</option>
                            <option value="senior" {{ old('type', request('type')) == 'senior' ? 'selected' : '' }}>Seniors</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="is_blocked" class="form-control" id="">
                            <option value="all" {{ old('is_blocked', request('is_blocked')) == 'all' ? 'selected' : '' }}>Statut</option>
                            <option value="0" {{ old('is_blocked', request('is_blocked')) == '0' ? 'selected' : '' }}>Actifs</option>
                            <option value="1" {{ old('is_blocked', request('is_blocked')) == '1' ? 'selected' : '' }}>Bloqués</option>
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

        <div class="row g-4">
            @forelse ($commerciaux as $item)
                <div class="col-md-4">
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="card-body">
                            <div class="btn-group" style="position: absolute; right: 10px; cursor: pointer">
                                <div class="btn-dots-action dot-action-rounde" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-muted" href="{{ route('admin.commercial.show', $item->user->id) }}"><i class="bi bi-person-vcard"></i> Afficher Profile</a></li>
                                    <li><a class="dropdown-item {{ $item->user->isBlocked() ? 'text-success' : 'text-danger' }}" onclick="return confirm('Voulez-vous bloquer cet utilisateur ?')" href="{{ route('admin.commercial.blocked', $item->user->id) }}">
                                            {!! $item->user->isBlocked() ? '<i class="bi bi-unlock"></i> Débloquer' : '<i class="bi bi-lock"></i> Bloquer'!!} 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                  <img src="{{ $item->getAvatarFullUrl() }}" alt="User Avatar" class="img-size-50 rounded-circle me-3 avatar-border">
                                </div>
                                <div class="flex-grow-1" style="margin-top: 8px">
                                    <h3 class="dropdown-item-title">
                                        {{ $item->user->firstname }} {{ $item->user->name }}
                                    </h3>
                                    <p class="fs-7">
                                        <span class="sub-info">@commercial_{{ $item->type }}</span> <span class="{{ $item->user->getStatusClass() }} "><i class="bi bi-record-fill" style="font-size: 10px;"></i> {{ $item->user->getStatus() }}</span>
                                        {{-- <span class="sub-info">@commercial_{{ $item->type }}</span> <span class="{{ $item->user->getStatusClass() }} "><i class="bi bi-record-fill$item->user->isBlocked() ? 'exclamation' : 'check'"></i> {{ $item->user->getStatus() }}</span> --}}
                                    </p>
                                </div>
                            </div>
                            <hr style="color: #b8b8b8; margin-top: -4px; margin-bottom: 6px;">
                            <p class="card-text text-secondary">
                                {{-- <i class="bi bi-person-circle"></i> {{ $item->user->code }} <br> --}}
                                <i class="bi bi-envelope-at"></i> {{ $item->user->email }} <br>
                                <i class="bi bi-telephone"></i> {{ $item->user->telephone }} <br>
                                <i class="bi bi-whatsapp"></i> {{ $item->user->whatsapp }} <br>
                                <i class="bi bi-geo"></i> {{ $item->user->pays }}, {{ $item->user->ville }} <br>
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12">
                    <div class="text-center py-5">
                        <p><img src="{{ asset('/admin/assets/img/research-paper.png') }}" style="height: 70px" alt="" srcset=""></p>
                        <p class="text-gray" style="color: #a9a8a8; font-size: 20px">Aucun resultat trouvé</p>
                    </div>
                </div>
            @endforelse

            @if (!empty($commerciaux))
                <div class="col-lg-12" style="margin-top: 30px;">
                    <div>
                        {{ $commerciaux->links('vendor.pagination.bootstrap-5-fr') }}
                    </div>
                </div>
            @endif
        </div>

        {{-- @php
            $i = 1
        @endphp --}}

            {{-- <table id="Table" class="table table-borderless">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Téléphone</th>
                        <th>Localisation</th>
                        <th>Grade</th>
                        <th>Code </th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($commerciaux as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                  <img src="{{ $item->getAvatarFullUrl() }}" alt="User Avatar" class="img-size-50 rounded-circle me-3 avatar">
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        {{ $item->user->name }}
                                    </h3>
                                    <p class="fs-7">
                                        <span class="sub-info">{{ $item->user->email }}</span>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->user->telephone }}</td>
                        <td>{{ $item->user->pays }} <br> <span class="sub-info sub-info-size"><i class="bi bi-geo"></i> {{ $item->user->ville }}</span></td>
                        <td>{{  \Str::ucfirst($item->type) }} <br> <span class="sub-info sub-info-size">{{ $item->user->diplome }}</span></td>
                        <td>{{ $item->user->code }}</td>
                        <td>
                            <span class="{{ getUserStatusClass($item->user) }}"><i class="bi bi-record-fill" style="font-size: 10px"></i> {{ getUserStatus($item->user) }}</span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <div class="btn-dots-action" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-primary" href="{{ route('admin.commercial.show', $item->user->id) }}"><i class="bi bi-eye"></i> Voir detail</a></li>
                                    <li><a class="dropdown-item {{ $item->user->isBlocked() ? 'text-success' : 'text-danger' }}" onclick="return confirm('Voulez-vous bloquer cet utilisateur ?')" href="{{ route('admin.commercial.blocked', $item->user->id) }}">
                                            {!! $item->user->isBlocked() ? '<i class="bi bi-unlock"></i> Débloquer' : '<i class="bi bi-lock"></i> Bloquer'!!} 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table> --}}
        
        <!--begin::Row-->
    </div>

    {{-- @include('admin.sales.modals.update-sale') --}}

    <!--end::Container-->
</div>

@endsection

@push('scripts')
<script src="{{ asset('admin/js/sweetalert2@11.js') }}"></script>
<script>

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