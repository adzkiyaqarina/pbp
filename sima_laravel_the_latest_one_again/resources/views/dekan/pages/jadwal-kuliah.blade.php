@extends('dekan.layouts.index')
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
            @include('dekan.partials.profile',['user'=>$user])
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
              @if($id)
              <h5 class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex gap-2 align-items-center">
                  <a href="/dekan?page=jadwal-kuliah">
                    <button class="btn btn-primary">
                      <i class="bx bx-left-arrow-alt"></i>
                    </button>
                  </a>
                  <span style="font-size:24px;font-weight: bold;color:white;">Detail Jadwal Kuliah</span>
                </div>
                <div class="d-flex gap-2">
                  <a href="/dekan?page=jadwal-kuliah&om=1&id={{$id}}&kr={{$kr}}">
                    <button class="btn btn-primary d-flex align-items-center" style="gap: 10px;"><i class="bx bx-calendar" style="font-size:18px;"></i> Lihat Kalender</button>
                  </a>
                </div>
              </h5>
              <div class="table-responsive text-nowrap" style="max-height: 500px;overflow: auto;">
                @if(count($jadwal_kuliah_detail)>0)
                <div>
                  <table border="1" cellpadding="10" cellspacing="0" class="table table-responsive" style="background:white;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Ruang</th>
                            <th>Gedung</th>
                            <th>Hari</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0; ?>
                        @forelse($jadwal_kuliah_detail as $item)
                            <?php $index += 1; ?>
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $item->mata_kuliah->nama }}</td>
                                <td>{{ $item->dosen->nama }}</td>
                                <td>{{ $item->ruangan->nama }}</td>
                                <td>{{ $item->gedung->nama }}</td>
                                <td>{{ $item->hari }}</td>
                                <td>{{ $item->waktu_mulai }}</td>
                                <td>{{ $item->waktu_selesai }}</td>
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
              @else
              <h5 class="card-header d-flex align-items-center justify-content-between">
                <span style="font-size:24px;font-weight: bold;color:white;">Jadwal Kuliah</span>
              </h5>
              <div class="table-responsive text-nowrap" style="max-height: 500px;overflow: auto;">
                @if(count($jadwal_kuliah)>0)
                <div>
                  <table border="1" cellpadding="10" cellspacing="0" class="table table-responsive" style="background:white;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Program Studi</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Kelas</th>
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
                                <td>{{ $item->program_studi->nama }}</td>
                                <td>{{ $item->tahun_ajaran }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>{{ $item->kelas }}</td>
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
                                      <a href="/dekan?page=jadwal-kuliah&id=1&kr={{$item->id_jadwal}}">
                                        <button class="btn btn-secondary"><i class="bx bx-right-arrow-alt"></i></button>
                                      </a>
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
              @endif
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
        <a href="/dekan?page=jadwal-kuliah&id=1&kr={{$kr}}"><button class="btn btn-primary">Tutup</button></a>
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
          events: '/get-jadwal?kr={{$kr}}',
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