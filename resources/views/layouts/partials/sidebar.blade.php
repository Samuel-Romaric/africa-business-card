<aside class="app-sidebar " data-bs-theme="dark" style="background-color:#010140;color:white">
    <div class="sidebar-wrapper">
        <img src="{{ asset('/admin/assets/logo.png') }}" style="width: auto; height: 8em; display: block; margin: auto" alt="Africa business card Logo"
                class="brand-image  shadow">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                            data-accordion="false">
                <!-- Tableau de bord -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ isActiveRoute('admin.dashboard') }}" style="color:white">
                        <i class="nav-icon bi bi-speedometer2 text-white"></i>
                        <p>Tableau de bord</p>
                    </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manager.index') }}" class="nav-link {{ isActiveRoute('admin.manager.index') }}" style="color:white">
                                <i class="nav-icon bi bi-kanban text-white"></i>
                                <p>Manager</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link " style="color:white">
                                <i class="nav-icon bi bi-people text-white"></i>
                                <p>Commerciaux</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.business.index') }}" class="nav-link {{ isActiveRoute('admin.business.index') }} {{ isActiveRoute('admin.business.show') }}" style="color:white">
                                <i class="nav-icon bi bi-house-gear text-white"></i>
                                <p>Entreprise</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sales.index') }}" class="nav-link {{ isActiveRoute('admin.sales.index') }}" style="color:white">
                                <i class="nav-icon bi bi-bag text-white"></i>
                                <p>Ventes</p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="color:white">
                                <i class="nav-icon bi bi-journal-text text-white"></i>
                                <p>Rapports</p>
                            </a>
                        </li>
                        <!-- Paramètres -->
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="color:white">
                            <i class="nav-icon bi bi-gear text-white"></i>
                        <p>Paramètres</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
    <!--end::Sidebar Wrapper-->
</aside>