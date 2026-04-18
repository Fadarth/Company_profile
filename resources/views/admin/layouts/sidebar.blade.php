<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link d-flex align-items-center">
            <img src="{{ asset('images/logo-pemda.png') }}" alt="Logo Pemda" class="me-2"
                style="width: 40px; height: auto;">

            <span class="app-brand-text menu-text fw-bolder">Company Profile</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ url('admin/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen Konten</span>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
            <a href="{{ route('admin.hero.edit') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Hero Section">Hero Section</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.regions.*') ? 'active' : '' }}">
            <a href="{{ route('admin.regions.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image-alt"></i>
                <div data-i18n="Foto Daerah">Foto Daerah</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}">
            <a href="{{ route('admin.activities.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div data-i18n="Informasi Kegiatan">Informasi Kegiatan</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.organizations.*') ? 'active' : '' }}">
            <a href="{{ route('admin.organizations.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-file-pdf"></i>
                <div data-i18n="Data Organisasi">Data Organisasi</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen Dewan</span>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
            <a href="{{ route('admin.members.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Anggota Dewan">Anggota Dewan</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.council-equipments.*') ? 'active' : '' }}">
            <a href="{{ route('admin.council-equipments.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-briefcase-alt-2"></i>
                <div data-i18n="Alat Kelengkapan">Alat Kelengkapan</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.council-structures.*') ? 'active' : '' }}">
            <a href="{{ route('admin.council-structures.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-sitemap"></i>
                <div data-i18n="Struktural Dewan">Struktural Dewan</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Publikasi & Layanan</span>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <a href="{{ route('admin.news.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Berita">Berita</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.aspirations.*') ? 'active' : '' }}">
            <a href="{{ route('admin.aspirations.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-square-dots"></i>
                <div data-i18n="Aspirasi Masyarakat">Aspirasi Masyarakat</div>
            </a>
        </li>


        <ul class="menu-inner py-1">
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Autentikasi</span>
            </li>

            <li class="menu-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="javascript:void(0);" class="menu-link text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="menu-icon tf-icons bx bx-power-off"></i>
                    <div data-i18n="Logout">Log Out</div>
                </a>
            </li>
        </ul>
</aside>
