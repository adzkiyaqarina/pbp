@extends('pembimbing.layouts.index')
@section('title','SIMA: Dashboard Dekan')
@section('content')
<!-- Layout wrapper -->
<style type="text/css">
  .card-body{
    padding:20px !important;
  }
</style>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    @include('pembimbing.partials.menu',['active'=>$page])
    <!-- Layout container -->
    <div class="layout-page" style="
      height: 100%;
      overflow: auto;
    ">
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
            @include('pembimbing.partials.profile',['user'=>$user])
          </ul>
        </div>
      </nav>

      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper" style="flex:none;">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y" style="padding-bottom:0 !important;">
          <div class="row">
            <div class="col-sm-12 col-md-6 mb-4">
              <div class="card">
                <div class="card-body" style="
                  height:200px;
                  display: flex;
                  flex-direction: column;
                  padding:0 !important;
                  position: relative;
                ">
                  <div style="
                    height: 100%;
                    display: flex;
                    align-items: center;
                    background: #1e2b5f;
                    justify-content: space-around;
                  ">
                    <div style="
                      width: 100%;
                      height: 80%;
                      text-align: center;
                      display: flex;
                      align-items: center;
                      flex-direction: column;
                      justify-content: center;
                      background: #1e2b5f;
                      border-left: 1px solid white;
                    ">
                      <div>
                        <h3 style="color:white;">Jumlah Mahasiswa</h3>
                      </div>
                      <div style="
                        color: #697a8d;
                        text-align: center;
                        font-size: 48px;
                        width: 60%;
                        border-top: 1px solid white;
                      ">
                        {{$jumlah_mahasiswa}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-4">
              <div class="card">
                <div class="card-body" style="
                  height:200px;
                  display: flex;
                  flex-direction: column;
                  padding:0 !important;
                  position: relative;
                ">
                  <div style="
                    height: 100%;
                    display: flex;
                    align-items: center;
                    background: #1e2b5f;
                    justify-content: space-around;
                  ">
                    <div style="
                      width: 100%;
                      height: 80%;
                      text-align: center;
                      display: flex;
                      align-items: center;
                      flex-direction: column;
                      justify-content: center;
                      background: #1e2b5f;
                      border-left: 1px solid white;
                    ">
                      <div>
                        <h3 style="color:white;">IRS Disetujui</h3>
                      </div>
                      <div style="
                        color: #697a8d;
                        text-align: center;
                        font-size: 48px;
                        width: 60%;
                        border-top: 1px solid white;
                      ">
                        {{$jumlah_irs_disetujui}}/{{$jumlah_mahasiswa}} Mahasiswa
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container-xxl flex-grow-1 container-p-y" style="padding-bottom:0 !important;height:0;padding-top:0 !important;">
          <div class="row">
            <!-- Kolom Alokasi Ruangan -->
            <div class="col-sm-12 col-md-12 mb-4">
              <div class="card">
                <div class="card-body" style="padding:0 !important;">
                  <div class="d-flex flex-column" style="width:100%;">
                    <div class="card-title" style="margin-bottom:0;">
                      <h5 class="text-nowrap" style="color:white;margin: 0;padding:20px;">Reminder Persetujuan IRS</h5>
                    </div>
                    <div class="mt-auto" style="width:100%;">
                      @if(count($data_irs_reminder)>0)
                      <div class="table-responsive">
                        <table border="1" cellpadding="10" cellspacing="0" class="table" style="background:white;">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Mahasiswa</th>
                              <th>Tahun Ajaran</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $index = 0; ?>
                            @forelse($data_irs_reminder as $item)
                            <?php $index += 1; ?>
                            <tr>
                              <td>{{ $index }}</td>
                              <td>{{ $item->mahasiswa->nama_lengkap }}</td>
                              <td>{{ $item->tahun_ajaran }}</td>
                              <td>
                                <a href="/pembimbing?page=perwalian&id=1&kr={{$item->id_irs}}">
                                  <button class="btn btn-primary">
                                    Cek Detail
                                  </button>
                                </a>
                              </td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="4">Belum ada data.</td>
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