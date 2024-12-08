@extends('akademik.layouts.index')
@section('title','SIMA: Manajemen Ruangan')
@section('content')
<!-- Layout wrapper -->
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
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <!-- Basic Bootstrap Table -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-header d-flex align-items-center justify-content-between">
                <span style="font-size:24px;font-weight: bold;color:white;">Manajemen Ruangan</span>
                <a href="/akademik?page=manajemen-ruangan&tr=1">
                  <button class="btn btn-primary">Tambah Ruangan</button>
                </a>
              </h5>
              <div class="table-responsive text-nowrap" style="max-height: 500px;overflow: auto;">
                @if(count($ruangan)>0)
                <div>
                  <table border="1" cellpadding="10" cellspacing="0" class="table table-responsive" style="background:white;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gedung</th>
                            <th>Nama</th>
                            <th>Kapasitas</th>
                            <th style="text-align:right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0; ?>
                        @forelse($ruangan as $item)
                            <?php $index += 1; ?>
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->nama_gedung }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kapasitas }}</td>
                                <td>
                                  <div>
                                    <div class="d-flex align-items-center gap-2 justify-content-end">
                                      <a href="/akademik?page=manajemen-ruangan&er=1&kr={{$item->kode_ruang}}">
                                        <button class="btn btn-secondary">Edit</button>
                                      </a>
                                      <form method="POST" action="/akademik?page=manajemen-ruangan">
                                        @csrf
                                        <input hidden name="mode" value="delete">
                                        <input hidden name="id" value="{{$item->kode_ruang}}">
                                        <button class="btn btn-danger">Hapus</button>
                                      </form>
                                    </div>
                                  </div>
                                </td>
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
                <div style="padding:20px;">Data ruangan belum tersedia!</div>
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
        Tambah Data Ruangan
      </div>
      <div>
        <form method="POST" action="/akademik?page=manajemen-ruangan">
          @csrf
          <input hidden name="mode" value="add">
          <div style="padding:20px;padding-bottom:10px;">
            <div class="mb-1">Nama Gedung</div>
            <select required class="form-control" name=gedung_id>
              <option value="">Pilih Gedung</option>
              @foreach($gedung as $item)
              <option value="{{$item->id}}">{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Nama Ruangan</div>
            <input type="text" name="nama" class="form-control">
          </div>
          <div style="padding:0 20px 10px 20px;">
            <div class="mb-1">Kapasitas Ruangan</div>
            <input type="number" name="kapasitas" class="form-control">
          </div>
          <div style="padding:20px;">
            <button class="btn btn-primary">Simpan</button>
            <a href="/akademik?page=manajemen-ruangan" class="btn btn-secondary">
              Batal
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endif
  @if($er)
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
        Edit Data Ruangan
      </div>
      <div>
        <form method="POST" action="/akademik?page=manajemen-ruangan">
          @csrf
          <input hidden name="mode" value="edit">
          <input hidden type="number" name="ruang_id" value="{{$toEdit->kode_ruang}}">
          <div style="padding:20px;padding-bottom:10px;">
            <div class="mb-1">Nama Gedung</div>
            <select required class="form-control" name=gedung_id>
              <option value="">Pilih Gedung</option>
              @foreach($gedung as $item)
              <option value="{{$item->id}}" {{$toEdit->gedung_id === $item->id ? 'selected' : ''}}>{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Nama Ruangan</div>
            <input type="text" name="nama" class="form-control" value="{{$toEdit->nama}}">
          </div>
          <div style="padding:0 20px 10px 20px;">
            <div class="mb-1">Kapasitas Ruangan</div>
            <input type="number" name="kapasitas" class="form-control" value="{{$toEdit->kapasitas}}">
          </div>
          <div style="padding:20px;">
            <button class="btn btn-primary">Simpan</button>
            <a href="/akademik?page=manajemen-ruangan" class="btn btn-secondary">
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