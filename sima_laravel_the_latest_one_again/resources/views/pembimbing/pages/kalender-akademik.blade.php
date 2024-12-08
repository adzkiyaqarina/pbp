@extends('pembimbing.layouts.index')
@section('title','SIMA: Kalender Akademik')
@section('content')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    @include('pembimbing.partials.menu',['active'=>$page])
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
            @include('pembimbing.partials.profile',['user'=>$user])
          </ul>
        </div>
      </nav>

      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <!-- Basic Bootstrap Table -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-header d-flex align-items-center justify-content-between">
                <span style="font-size:24px;font-weight: bold;color:white;">Kalender Akademik</span>
                <!-- <a href="/akademik?page=kalender-akademik&ck=1">
                  <button class="btn btn-primary">Ubah</button>
                </a> -->
              </h5>
              <div class="table-responsive text-nowrap" style="height:500px;overflow: hidden;">
                @if($kalender_akademik)
                <iframe src="/uploads/{{$kalender_akademik}}" style="width: 100%;height: 100%;"></iframe>
                @else
                <div style="padding:20px;">Data Belum Tersedia!</div>
                @endif
              </div>
            </div>
          </div>
        <!-- / Content -->
        </div>
        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>

  <!-- overlay for change akademik value -->
  @if($ck)
  <style>
    .overlay_high{
      position: fixed;
      top:0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #00000085;
      z-index:100000;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }
    .card_overlay{
      width: 500px;
      background: white;
      margin-top:20px;
      border-radius:10px;
    }
    .overlay_header{
      padding:20px;
      border-bottom:1px solid gainsboro;
      font-size: 24px;
      margin-bottom:10px;
    }
  </style>
  <div class="overlay_high">
    <div class="card_overlay">
      <div class="overlay_header">
        Pilih File Kalender
      </div>
      <div>
        <form method="POST" enctype="multipart/form-data" action="/akademik?page=kalender-akademik">
          @csrf
          <div style="padding:20px;">
            <input type="file" name="kalender_akademik" accept="document/pdf">
          </div>
          <div style="padding:20px;">
            <button class="btn btn-primary">Simpan</button>
            <a href="/akademik?page=kalender-akademik" class="btn btn-secondary">
              Batal
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endif
</div>
<!-- / Layout wrapper -->
@endsection