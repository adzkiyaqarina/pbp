<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo" style="
    margin-top:30px;justify-content: center;padding-bottom:30px;
  ">
    <a href="/" class="app-brand-link">
      <img src="/images/simaicon.png" width="128">
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none" id=sm-toggle>
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Home</span>
    </li>
    <!-- Dashboard -->
    <li class="menu-item {{$active === 'dashboard' ? 'active' : ''}}">
      <a href="?page=dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>
    <li class="menu-item {{$active === 'notification' ? 'active' : ''}}">
      <a href="?page=notification" class="menu-link">
        <i class="menu-icon tf-icons bx bx-bell"></i>
        <div data-i18n="Analytics">Notification</div>
      </a>
    </li>
    <li class="menu-item {{$active === 'kalender-akademik' ? 'active' : ''}}">
      <a href="?page=kalender-akademik" class="menu-link">
        <i class="menu-icon tf-icons bx bx-book"></i>
        <div data-i18n="Analytics">Kalender Akademik</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Data</span>
    </li>
    <li class="menu-item {{$active === 'fakultas' ? 'active' : ''}}">
      <a href="?page=fakultas" class="menu-link">
        <i class="menu-icon tf-icons bx bx bx-cube"></i>
        <div data-i18n="Account Settings">Fakultas</div>
      </a>
    </li>
    <li class="menu-item {{$active === 'program-studi' ? 'active' : ''}}">
      <a href="?page=program-studi" class="menu-link">
        <i class="menu-icon tf-icons bx bx bx-cube"></i>
        <div data-i18n="Account Settings">Program Studi</div>
      </a>
    </li>
    <li class="menu-item {{$active === 'manajemen-gedung' ? 'active' : ''}}">
      <a href="?page=manajemen-gedung" class="menu-link">
        <i class="menu-icon tf-icons bx bx-building"></i>
        <div data-i18n="Account Settings">Manajemen Gedung</div>
      </a>
    </li>
    <li class="menu-item {{$active === 'manajemen-ruangan' ? 'active' : ''}}">
      <a href="?page=manajemen-ruangan" class="menu-link">
        <i class="menu-icon tf-icons bx bx-door-open"></i>
        <div data-i18n="Account Settings">Manajemen Ruangan</div>
      </a>
    </li>
    <li class="menu-item {{$active === 'alokasi-ruangan' ? 'active' : ''}}">
      <a href="?page=alokasi-ruangan" class="menu-link">
        <i class="menu-icon tf-icons bx bx-grid-alt"></i>
        <div data-i18n="Account Settings">Alokasi Ruangan</div>
      </a>
    </li>
  </ul>
</aside>
<!-- / Menu -->