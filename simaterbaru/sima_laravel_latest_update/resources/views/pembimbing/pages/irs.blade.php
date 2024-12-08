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
                    @if($id)
                    <div class="card-title" style="margin-bottom:0;display: flex;justify-content: space-between;align-items: center;">
                      <div class="d-flex align-items-center gap-2" style="margin:0 20px;">
                        <a href="/mahasiswa?page=irs">
                          <button class="btn btn-primary">
                            <i class="bx bx-left-arrow-alt"></i>
                          </button>
                        </a>
                        <h5 class="text-nowrap" style="color:white;margin: 0;padding:20px;">Items IRS</h5>
                      </div>
                      <a href="/mahasiswa?page=irs&id=1&kr={{$kr}}&tr=1" style="margin: 20px;">
                        <button class="btn btn-primary">
                          <i class="bx bx-plus"></i> Tambah Matkul
                        </button>
                      </a>
                    </div>
                    <div class="mt-auto" style="width:100%;padding:20px;padding-top:0;">
                      @if(count($irs_mahasiswa_items)>0)
                      <table border="1" cellpadding="10" cellspacing="0" class="table table-responsive" style="background:white;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Semester</th>
                                <th>Kelas</th>
                                <th>SKS</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 0; ?>
                            <?php $map_status = ['unread'=>'Belum dibaca','read'=>'Dibaca']; ?>
                            @forelse($irs_mahasiswa_items as $item)
                                <?php $index += 1; ?>
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $item->mata_kuliah->nama }}</td>
                                    <td>{{ $item->mata_kuliah->semester }}</td>
                                    <td>A</td>
                                    <td>{{ $item->mata_kuliah->sks }}</td>
                                    <td>
                                      <div>
                                        <div class="d-flex align-items-center gap-2 justify-content-end">
                                          <form method="POST" action="/mahasiswa?page=irs&id=1&kr={{$kr}}">
                                            @csrf
                                            <input hidden name="mode" value="delete-matkul">
                                            <input hidden name="id" value="{{$item->id}}">
                                            <button class="btn btn-danger">Hapus</button>  
                                          </form>
                                        </div>
                                      </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Belum ada data irs.</td>
                                </tr>
                            @endforelse
                        </tbody>
                      </table>
                      @else
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
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
                              <div><i class="bx bx-x-circle" style="font-size:64px"></i></div>
                              <div>
                                <div><b>Belum Ada Data!</b></div>
                                <div style="font-size:16px">
                                  Anda belum menambahkan data matkul.
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                    </div>
                    @else
                    <div class="card-title" style="margin-bottom:0;display: flex;justify-content: space-between;align-items: center;">
                      <h5 class="text-nowrap" style="color:white;margin: 0;padding:20px;">Daftar IRS</h5>
                      <form method="POST" action="/mahasiswa?page=irs" style="margin: 20px;">
                        @csrf
                        <input hidden name="mode" value="new-irs">
                        <button class="btn btn-primary">
                          <i class="bx bx-plus"></i> Buat IRS
                        </button>
                      </form>
                    </div>
                    <div class="mt-auto" style="width:100%;padding:20px;padding-top:0;">
                      @if(count($irs_mahasiswa)>0)
                      <table border="1" cellpadding="10" cellspacing="0" class="table table-responsive" style="background:white;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>SKS</th>
                                <th>Status</th>
                                <th>Status Akses</th>
                                <th>Catatan</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 0; ?>
                            <?php $map_status = ['unread'=>'Belum dibaca','read'=>'Dibaca']; ?>
                            @forelse($irs_mahasiswa as $item)
                                <?php $index += 1; ?>
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $item->tahun_ajaran }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td>{{ !$item->sks?'0':$item->sks }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->status_lock_irs }}</td>
                                    <td>{{ !$item->catatan ? '-' : $item->catatan }}</td>
                                    <td>
                                      <div>
                                        <div class="d-flex align-items-center gap-2 justify-content-end">
                                          @if($item->status_lock_irs === 'open')
                                          <a href="/mahasiswa?page=irs&id=1&kr={{$item->id_irs}}">
                                            <button class="btn btn-secondary"><i class="bx bx-right-arrow-alt"></i></button>
                                          </a>
                                          @if($item->sks > 0)
                                          <form method="POST" action="/mahasiswa?page=irs&kr={{$item->id_irs}}">
                                            @csrf
                                            <input hidden name="mode" value="lock">
                                            <button class="btn btn-primary">
                                              <i class="bx bx-link-external"></i>
                                            </button>  
                                          </form>
                                          @endif
                                          @else
                                          <button class="btn btn-secondary"><i class="bx bx-lock" onclick="data_locked()"></i></button>
                                          @endif
                                        </div>
                                      </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Belum ada data irs.</td>
                                </tr>
                            @endforelse
                        </tbody>
                      </table>
                      @else
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
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
                              <div><i class="bx bx-x-circle" style="font-size:64px"></i></div>
                              <div>
                                <div><b>Belum Ada Data!</b></div>
                                <div style="font-size:16px">
                                  Anda belum memiliki data IRS.
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                    </div>
                    @endif
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
@if($tr)
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
    overflow: auto;
  }
  .card_overlay{
    width: 500px;
    background: white;
    margin-top:20px;
    border-radius:10px;
    margin-bottom:20px;
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
      Tambah Data Mata Kuliah
    </div>
    <div>
      <form method="POST" action="/mahasiswa?page=irs&kr={{$kr}}&id=1">
        @csrf
        <input hidden name="mode" value="add-matkul">
        <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
          <div class="mb-1">Mata Kuliah</div>
          <select required class="form-control" name=kode_mk>
            <option value="">Pilih Mata Kuliah</option>
            @foreach($mata_kuliah as $item)
            <option value="{{$item->id}}">{{$item->nama}} | {{$item->tahun_ajaran}}</option>
            @endforeach
          </select>
        </div>
        <div style="padding:20px;">
          <button class="btn btn-primary">Simpan</button>
          <a href="/mahasiswa?page=irs&id=1&kr={{$kr}}" class="btn btn-secondary">
            Batal
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
<script type="text/javascript">
  const data_locked = ()=>{
    Swal.fire({
      icon: "error",
      title: "Oops, Akses ditutup!",
      text: "Hubungi Dosen Wali anda untuk membukanya"
    });
  }
</script>
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