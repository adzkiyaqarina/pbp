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
        <div class="container-xxl flex-grow-1 container-p-y" style="padding-bottom:0 !important;height:0;padding-top:0 !important;margin-top:20px;">
          <div class="row">
            <!-- Kolom Alokasi Ruangan -->
            <div class="col-sm-12 col-md-12 mb-4">
              <div class="card">
                <div class="card-body" style="padding:0 !important;">
                  <div class="d-flex flex-column" style="width:100%;">
                    <div class="card-title" style="margin-bottom:0;display: flex;justify-content: space-between;align-items: center;">
                      <h5 class="text-nowrap" style="color:white;margin: 0;padding:20px;">Pilih Status Akademik</h5>
                      <form method="POST" action="/mahasiswa?page=registrasi">
                        @csrf
                        <input name="id_mahasiswa" value="{{$data_mahasiswa->id}}" hidden>
                        <input name="mode" value="set-status" hidden>
                        <input id="status_input" name="status" hidden>
                        <button class="btn btn-primary d-flex gap-2" style="margin:20px;">
                          <i class="bx bx-save"></i>Simpan Status
                        </button>
                      </form>
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
                              cursor: pointer;
                            " onclick="selectStatus(this,1)" id=card-1>
                              <div><i class="bx bx-check-circle" style="font-size:64px"></i></div>
                              <div>
                                <div><b>AKTIF</b></div>
                                <div style="font-size:16px">
                                  Anda akan mengikuti kegiatan perkuliahan pada semester ini serta mengisi Isian Rencana Studi (IRS).
                                </div>
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
                              cursor: pointer;
                            " onclick="selectStatus(this,2)" id=card-2>
                              <div><i class="bx bx-x-circle" style="font-size:64px"></i></div>
                              <div>
                                <div><b>CUTI</b></div>
                                <div style="font-size:16px">
                                  Menghentikan kuliah sementara untuk semester ini tanpa kehilangan status sebagai mahasiswa Undip.
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
        </div>
        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <script>
    let element_old = null;
    const selectStatus = (element,state)=>{
      element.style.background = state === 1 ? '#00a846' : '#ff0000';
      element.style.color = 'white';
      if(element_old){
        element_old.style.color = 'black';
        element_old.style.background = 'white';
      }
      element_old = element;
      const status_input = document.querySelector('#status_input');
      if(state === 1){
        status_input.value = 'aktif';
      }else{
        status_input.value = 'cuti';
      }
    }
    @if($data_mahasiswa->status === 'aktif')
    selectStatus(document.querySelector('#card-1'),1);
    @else
    selectStatus(document.querySelector('#card-2'),2);
    @endif
  </script>

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