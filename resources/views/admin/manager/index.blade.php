@extends('layouts.app')

@section('title', 'Manager |')

@push('styles')
<style>
    .card-title {
        font-weight: bold
    }

    .location {
        font-style: italic;
        font-size: 12px;
        color: #989999;
    }

    .business {
        /* font-style: italic; */
        margin-top: 5px;
        font-size: 15px;
        color: rgb(152, 153, 153);
    }

    .sub-info {
        color: #8c8c8c;
    }

    .avatar-border {
        border: 0.5px solid rgb(211, 200, 200);
    }

    .dot-action-rounde {
        background-color: #f4f3f3;
        padding: 0.8px 4.5px 0.8px 4.5px;
        border-radius: 50%;
        color: #8c8c8c;
    }

    .status-success {
        border: 0.5px solid #ddfff3;
        color: #3dc094; /** #58be9c */
        background-color: #ddfff3;
        padding: 1.5px 10px 1.5px 10px;
        border-radius: 50px;
    }

    .status-danger {
        border: 0.5px solid #fff1e8;
        color: #e34d2f; /** #ea745c */
        background-color: #fff1e8;
        padding: 1.5px 10px 1.5px 10px;
        border-radius: 50px;
    }

    .status-size-12 {
        font-size: 12px;
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
                <h3 class="mb-0">Manager</h3>
                <h5 class="mb-0">Liste des managers</h5>
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
            <form action="{{ route('admin.manager.index') }}" method="GET" id="filter-form">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">
                        <select name="type" class="form-control" id="type">
                            <option value="all" {{ old('type', request('type')) == 'all' ? 'selected' : '' }}>Tous Profiles</option>
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
            @forelse ($managers as $item)
                <div class="col-md-4">
                    {{-- <div class="card border-primary mb-3" style="max-width: 18rem;"> --}}
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="card-body">
                            <div class="btn-group" style="position: absolute; right: 10px; cursor: pointer">
                                <div class="btn-dots-action dot-action-rounde" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-primary" href="{{ route('admin.manager.show', $item->user->id) }}"><i class="bi bi-eye"></i> Voir detail</a></li>
                                    <li><a class="dropdown-item {{ $item->user->isBlocked() ? 'text-success' : 'text-danger' }}" onclick="return confirm('Voulez-vous bloquer cet utilisateur ?')" href="{{ route('admin.manager.blocked', $item->user->id) }}">
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
                                        <span class="sub-info">@manager_{{ $item->type }}</span> <span class="{{ $item->user->getStatusClass() }} status-size-12"><i class="bi bi-patch-{{ $item->user->isBlocked() ? 'exclamation' : 'check' }}"></i> {{ $item->user->getStatus() }}</span>
                                        {{-- <span class="sub-info">@manager_{{ $item->type }}</span> <span class="{{ $item->user->getStatusClass() }} status-size-12"><i class="bi bi-circle-fill" style="min-height: 1px;"></i> {{ $item->user->getStatus() }}</span> --}}
                                    </p>
                                </div>
                            </div>
                            <hr style="color: rgb(184, 184, 184); margin-top: -4px; margin-bottom: 6px;">
                            <p class="card-text text-secondary">
                                <i class="bi bi-person-badge"></i> {{ $item->user->code }} <br>
                                {{-- <i class="bi bi-person-circle"></i> {{ $item->user->code }} <br> --}}
                                <i class="bi bi-envelope-at"></i> {{ $item->user->email }} <br>
                                <i class="bi bi-telephone"></i> {{ $item->user->telephone }} <br>
                                <i class="bi bi-geo"></i> {{ $item->user->ville }}, {{ $item->user->pays }} <br>
                            </p>
                        </div>
                      </div>
                </div>
            @empty
            <div class="col-lg-12">
                <div class="text-center py-5">
                    <p><img src="{{ asset('/admin/assets/img/research-paper.png') }}" style="height: 100px" alt="" srcset=""></p>
                    <p class="text-gray" style="color: #a9a8a8; font-size: 25px">Aucun resultat trouvé</p>
                </div>
            </div>
            @endforelse

            @if (!empty($managers))
                <div class="col-lg-12" style="margin-top: 30px;">
                    <div>
                        {{ $managers->links('vendor.pagination.bootstrap-5-fr') }}
                    </div>
                </div>
            @endif
        </div>
{{-- 
        <div class="row g-4">
            @forelse ($managers as $manager)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ $manager->getCoverFullUrl() }}" style="height: 220px" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h1 class="card-title">{{ $manager->user->name }}</h1><br>
                      <p class="location">
                        <div class="location">
                            <i class="bi bi-geo-alt"></i> {{ $manager->user->ville }}, {{ $manager->user->pays }} <br>
                            <i class="bi bi-house"></i> {{ $manager->commune }}
                        </div>
                    </p>
                      <p class="card-text">{{ \Str::limit($manager->description, 25) }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12">
                <div class="text-center py-5">
                    <p><img src="{{ asset('/admin/assets/img/research-paper.png') }}" style="height: 100px" alt="" srcset=""></p>
                    <p class="text-gray" style="color: #a9a8a8">Aucun manager pour l'instant</p>
                </div>
            </div>
            @endforelse

            <div class="col-lg-12" style="margin-top: 30px;">
                <div>
                    {{ $managers->links('vendor.pagination.bootstrap-5-fr') }}
                </div>
            </div>
            
        </div>
        --}}
    </div>
    <!--end::Container-->
</div>
@endsection

@push('scripts')
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