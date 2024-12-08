@extends('kaprodi.layouts.index')
@section('title','SIMA: Dashboard Kaprodi')
@section('content')
<!-- Layout wrapper -->
<style type="text/css">
  .card-body{
    padding:20px !important;
  }
</style>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    @include('kaprodi.partials.menu',['active'=>$page])
    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->
      <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl align-items-center"
        id="layout-navbar" style="background-color: #1e2b5f !important;"
      >
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
          </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            @include('dekan.partials.profile',['user'=>$user])
          </ul>
        </div>
      </nav>

      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper" style="flex:none;">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y" style="padding-bottom:0 !important;">
          <div class="row">
            <div class="col-sm-12 col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="width:100%;">
                    <div>
                      <i class="menu-icon tf-icons bx bx-user" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between" style="width:100%;">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Total Mahasiswa</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{count($mahasiswa)}}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="width:100%;">
                    <div>
                      <i class="menu-icon tf-icons bx bx-user" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between" style="width:100%;">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Total Dosen</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{count($dosen)}}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-sm-row flex-column gap-3">
                    <div>
                      <i class="menu-icon tf-icons bx bx-bell" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Notifikasi Belum Dibaca</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{count($notifikasi)}}</h3>
                      </div>
                    </div>
                    <div id="profileReportChart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container-xxl flex-grow-1 container-p-y" style="padding-bottom:0 !important;padding-top:0 !important;">
          <div class="row">
            <div class="col-sm-12 col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="width:100%;">
                    <div>
                      <i class="menu-icon tf-icons bx bx-time" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between" style="width:100%;">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Jadwal Pending</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{$alokasi_pending}}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="width:100%;">
                    <div>
                      <i class="menu-icon tf-icons bx bx-check-circle" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between" style="width:100%;">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Jadwal Disetujui</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{$alokasi_approved}}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-sm-row flex-column gap-3">
                    <div>
                      <i class="menu-icon tf-icons bx bx-x-circle" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Jadwal Ditolak</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{$alokasi_rejected}}</h3>
                      </div>
                    </div>
                    <div id="profileReportChart"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-sm-row flex-column gap-3">
                    <div>
                      <i class="menu-icon tf-icons bx bx-book-open" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Total Matakuliah</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{count($mata_kuliah)}}</h3>
                      </div>
                    </div>
                    <div id="profileReportChart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- Footer -->
<!-- <footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
      ©
      <script>
        document.write(new Date().getFullYear());
      </script>
      SIMA
    </div>
    <div> -->
      <!-- <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
      <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

      <a
        href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
        target="_blank"
        class="footer-link me-4"
        >Documentation</a
      >

      <a
        href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
        target="_blank"
        class="footer-link me-4"
        >Support</a
      > -->
    <!-- </div>
  </div>
</footer> -->
<!-- / Footer -->
<!-- / Layout wrapper -->
@endsection