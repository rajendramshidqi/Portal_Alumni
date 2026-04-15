<aside class="left-sidebar modern-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-20">

                {{-- TITLE --}}
                <li class="sidebar-title">MENU UTAMA</li>

                {{-- DASHBOARD --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{route('admin.dashboard')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                {{-- LOKER --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin.informasi_loker.*') ? 'active' : '' }}"
                        href="{{route('admin.informasi_loker.index')}}">
                        <i class="mdi mdi-briefcase-outline"></i>
                        <span class="hide-menu">Informasi Loker</span>
                    </a>
                </li>

                {{-- USER --}}
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                        href="{{route('admin.users.index')}}">
                        <i class="mdi mdi-account-group-outline"></i>
                        <span class="hide-menu">Daftar User</span>
                    </a>
                </li>

                {{-- TITLE --}}
                <li class="sidebar-title mt-3">MASTER DATA</li>

                {{-- KATEGORI --}}
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ request()->is('admin/kategori_*') ? 'active' : '' }}"
                        href="javascript:void(0)">
                        <i class="mdi mdi-shape-outline"></i>
                        <span class="hide-menu">Kategori</span>
                    </a>

                    <ul class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('admin.kategori_loker.index')}}"
                                class="sidebar-link {{ request()->routeIs('admin.kategori_loker.*') ? 'active-sub' : '' }}">
                                <i class="mdi mdi-circle-small"></i>
                                <span class="hide-menu">Loker</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('admin.kategori_forum.index')}}"
                                class="sidebar-link {{ request()->routeIs('admin.kategori_forum.*') ? 'active-sub' : '' }}">
                                <i class="mdi mdi-circle-small"></i>
                                <span class="hide-menu">Forum</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>

{{-- STYLE CUSTOM --}}
<style>
.modern-sidebar {
    background: linear-gradient(180deg, #0f172a, #1e293b);
    color: #cbd5f5;
}

.sidebar-title {
    font-size: 12px;
    font-weight: 600;
    color: #94a3b8;
    padding: 10px 20px;
    letter-spacing: 1px;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    border-radius: 10px;
    margin: 4px 10px;
    color: #cbd5f5;
    transition: all 0.2s ease;
}

.sidebar-link i {
    font-size: 18px;
}

.sidebar-link:hover {
    background: rgba(255, 255, 255, 0.05);
    color: #fff;
    transform: translateX(4px);
}

/* ACTIVE */
.sidebar-link.active {
    background: linear-gradient(90deg, #3b82f6, #6366f1);
    color: #fff;
    font-weight: 600;
    box-shadow: 0 4px 10px rgba(59,130,246,0.3);
}

/* SUB ACTIVE */
.sidebar-link.active-sub {
    color: #60a5fa;
    font-weight: 600;
}

/* SUB MENU */
.first-level {
    padding-left: 10px;
}

.first-level .sidebar-link {
    font-size: 14px;
}
</style>