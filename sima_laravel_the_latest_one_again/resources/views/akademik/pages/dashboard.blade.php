@extends('akademik.layouts.index')
@section('title','SIMA: Dashboard Akademik')
@section('content')
<!-- Layout wrapper -->
<style type="text/css">
  .card-body{
    padding:20px !important;
  }
</style>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    @include('akademik.partials.menu',['active'=>$page])
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
            @include('akademik.partials.profile',['user'=>$user])
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
                      <i class="menu-icon tf-icons bx bx bx-cube" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between" style="width:100%;">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Total Fakultas</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{count($fakultas)}}</h3>
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
                      <i class="menu-icon tf-icons bx bx bx-cube" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between" style="width:100%;">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Total Program Studi</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{count($program_studi)}}</h3>
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
                      <i class="menu-icon tf-icons bx bx-bell" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between" style="width:100%;">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Total Notifikasi Belum Dibaca</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{count($notifikasi)}}</h3>
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
                      <i class="menu-icon tf-icons bx bx-building" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between" style="width:100%;">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Total Gedung</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{count($gedung)}}</h3>
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
                      <i class="menu-icon tf-icons bx bx-door-open" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Total Ruangan</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{count($ruangan)}}</h3>
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
                      <i class="menu-icon tf-icons bx bx-door-open" style="font-size:64px;"></i>
                    </div>
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                      <div class="card-title">
                        <h5 class="text-nowrap mb-2" style="color:white">Total Ruangan Kosong</h5>
                      </div>
                      <div class="mt-sm-auto">
                        <h3 class="mb-0">{{$ruangan_kosong}}</h3>
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
                        <h5 class="text-nowrap mb-2" style="color:white">Alokasi Ruang Pending</h5>
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
                        <h5 class="text-nowrap mb-2" style="color:white">Alokasi Ruang Disetujui</h5>
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
                        <h5 class="text-nowrap mb-2" style="color:white">Alokasi Ruang Ditolak</h5>
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
          </div>
        </div>
        <div class="container-xxl flex-grow-1 container-p-y" style="padding-bottom:0 !important;height:0;padding-top:0 !important;">
          <div class="row">
            <!-- Kolom Ruangan -->
            <div class="col-sm-12 col-md-6 mb-4">
              <div class="card">
                <div class="card-body" style="padding:0 !important;">
                  <div class="d-flex flex-column" style="width:100%;">
                    <div class="card-title" style="margin-bottom:0;">
                      <h5 class="text-nowrap" style="color:white;margin: 0;padding:20px;">Ruangan</h5>
                    </div>
                    <div class="mt-auto" style="width:100%;">
                      @if(count($gedung)>0)
                      <div class="table-responsive">
                        <table border="1" cellpadding="10" cellspacing="0" class="table" style="background:white;">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Ruangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $index = 0; ?>
                            @forelse($gedung as $item)
                            <?php $index += 1; ?>
                            <tr>
                              <td>{{ $index }}</td>
                              <td>{{ $item->nama }}</td>
                              <td>{{ $item->ruangan }}</td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="4">No users found.</td>
                            </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                      @else
                      <div style="padding:20px;">Data ruang belum tersedia!</div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Kolom Alokasi Ruangan -->
            <div class="col-sm-12 col-md-6 mb-4">
              <div class="card">
                <div class="card-body" style="padding:0 !important;">
                  <div class="d-flex flex-column" style="width:100%;">
                    <div class="card-title" style="margin-bottom:0;">
                      <h5 class="text-nowrap" style="color:white;margin: 0;padding:20px;">Alokasi Ruangan Belum Disetujui</h5>
                    </div>
                    <div class="mt-auto" style="width:100%;">
                      @if(count($valid_alokasi_ruang)>0)
                      <div class="table-responsive">
                        <table border="1" cellpadding="10" cellspacing="0" class="table" style="background:white;">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Fakultas</th>
                              <th>Program Studi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $index = 0; ?>
                            <?php $valid_alokasi_ruangan_pending = []; ?>
                            <?php 
                              foreach($valid_alokasi_ruang as $item){
                                if($item->status === 'pending' and count($valid_alokasi_ruangan_pending) < 5){
                                  $valid_alokasi_ruangan_pending[] = $item;
                                }
                              }
                            ?>
                            @forelse($valid_alokasi_ruangan_pending as $item)
                            <?php $index += 1; ?>
                            <tr>
                              <td>{{ $index }}</td>
                              <td>{{ $item->fakultas->nama }}</td>
                              <td>{{ $item->program_studi->nama }}</td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="4">No users found.</td>
                            </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                      @else
                      <div style="padding:20px;">Data alokasi belum tersedia!</div>
                      @endif
                    </div>
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