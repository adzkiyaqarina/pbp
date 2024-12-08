@extends('kaprodi.layouts.index')
@section('title','SIMA: Alokasi Ruang')
@section('content')
<!-- Layout wrapper -->
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
            @include('kaprodi.partials.profile',['user'=>$user])
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
                <span style="font-size:24px;font-weight: bold;color:white;">Mahasiswa</span>
                <a href="/kaprodi?page=mahasiswa&tr=1">
                  <button class="btn btn-primary">Tambah</button>
                </a>
              </h5>
              <div class="table-responsive text-nowrap" style="max-height: 500px;overflow: auto;">
                @if(count($mahasiswa)>0)
                <div>
                  <table border="1" cellpadding="10" cellspacing="0" class="table table-responsive" style="background:white;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Nim</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Fakultas</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>IPK</th>
                            <th>Pengampu</th>
                            <th>Sks Semester</th>
                            <th style="text-align:right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0; ?>
                        @forelse($mahasiswa as $item)
                            <?php $index += 1; ?>
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->telepon }}</td>
                                <td>{{ $item->fakultas->nama }}</td>
                                <td>{{ $item->program_studi->nama }}</td>
                                <td>{{ $item->angkatan }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->ipk }}</td>
                                <td>{{ $item->dosen_wali->nama }}</td>
                                <td>{{ $item->maks_sks }}</td>
                                <td>
                                  <div>
                                    <div class="d-flex align-items-center gap-2 justify-content-end">
                                      <a href="/kaprodi?page=mahasiswa&er=1&kr={{$item->id}}">
                                        <button class="btn btn-secondary">Edit</button>
                                      </a>
                                      <form method="POST" action="/kaprodi?page=mahasiswa">
                                        @csrf
                                        <input hidden name="mode" value="delete">
                                        <input hidden name="id" value="{{$item->id}}">
                                        <button class="btn btn-danger">Hapus</button>
                                      </form>
                                    </div>
                                  </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No mahasiswa found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                  </table>
                </div>
                @else
                <div style="padding:20px;">Data mahasiswa belum tersedia!</div>
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
        Tambah Data Mahasiswa
      </div>
      <div>
        <form method="POST" action="/kaprodi?page=mahasiswa">
          @csrf
          <input hidden name="mode" value="add">
          <div style="padding:20px;padding-bottom:10px;">
            <div class="mb-1">Akun Mahasiswa</div>
            <select required class="form-control" name=user_id>
              <option value="">Pilih Akun</option>
              @foreach($akun_mahasiswa as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Nama Lengkap</div>
            <input required class="form-control" placeholder="Masukan nama lengkap..." name="nama_lengkap">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Jenis Kelamin</div>
            <select required class="form-control" name=jenis_kelamin id=jenis_kelamin>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="tidak diketahui">Tidak Diketahui</option>
              <option value="laki-laki">Laki-Laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Fakultas</div>
            <select required class="form-control" name=id_fakultas onchange="show_opsi_prodi(this.value)">
              <option value="">Pilih Fakultas</option>
              @foreach($fakultas as $item)
              <option value="{{$item->id_fakultas}}">{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top: 10px;">
            <div class="mb-1">Program Studi</div>
            <select required class="form-control" name=id_prodi id=prodi_selector>
              <option value="">Pilih Program Studi</option>
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Alamat</div>
            <input required class="form-control" placeholder="Masukan alamat lengkap..." name="alamat">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Telepon</div>
            <input required class="form-control" placeholder="Masukan nomor telepon..." name="telepon" type="number">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Angkatan</div>
            <input required class="form-control" placeholder="Masukan angkatan..." name="angkatan" type="number">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Semester</div>
            <input required class="form-control" placeholder="Masukan angkatan..." name="semester" type="number">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Jumlah Sks Semester</div>
            <input required class="form-control" placeholder="Masukan jumlah sks semester..." name="maks_sks" type="number">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Dosen Pengampu</div>
            <select required class="form-control" name=wali_dosen>
              <option value="">Pilih Dosen Pengampu</option>
              @foreach($dosen as $item)
              <option value="{{$item->user_id}}">{{$item->nama}}</option>
              @endforeach
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
    const data_prodi = @json($program_studi);
    const prodi_selector = document.querySelector('#prodi_selector');
    const show_opsi_prodi = (id_fakultas)=>{
      prodi_selector.innerHTML = '<option value="">Pilih Program Studi</option>';
      data_prodi.forEach((prodi)=>{
        if(prodi.id_fakultas === Number(id_fakultas)){
          prodi_selector.innerHTML += `
            <option value="${prodi.id_prodi}">${prodi.nama}</option>
          `;
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
        Edit Data Mahasiswa
      </div>
      <div>
        <form method="POST" action="/kaprodi?page=mahasiswa">
          @csrf
          <input hidden name="mode" value="edit">
          <input hidden name="id" value="{{$toEdit->id}}">
          <div style="padding:20px;padding-bottom:10px;">
            <div class="mb-1">Akun Mahasiswa</div>
            <select required class="form-control" name=user_id>
              <option value="">Pilih Akun</option>
              @foreach($akun_mahasiswa_all as $item)
              <option value="{{$item->id}}" {{$item->id === $toEdit->user_id ? 'selected' : ''}}>{{$item->name}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Nama Lengkap</div>
            <input required class="form-control" placeholder="Masukan nama lengkap..." name="nama_lengkap" value="{{$toEdit->nama_lengkap}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Jenis Kelamin</div>
            <select required class="form-control" name=jenis_kelamin id=jenis_kelamin>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="tidak diketahui" {{$toEdit->jenis_kelamin === 'tidak diketahui' ? 'selected' : ''}}>Tidak Diketahui</option>
              <option value="laki-laki" {{$toEdit->jenis_kelamin === 'laki-laki' ? 'selected' : ''}}>Laki-Laki</option>
              <option value="perempuan" {{$toEdit->jenis_kelamin === 'perempuan' ? 'selected' : ''}}>Perempuan</option>
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Fakultas</div>
            <select required class="form-control" name=id_fakultas onchange="show_opsi_prodi(this.value)">
              <option value="">Pilih Fakultas</option>
              @foreach($fakultas as $item)
              <option value="{{$item->id_fakultas}}" {{$toEdit->id_fakultas === $item->id_fakultas ? 'selected' : ''}}>{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top: 10px;">
            <div class="mb-1">Program Studi</div>
            <select required class="form-control" name=id_prodi id=prodi_selector>
              <option value="">Pilih Program Studi</option>
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Alamat</div>
            <input required class="form-control" placeholder="Masukan alamat lengkap..." name="alamat" value="{{$toEdit->alamat}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Telepon</div>
            <input required class="form-control" placeholder="Masukan nomor telepon..." name="telepon" type="number" value="{{$toEdit->telepon}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Angkatan</div>
            <input required class="form-control" placeholder="Masukan angkatan..." name="angkatan" type="number" value="{{$toEdit->angkatan}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Semester</div>
            <input required class="form-control" placeholder="Masukan angkatan..." name="semester" type="number" value="{{$toEdit->semester}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Jumlah Sks Semester</div>
            <input required class="form-control" placeholder="Masukan jumlah sks semester..." name="maks_sks" type="number" value="{{$toEdit->maks_sks}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Status</div>
            <select class="form-control" required name="status">
              <option value="">Pilih Status</option>
              <option value="aktif" {{$toEdit->status === 'aktif' ? 'selected' : ''}}>Aktif</option>
              <option value="cuti" {{$toEdit->status === 'cuti' ? 'selected' : ''}}>Cuti</option>
              <option value="lulus" {{$toEdit->status === 'lulus' ? 'selected' : ''}}>Lulus</option>
              <option value="keluar" {{$toEdit->status === 'keluar' ? 'selected' : ''}}>Keluar</option>
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Dosen Pengampu</div>
            <select required class="form-control" name=wali_dosen>
              <option value="">Pilih Dosen Pengampu</option>
              @foreach($dosen as $item)
              <option value="{{$item->user_id}}" {{$toEdit->wali_dosen === $item->user_id ? 'selected' : ''}}>{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;">
            <button class="btn btn-primary">Simpan</button>
            <a href="/kaprodi?page=mahasiswa" class="btn btn-secondary">
              Batal
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    const toEdit = @json($toEdit);
    const data_prodi = @json($program_studi);
    const prodi_selector = document.querySelector('#prodi_selector');
    const show_opsi_prodi = (id_fakultas,first=false)=>{
      prodi_selector.innerHTML = '<option value="">Pilih Program Studi</option>';
      data_prodi.forEach((prodi)=>{
        if(prodi.id_fakultas === Number(id_fakultas)){
          if(first){
            if(prodi.id_prodi === toEdit.id_prodi){
              prodi_selector.innerHTML += `
                <option value="${prodi.id_prodi}" selected>${prodi.nama}</option>
              `;
            }else{
              prodi_selector.innerHTML += `
                <option value="${prodi.id_prodi}">${prodi.nama}</option>
              `;
            }
          }else{
            prodi_selector.innerHTML += `
              <option value="${prodi.id_prodi}">${prodi.nama}</option>
            `;
          }
        }
      })
    }
    show_opsi_prodi(toEdit.id_fakultas,true)
  </script>
  @endif
</div>
<!-- / Layout wrapper -->
@endsection