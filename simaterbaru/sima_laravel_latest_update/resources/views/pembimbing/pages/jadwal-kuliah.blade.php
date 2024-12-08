@extends('kaprodi.layouts.index')
@section('title','SIMA: Alokasi Ruang')
@section('content')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    @include('dekan.partials.menu',['active'=>$page])
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
                <span style="font-size:24px;font-weight: bold;color:white;">Jadwal Kuliah</span>
                <a href="/dekan?page=jadwal-kuliah&om=1">
                  <button class="btn btn-primary d-flex align-items-center" style="gap: 10px;"><i class="bx bx-calendar" style="font-size:18px;"></i> Lihat Kalender</button>
                </a>
              </h5>
              <div class="table-responsive text-nowrap" style="max-height: 500px;overflow: auto;">
                @if(count($jadwal_kuliah)>0)
                <div>
                  <table border="1" cellpadding="10" cellspacing="0" class="table table-responsive" style="background:white;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Matkul</th>
                            <th>Dosen</th>
                            <th>Kelas</th>
                            <th>Ruangan</th>
                            <th>Hari</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Status</th>
                            <th style="text-align:right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0; ?>
                        @forelse($jadwal_kuliah as $item)
                            <?php $index += 1; ?>
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>{{ $item->tahun_ajaran }}</td>
                                <td>{{ $item->mata_kuliah->nama }}</td>
                                <td>{{ $item->dosen->nama }}</td>
                                <td>{{ $item->kelas }}</td>
                                <td>{{ $item->ruangan->nama }}</td>
                                <td>{{ $item->hari }}</td>
                                <td>{{ $item->waktu_mulai }}</td>
                                <td>{{ $item->waktu_selesai }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                  <div>
                                    <div class="d-flex align-items-center gap-2 justify-content-end">
                                      <form method="POST" action="/dekan?page=jadwal-kuliah">
                                        @csrf
                                        <input hidden name="mode" value="approved">
                                        <input hidden name="id" value="{{$item->id_jadwal}}">
                                        <button class="btn btn-primary">Setujui</button>
                                      </form>
                                      <form method="POST" action="/dekan?page=jadwal-kuliah">
                                        @csrf
                                        <input hidden name="mode" value="delete">
                                        <input hidden name="id" value="{{$item->id_jadwal}}">
                                        <button class="btn btn-danger">Tolak</button>
                                      </form>
                                    </div>
                                  </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No jadwal kuliah found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                  </table>
                </div>
                @else
                <div style="padding:20px;">Data jadwal kuliah belum tersedia!</div>
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
        Tambah Data Jadwal
      </div>
      <div>
        <form method="POST" action="/kaprodi?page=jadwal-kuliah">
          @csrf
          <input hidden name="mode" value="add">
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Mata Kuliah</div>
            <select required class="form-control" name=kode_mk>
              <option value="">Pilih Mata Kuliah</option>
              @foreach($mata_kuliah as $item)
              <option value="{{$item->kode_mk}}">{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Gedung</div>
            <select required class="form-control" name=id_gedung onchange="show_opsi_ruangan(this.value)">
              <option value="">Pilih Gedung</option>
              @foreach($gedung as $item)
              <option value="{{$item->id}}">{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Ruangan</div>
            <select required class="form-control" name=id_ruangan id="id_ruangan">
              <option value="">Pilih Ruangan</option>
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Kelas</div>
            <input required name="kelas" placeholder="Masukan kelas..." class="form-control">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Tahun Ajaran</div>
            <input type="number" required name="tahun_ajaran" placeholder="Masukan tahun ajaran..." class="form-control">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Semester</div>
            <input type="number" required name="semester" placeholder="Masukan semester..." class="form-control">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Waktu Mulai</div>
            <input type="time" required name="waktu_mulai" class="form-control">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Waktu Selesai</div>
            <input type="time" required name="waktu_selesai" class="form-control">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Hari</div>
            <select class="form-control" name="hari" required>
              <option value="">Pilih Hari</option>
              <option value="senin">Senin</option>
              <option value="selasa">Selasa</option>
              <option value="rabu">Rabu</option>
              <option value="kamis">Kamis</option>
              <option value="jumat">Jumat</option>
              <option value="sabtu">Sabtu</option>
            </select>
          </div>
          <div style="padding:20px;">
            <button class="btn btn-primary">Simpan</button>
            <a href="/kaprodi?page=jadwal-kuliah" class="btn btn-secondary">
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
            ruangan_selector.innerHTML += `
              <option value="${ruangan.kode_ruang}">${ruangan.nama}</option>
            `;
          })
        }
      })
    }
    // const data_prodi = @json($program_studi);
    // const prodi_selector = document.querySelector('#prodi_selector');
    // const show_opsi_prodi = (id_fakultas)=>{
    //   prodi_selector.innerHTML = '<option value="">Pilih Program Studi</option>';
    //   data_prodi.forEach((prodi)=>{
    //     if(prodi.id_fakultas === Number(id_fakultas)){
    //       prodi_selector.innerHTML += `
    //         <option value="${prodi.id_prodi}">${prodi.nama}</option>
    //       `;
    //     }
    //   })
    // }
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
        Edit Data Jadwal
      </div>
      <div>
        <form method="POST" action="/kaprodi?page=jadwal-kuliah">
          @csrf
          <input hidden name="mode" value="edit">
          <input hidden name="id" value="{{$toEdit->id_jadwal}}">
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Mata Kuliah</div>
            <select required class="form-control" name=kode_mk>
              <option value="">Pilih Mata Kuliah</option>
              @foreach($mata_kuliah as $item)
              <option value="{{$item->kode_mk}}" {{$toEdit->kode_mk === $item->kode_mk ? 'selected' : ''}}>{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Gedung</div>
            <select class="form-control" name=id_gedung onchange="show_opsi_ruangan(this.value)">
              <option value="">Pilih Gedung</option>
              @foreach($gedung as $item)
              <option value="{{$item->id}}">{{$item->nama}}</option>
              @endforeach
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Ruangan</div>
            <select required class="form-control" name=id_ruangan id="id_ruangan">
              <option value="">Pilih Ruangan</option>
              <option value="{{$toEdit->ruangan->kode_ruang}}" selected>{{$toEdit->ruangan->nama}}</option>
            </select>
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Kelas</div>
            <input required name="kelas" placeholder="Masukan kelas..." class="form-control" value="{{$toEdit->kelas}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Tahun Ajaran</div>
            <input type="number" required name="tahun_ajaran" placeholder="Masukan tahun ajaran..." class="form-control" value="{{$toEdit->tahun_ajaran}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Semester</div>
            <input type="number" required name="semester" placeholder="Masukan semester..." class="form-control" value="{{$toEdit->semester}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Waktu Mulai</div>
            <input type="time" required name="waktu_mulai" class="form-control" value="{{$toEdit->waktu_mulai}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Waktu Selesai</div>
            <input type="time" required name="waktu_selesai" class="form-control" value="{{$toEdit->waktu_selesai}}">
          </div>
          <div style="padding:20px;padding-bottom:10px;padding-top:10px;">
            <div class="mb-1">Hari</div>
            <select class="form-control" name="hari" required>
              <option value="">Pilih Hari</option>
              <option value="senin" {{$toEdit->hari === 'senin' ? 'selected' : ''}}>Senin</option>
              <option value="selasa" {{$toEdit->hari === 'selasa' ? 'selected' : ''}}>Selasa</option>
              <option value="rabu" {{$toEdit->hari === 'rabu' ? 'selected' : ''}}>Rabu</option>
              <option value="kamis" {{$toEdit->hari === 'kamis' ? 'selected' : ''}}>Kamis</option>
              <option value="jumat" {{$toEdit->hari === 'jumat' ? 'selected' : ''}}>Jumat</option>
              <option value="sabtu" {{$toEdit->hari === 'sabtu' ? 'selected' : ''}}>Sabtu</option>
            </select>
          </div>
          <div style="padding:20px;">
            <button class="btn btn-primary">Simpan</button>
            <a href="/kaprodi?page=jadwal-kuliah" class="btn btn-secondary">
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
            ruangan_selector.innerHTML += `
              <option value="${ruangan.kode_ruang}">${ruangan.nama}</option>
            `;
          })
        }
      })
    }
  </script>
  @endif
  @if($om)
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
    .swal2-container{
      z-index:100001;
    }
    .card_overlay{
      width: 70%;
      background: white;
      margin-top:20px;
      border-radius:10px;
      margin-bottom:20px;
      padding:20px;
      display: flex;
      flex-direction: column;
    }
    .overlay_header{
      padding-bottom:20px;
      border-bottom:1px solid gainsboro;
      font-size: 24px;
      margin-bottom:20px;
    }
  </style>
  <div class="overlay_high">
    <div class="card_overlay">
      <div class="overlay_header d-flex justify-content-between">
        Data Jadwal
        <a href="/dekan?page=jadwal-kuliah"><button class="btn btn-primary">Tutup</button></a>
      </div>
      <div style="height: 600px;">
        <div id="calendar" style="height: 100%;"></div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'timeGridWeek',
          height: 600,aspectRatio: 1.5,
          headerToolbar: {
            center: 'title',
            right: 'timeGridWeek,timeGridDay'
          },
          events: '/get-jadwal',
          eventClick: function (info) {
            Swal.fire({
              html: info.event.extendedProps.description,
              showCloseButton: true,
              showConfirmButton: false
            });
          },
          editable: false,
          droppable: false,
        });
        calendar.render();
      });
  </script>
  @endif
</div>
<!-- / Layout wrapper -->
@endsection