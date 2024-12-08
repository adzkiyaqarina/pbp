@extends('pembimbing.layouts.index')
@section('title','SIMA: Notifikasi')
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
                <span style="font-size:24px;font-weight: bold;color:white;">Notifikasi Anda</span>
              </h5>
              <div class="table-responsive text-nowrap" style="max-height: 500px;overflow: auto;">
                @if(count($notifikasi)>0)
                <div>
                  <table border="1" cellpadding="10" cellspacing="0" class="table table-responsive" style="background:white;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Teks</th>
                            <th>Status</th>
                            <th style="text-align:right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0; ?>
                        <?php $map_status = ['unread'=>'Belum dibaca','read'=>'Dibaca']; ?>
                        @forelse($notifikasi as $item)
                            <?php $index += 1; ?>
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ substr($item->teks,0,64) }}...</td>
                                <td>{{ $map_status[$item->status] }}</td>
                                <td>
                                  <div>
                                    <div class="d-flex align-items-center gap-2 justify-content-end">
                                      <a href="/mahasiswa?page=notification&er=1&kr={{$item->id}}">
                                        <button class="btn btn-secondary">Baca</button>
                                      </a>
                                      <!-- <form method="POST" action="/akademik?page=notification&tr=1">
                                        @csrf
                                        <input hidden name="mode" value="read">
                                        <input hidden name="id" value="{{$item->id}}">
                                        <button class="btn btn-secondary">Baca</button>  
                                      </form> -->
                                    </div>
                                  </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Belum ada notifikasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                  </table>
                </div>
                @else
                <div style="padding:20px;">Belum ada notifikasi</div>
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
        <form method="POST" action="/akademik?page=alokasi-ruangan">
          @csrf
          <input hidden name="mode" value="add">
          <div style="padding:20px;padding-bottom:10px;">
            <div class="mb-1">Nama Departemen</div>
            <select required class="form-control" name=id_departemen>
              <option value="">Pilih Departemen</option>
              @foreach($departemen_alokasi as $item)
              <option value="{{$item->id}}">{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Nama Gedung</div>
            <select required class="form-control" name=id_gedung onchange="show_opsi_ruangan(this.value)">
              <option value="">Pilih Gedung</option>
              @foreach($gedung as $item)
              <option value="{{$item->id}}">{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Nama Ruangan</div>
            <select required class="form-control" name=id_ruangan id=id_ruangan>
              <option value="">Pilih Ruangan</option>
            </select>
          </div>
          <div style="padding:20px;">
            <button class="btn btn-primary">Simpan</button>
            <a href="/akademik?page=alokasi-ruangan" class="btn btn-secondary">
              Batal
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    const data_gedung = @json($gedung);
    const ruangan_selector = document.querySelector('#id_ruangan');
    const show_opsi_ruangan = (id_gedung)=>{
      console.log(data_gedung,id_gedung);
      data_gedung.forEach((gedung)=>{
        if(gedung.id === Number(id_gedung)){
          ruangan_selector.innerHTML = '<option value="">Pilih Ruangan</option>';
          gedung.data_ruangan.forEach((ruangan)=>{
            if(!ruangan.terpakai){
              ruangan_selector.innerHTML += `
                <option value="${ruangan.kode_ruang}">${ruangan.nama}</option>
              `;
            }
          })
        }
      })
    }
  </script>
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
        Baca Notifikasi
      </div>
      <div>
        <form method="POST" action="/dekan?page=notification">
          @csrf
          <input hidden name="mode" value="read">
          <input hidden name="id" value="{{$toEdit->id}}">
          <div style="padding:20px;padding-bottom:10px;">
            <div class="mb-1">Tanggal</div>
            <input class="form-control" value="<?= $toEdit->created_at ?>" readonly>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Teks</div>
            <div>
              <textarea readonly class="form-control" style="height:200px;">{{ $toEdit->teks }}</textarea>
            </div>
          </div>
          <div style="padding:20px;">
            <button class="btn btn-primary">Selesai</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    const data_gedung = @json($gedung);
    const toEdit = @json($toEdit);
    const ruangan_selector = document.querySelector('#id_ruangan');
    const show_opsi_ruangan = (id_gedung,first=false)=>{
      console.log(toEdit,data_gedung);
      data_gedung.forEach((gedung)=>{
        if(gedung.id === Number(id_gedung)){
          ruangan_selector.innerHTML = '<option value="">Pilih Ruangan</option>';
          gedung.data_ruangan.forEach((ruangan)=>{
            if(!ruangan.terpakai || ruangan.kode_ruang === toEdit.id_ruang){
              if(first){
                if(ruangan.kode_ruang === toEdit.id_ruang){
                  ruangan_selector.innerHTML += `
                    <option selected value="${ruangan.kode_ruang}">${ruangan.nama}</option>
                  `;
                }else{
                  ruangan_selector.innerHTML += `
                    <option value="${ruangan.kode_ruang}">${ruangan.nama}</option>
                  `;
                }
              }else{
                ruangan_selector.innerHTML += `
                  <option value="${ruangan.kode_ruang}">${ruangan.nama}</option>
                `;
              }
            }
          })
        }
      })
    }
    show_opsi_ruangan(toEdit.id_gedung,true);
  </script>
  @endif
</div>
<!-- / Layout wrapper -->
@endsection