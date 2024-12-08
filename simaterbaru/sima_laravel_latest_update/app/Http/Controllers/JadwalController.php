<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Ruangan;

class JadwalController extends Controller
{
    public function getJadwal(Request $request)
    {
        $kr = $request->query('kr');
        $jadwal_kuliah = Jadwal::where('id_jadwal',$kr);
        foreach ($jadwal_kuliah as $item) {
            
            $mata_kuliah_ = MataKuliah::where('kode_mk', $item->kode_mk)->first();
            if ($mata_kuliah_) {
                $item->mata_kuliah = $mata_kuliah_;
            }
            $dosen_ = Dosen::find($item->nip);
            if ($dosen_) {
                $item->dosen = $dosen_;
            }
            $ruangan_ = Ruangan::find($item->kode_ruang);
            if ($ruangan_) {
                $item->ruangan = $ruangan_;
            }
        }

        // Fungsi untuk mendapatkan tanggal hari tertentu dalam minggu ini
        // function getDateForDay($day) {
        //     $daysOfWeek = [
        //         'senin' => 0,
        //         'selasa' => 1,
        //         'rabu' => 2,
        //         'kamis' => 3,
        //         'jumat' => 4,
        //         'sabtu' => 5,
        //         'minggu' => 6,
        //     ];

        //     $currentWeekDay = date('w') - 1; // Hari dalam angka (Senin = 0, Minggu = 6)
        //     $targetDay = $daysOfWeek[strtolower($day)] ?? 0; // Hari target dalam angka
        //     $dayDiff = $targetDay - $currentWeekDay;

        //     return date('Y-m-d', strtotime("$dayDiff days"));
        // }
        function getDateForDay($day) {
            $daysOfWeek = [
                'senin' => 0,
                'selasa' => 1,
                'rabu' => 2,
                'kamis' => 3,
                'jumat' => 4,
                'sabtu' => 5,
                'minggu' => 6,
            ];

            // Mendapatkan hari minggu ini (0 = Minggu, 6 = Sabtu)
            $currentWeekDay = date('w') - 1; 

            // Tentukan hari target dalam minggu ini
            $targetDay = $daysOfWeek[strtolower($day)] ?? 0;

            // Hitung perbedaan hari antara hari sekarang dengan hari target
            $dayDiff = $targetDay - $currentWeekDay;

            // Jika target day sudah lewat (misalnya hari Selasa dan sekarang hari Rabu),
            // kita akan menambahkan 7 hari agar jatuh pada minggu depan.
            if ($dayDiff < 0) {
                $dayDiff += 7;
            }

            // Menghitung tanggal untuk hari target dengan menambahkan perbedaan hari pada tanggal sekarang
            return date('Y-m-d', strtotime("+$dayDiff days"));
        }

        $events = $jadwal_kuliah->map(function ($jadwal) {
            $startDate = getDateForDay($jadwal->hari);
            $startTime = $startDate . 'T' . $jadwal->waktu_mulai;
            $endTime = $startDate . 'T' . $jadwal->waktu_selesai;

            return [
                'title' => $jadwal->mata_kuliah->nama . ' - ' . $jadwal->kelas,
                'start' => date('Y-m-d\TH:i:s', strtotime($startTime)),
                'end' => date('Y-m-d\TH:i:s', strtotime($endTime)),
                'description' => '
                    <div style="text-align:left; margin-top:20px; border: 1px solid #ddd; border-radius: 8px; padding: 20px; background-color: #f9f9f9; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        <div style="display: flex; flex-wrap: wrap;">
                            <!-- Bagian Kiri -->
                            <div style="flex: 1; min-width: 250px;">
                                <div style="font-size:16px; color:#555; margin-top:10px;">
                                    <i class="bx bx-book" style="font-size:32px;"></i> '.$jadwal->mata_kuliah->nama.'
                                </div>
                                <div style="font-size:16px; color:#555; margin-top:10px;">
                                    <i class="bx bx-user" style="font-size:32px;"></i> '.$jadwal->dosen->nama.'
                                </div>
                                <div style="font-size:16px; color:#555; margin-top:10px;">
                                    <i class="bx bx-id-card" style="font-size:32px;"></i> '.$jadwal->dosen->nip.'
                                </div>
                            </div>

                            <!-- Bagian Kanan -->
                            <div style="flex: 1; min-width: 250px;">
                                <div style="font-size:16px; color:#555; margin-top:10px;">
                                    <i class="bx bx-building" style="font-size:32px;"></i> '.$jadwal->ruangan->nama.'
                                </div>
                                <div style="font-size:16px; color:#555; margin-top:10px;">
                                    <i class="bx bx-building" style="font-size:32px;"></i> Kelas '.$jadwal->kelas.'
                                </div>
                                <div style="font-size:16px; color:#555; margin-top:10px;">
                                    <i class="bx bx-calendar" style="font-size:32px;"></i> '.$jadwal->hari.'
                                </div>
                                <div style="font-size:16px; color:#555; margin-top:10px;">
                                    <i class="bx bx-time" style="font-size:32px;"></i> '.$jadwal->waktu_mulai.'
                                </div>
                                <div style="font-size:16px; color:#555; margin-top:10px;">
                                    <i class="bx bx-time" style="font-size:32px;"></i> '.$jadwal->waktu_selesai.'
                                </div>
                                <div style="font-size:16px; color:#555; margin-top:10px;">
                                    <i class="bx bx-time" style="font-size:32px;"></i> Status '.$jadwal->status.'
                                </div>
                            </div>
                        </div>
                    </div>
'
                ,
                'backgroundColor' => $jadwal->status === 'pending' ? '#ff9f89' : '#67c5ff'
            ];
        });


        return response()->json($events);
    }
}
