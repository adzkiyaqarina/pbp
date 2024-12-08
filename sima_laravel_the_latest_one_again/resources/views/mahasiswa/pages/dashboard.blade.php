@extends('mahasiswa.layouts.index')
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
    @include('mahasiswa.partials.menu',['active'=>$page])
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
            @include('mahasiswa.partials.profile',['user'=>$user])
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
                  height:400px;
                  display: flex;
                  flex-direction: column;
                  padding:0 !important;
                  position: relative;
                ">
                  <div style="
                    height: 100%;
                    background-image: url('/images/profile_box_bg.png');
                    background-size: contain;
                  ">
                    
                  </div>
                  <div style="
                    height: 100%;
                    background: #1e2b5f;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                  ">
                    <div>
                      <div>
                        <h3 style="color:white;">{{$data_mahasiswa->nama_lengkap}}</h3>
                      </div>
                      <div style="
                        color: #697a8d;
                        text-align: center;
                        font-size: 17px;
                      ">
                        <div>{{$data_mahasiswa->program_studi->nama}}</div>
                        <div>{{$data_mahasiswa->nim}}</div>
                      </div>
                    </div>
                  </div>
                  <!-- for top layer -->
                  <div style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                  ">
                    <div style="
                      width: 184px;
                      height: 184px;
                      border-radius: 50%;
                      overflow: hidden;
                      margin-bottom: 100px;
                      padding:10px;
                      background: white;
                    ">
                      <img src="/assets/img/avatars/1.png" style="width:100%;height:100%;border-radius: 50%;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-4">
              <div class="card">
                <div class="card-body" style="
                  height:400px;
                  display: flex;
                  flex-direction: column;
                  padding:0 !important;
                  position: relative;
                ">
                  <div style="
                    height: 100%;
                    background-image: url('/images/profile_box_bg.png');
                    background-size: contain;
                  ">
                    
                  </div>
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
                      border-right: 1px solid white;
                    ">
                      <div>
                        <h3 style="color:white;">IPK</h3>
                      </div>
                      <div style="
                        color: #697a8d;
                        text-align: center;
                        font-size: 48px;
                      ">
                        {{$data_mahasiswa->ipk}}
                      </div>
                    </div>
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
                        <h3 style="color:white;">SKS</h3>
                      </div>
                      <div style="
                        color: #697a8d;
                        text-align: center;
                        font-size: 48px;
                      ">
                        99
                      </div>
                    </div>
                  </div>
                  <!-- for top layer -->
                  <div style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                  ">
                    <div style="
                      border-radius: 40px;
                      overflow: hidden;
                      margin-bottom: 100px;
                      padding: 20px;
                      background: white;
                      color: black;
                      font-size: 24px;
                      font-weight: bold;
                    ">
                      Prestasi Akademik
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
                      <h5 class="text-nowrap" style="color:white;margin: 0;padding:20px;">Status Akademik</h5>
                    </div>
                    <div class="mt-auto" style="width:100%;padding:0 20px;">
                      <div class="row">
                        <div class="col-sm-12 col-md-6 mb-4">
                          <div class="card">
                            <div class="card-body" style="
                              display: flex;
                              padding:20px !important;
                              position: relative;
                              gap: 10px;
                              background: white;
                              color: black;
                              font-size: 24px;
                            ">
                              <div><i class="bx bx-user" style="font-size:64px"></i></div>
                              <div>
                                <div>{{$data_mahasiswa->dosen_wali->nama}}</div>
                                <div>NIP: {{$data_mahasiswa->dosen_wali->nip}}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-4">
                          <div class="card">
                            <div class="card-body" style="
                              display: flex;
                              padding:20px !important;
                              position: relative;
                              gap: 10px;
                              background: white;
                              color: black;
                              font-size: 24px;
                            ">
                              <div><i class="bx bx-time" style="font-size:64px"></i></div>
                              <div>
                                <div>Semester</div>
                                <div>{{$data_mahasiswa->semester}}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-md-6 mb-4">
                          <div class="card">
                            <div class="card-body" style="
                              display: flex;
                              padding:20px !important;
                              position: relative;
                              gap: 10px;
                              background: white;
                              color: black;
                              font-size: 24px;
                            ">
                              <div><i class="bx bx-time" style="font-size:64px"></i></div>
                              <div>
                                <div>Semester Akademik Sekarang</div>
                                <div>2024/2025 GANJIL</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-4">
                          <div class="card">
                            <div class="card-body" style="
                              display: flex;
                              padding:20px !important;
                              position: relative;
                              gap: 10px;
                              background: white;
                              color: black;
                              font-size: 24px;
                            ">
                              <div><i class="bx bx-book" style="font-size:64px"></i></div>
                              <div>
                                <div>Status Akademik</div>
                                <div>{{strtoupper($data_mahasiswa->status)}}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
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