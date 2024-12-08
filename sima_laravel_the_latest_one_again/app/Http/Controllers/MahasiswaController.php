<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Settings;
use App\Models\Ruangan;
use App\Models\Gedung;
use App\Models\Departemen;
use App\Models\AlokasiRuang;
use App\Models\AlokasiRuangItems;
use App\Models\Notifikasi;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Irs;
use App\Models\IrsItems;

class MahasiswaController extends Controller
{
    public function index(Request $request){
        // getting the query
        $ck = $request->query('ck');
        $tr = $request->query('tr');
        $id = $request->query('id');
        $er = $request->query('er');
        $om = $request->query('om');
        $user = Auth::user();
        $page = $request->query('page') ?? 'dashboard';

        // getting data mahasiswa
        $mahasiswa_data = Mahasiswa::where('user_id',Auth::user()->id)->first();
        $program_studi_mahasiswa_ini = ProgramStudi::find($mahasiswa_data->id_prodi);
        if($program_studi_mahasiswa_ini)
            $mahasiswa_data->program_studi = $program_studi_mahasiswa_ini;
        $dosen_wali_ini = Dosen::where('user_id',$mahasiswa_data->wali_dosen)->first();
        if($dosen_wali_ini)
            $mahasiswa_data->dosen_wali = $dosen_wali_ini;

        if($request->isMethod('POST')){
            // logik for changing kalender akademik
            if($page === 'kalender-akademik'){
                if($request->hasFile('kalender_akademik')){
                    $fileName = 'kalender-akademik'.time() . '.' . $request->file('kalender_akademik')->extension();  
                    if($request->file('kalender_akademik')->move(public_path('uploads'), $fileName)){
                        $kalender_akademik = Settings::where('name','kalender_akademik')->first();
                        if($kalender_akademik){
                            $kalender_akademik->update(['value'=>$fileName]);
                            Notifikasi::create([
                                'user_id'=>Auth::user()->id,
                                'teks'=>"Kalender akademik berhasil diupdate!"
                            ]);
                        }else{
                            Settings::create(['name'=>'kalender_akademik','value'=>$fileName]);
                            Notifikasi::create([
                                'user_id'=>Auth::user()->id,
                                'teks'=>"Kalender akademik berhasil ditambahkan!"
                            ]);
                        }
                    }
                }
            }else if($page === 'manajemen-ruangan'){
                $mode = $request->input('mode');
                if($mode === 'add'){
                    $name = $request->input('nama');
                    $capacity = $request->input('kapasitas');
                    $gedung_id = $request->input('gedung_id');
                    Ruangan::create(['nama'=>$name,'kapasitas'=>$capacity,'gedung_id'=>$gedung_id]);
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>"Data ruangan $name berhasil ditambahkan!"
                    ]);
                }else if($mode === 'delete'){
                    $id = $request->input('id');
                    $ruangan = Ruangan::find($id);
                    if($ruangan){
                        $ruangan_name = $ruangan->nama;
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data ruangan $ruangan_name berhasil dihapus!"
                        ]);
                        $ruangan->delete();
                    }
                }else if($mode === 'edit'){
                    $name = $request->input('nama');
                    $capacity = $request->input('kapasitas');
                    $ruang_id = $request->input('ruang_id');
                    $gedung_id = $request->input('gedung_id');
                    $ruang = Ruangan::find($ruang_id);
                    if($ruang){
                        $ruang->update(['nama'=>$name,'kapasitas'=>$capacity,'gedung_id'=>$gedung_id]);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data ruangan $name berhasil diedit!"
                        ]);
                    }
                }
                return redirect('/akademik?page=manajemen-ruangan');
            }else if($page === 'manajemen-gedung'){
                $mode = $request->input('mode');
                if($mode === 'add'){
                    $name = $request->input('nama');
                    Gedung::create(['nama'=>$name]);
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>"Data gedung $name berhasil ditambahkan!"
                    ]);
                }else if($mode === 'delete'){
                    $id = $request->input('id');
                    $gedung = gedung::find($id);
                    if($gedung){
                        $nama_gedung_ = $gedung->nama;
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data departemen $nama_gedung_ berhasil dihapus!"
                        ]);
                        $gedung->delete();
                    }
                }else if($mode === 'edit'){
                    $name = $request->input('nama');
                    $ruang_id = $request->input('ruang_id');
                    $gedung = gedung::find($ruang_id);
                    if($gedung){
                        $gedung->update(['nama'=>$name]);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data gedung $name berhasil diedit!"
                        ]);
                    }
                }
                return redirect('/akademik?page=manajemen-gedung');
            }else if($page === 'manajemen-departemen'){
                $mode = $request->input('mode');
                if($mode === 'add'){
                    $name = $request->input('nama');
                    Departemen::create(['nama'=>$name]);
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>"Data departemen $name berhasil ditambahkan!"
                    ]);
                }else if($mode === 'delete'){
                    $id = $request->input('id');
                    $departemen = Departemen::find($id);
                    if($departemen){
                        $departemen_name_ = $departemen->nama;
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data departemen $departemen_name_ berhasil dihapus!"
                        ]);
                        $departemen->delete();
                    }
                }else if($mode === 'edit'){
                    $name = $request->input('nama');
                    $ruang_id = $request->input('ruang_id');
                    $departemen = Departemen::find($ruang_id);
                    if($departemen){
                        $departemen->update(['nama'=>$name]);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data departemen $name berhasil diedit!"
                        ]);
                    }
                }
                return redirect('/akademik?page=manajemen-departemen');
            }else if($page === 'alokasi-ruangan'){
                $mode = $request->input('mode');
                if($mode === 'delete'){
                    $id = $request->input('id');
                    $alokasi_ruang = AlokasiRuang::find($id);
                    $prodi_ = ProgramStudi::find($alokasi_ruang->id_prodi);
                    if($alokasi_ruang && $prodi_){
                        $departemen_name = $prodi_->nama;
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data alokasi ruang departemen $departemen_name berhasil ditolak!"
                        ]);
                        $alokasi_ruang->update(['status'=>'rejected']);
                    }
                }else if($mode === 'approved'){
                    $ruang_id = $request->input('id');
                    $alokasi_ruang = AlokasiRuang::find($ruang_id);
                    $prodi_ = ProgramStudi::find($alokasi_ruang->id_prodi);
                    if($alokasi_ruang && $prodi_){
                        $departemen_name = $prodi_->nama;
                        $alokasi_ruang->update([
                            'status'=>'approved'
                        ]);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data alokasi ruangan departemen $departemen_name berhasil Setujui!"
                        ]);
                    }
                }
                return redirect('/dekan?page=alokasi-ruangan');
            }else if($page === 'jadwal-kuliah'){
                $mode = $request->input('mode');
                if($mode === 'approved'){
                    $id = $request->input('id');
                    $jadwal_kuliah_ = Jadwal::find($id);
                    if($jadwal_kuliah_){
                        $jadwal_kuliah_->update(['status'=>'approved']);
                    }
                }else if($mode === 'delete'){
                    $id = $request->input('id');
                    $jadwal_kuliah_ = Jadwal::find($id);
                    if($jadwal_kuliah_){
                        $jadwal_kuliah_->update(['status'=>'rejected']);
                    }
                }
                return redirect('/dekan?page=jadwal-kuliah');
            }else if($page === 'notification'){
                $mode = $request->input('mode');
                if($mode === 'read'){
                    $id = $request->input('id');
                    $notif = Notifikasi::find($id);
                    if($notif){
                        $notif->update(['status'=>'read']);
                    }
                }
                return redirect('/akademik?page=notification');
            }else if($page === 'registrasi'){
                $mode = $request->input('mode');
                if($mode === 'set-status'){
                    $status = $request->input('status');
                    $id_mahasiswa = $request->input('id_mahasiswa');
                    $data_mahasiswa_ = Mahasiswa::find($id_mahasiswa);
                    if($data_mahasiswa_)
                        $data_mahasiswa_->update(['status'=>$status]);
                }
                return redirect('/mahasiswa?page=registrasi');
            }
            else if($page === 'irs'){
                $mode = $request->input('mode');
                if($mode === 'new-irs'){
                    // checking the avail status before
                    $irs_lama = Irs::where('nim',$mahasiswa_data->nim)->where('semester',$mahasiswa_data->semester)->first();
                    if(!$irs_lama){
                        $data_irs = [
                            'nim'=>$mahasiswa_data->nim,
                            'tahun_ajaran'=>'2024/2025',
                            'semester'=>$mahasiswa_data->semester,
                            'nip_dosen_wali'=>$mahasiswa_data->dosen_wali->nip,
                            'maks_sks'=>$mahasiswa_data->maks_sks
                        ];
                        Irs::create($data_irs);
                    }
                }else if($mode === 'add-matkul'){
                    $kr = $request->query('kr');
                    $kode_mk = $request->input('kode_mk');
                    $mata_kuliah_ = MataKuliah::find($kode_mk);
                    if($mata_kuliah_){
                        IrsItems::create(['id_irs'=>$kr,'id_mata_kuliah'=>$kode_mk]);
                        $irs_data = Irs::find($kr);
                        if($irs_data)
                            $irs_data->update(['sks' => $irs_data->sks + $mata_kuliah_->sks]);
                    }
                    return redirect('/mahasiswa?page=irs&id=1&kr='.$kr);
                }else if($mode === 'lock'){
                    $kr = $request->query('kr');
                    $irs_data = Irs::find($kr);
                    if($irs_data)
                        $irs_data->update(['status_lock_irs' => 'locked','status'=>'pending']);
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>'Irs anda berhasil dikirimkan ke dosen, sedang menunggu persetujuan'
                    ]);
                    return redirect('/mahasiswa?page=irs');
                }else if($mode === 'delete-matkul'){
                    $kr = $request->query('kr');
                    $id_matkul = $request->input('id');
                    $irs_item = IrsItems::find($id_matkul);
                    if($irs_item){
                        $mata_kuliah_ = MataKuliah::find($irs_item->id_mata_kuliah);
                        $irs_data = Irs::find($kr);
                        if($irs_data)
                            $irs_data->update(['sks' => $irs_data->sks - $mata_kuliah_->sks]);
                        $irs_item->delete();
                    }
                    return redirect('/mahasiswa?page=irs&id=1&kr='.$kr);
                }
                return redirect('/mahasiswa?page=irs');
            }
        }

        $kalender_akademik = Settings::where('name','kalender_akademik')->first();
        if($kalender_akademik)
            $kalender_akademik = $kalender_akademik->value;

        $ruangan = Ruangan::all();
        $ruang_valid = [];
        $ruangan_kosong = 0;
        foreach($ruangan as $item){
            $gedung = Gedung::find($item->gedung_id);
            if($gedung){
                $item->nama_gedung = $gedung->nama;
                $ruang_valid[] = $item;
            }
            $tidak_terpakai = AlokasiRuangItems::where('id_ruang',$item->kode_ruang)->count() === 0;
            if(!$tidak_terpakai)
                $ruangan_kosong += 1;
        }
        // getting the gedung data
        $gedung = Gedung::all();
        foreach($gedung as $item){
            $item->data_ruangan = Ruangan::where('gedung_id',$item->id)->get();
            $item->ruangan = count($item->data_ruangan);
        }

        // getting data fakultas
        $fakultas = Fakultas::all();

        // getting data program studi
        $program_studi = ProgramStudi::all();
        $program_studi_valid = [];
        foreach($program_studi as $item){
            $fakultas_ = Fakultas::find($item->id_fakultas);
            if($fakultas_){
                $item->fakultas = $fakultas_;
                $program_studi_valid[] = $item;
            }
        }

        $departemen = Departemen::all();

        // getting data alokasi ruang
        $departemen_alokasi = [];
        // foreach($departemen as $item){
        //     $departemen_teralokasi = AlokasiRuang::where('id_departemen',$item->id)->first();
        //     if(!$departemen_teralokasi){
        //         $departemen_alokasi[] = $item;
        //     }
        // }

        foreach($gedung as $item){
            foreach($item->data_ruangan as $ruangan_gedung){
                $ruangan_teralokasi = AlokasiRuangItems::where('id_gedung',$item->id)->where('id_ruang',$ruangan_gedung->kode_ruang)->first();
                if($ruangan_teralokasi){
                    $ruangan_gedung->terpakai = true;
                }else $ruangan_gedung->terpakai = false;
            }
        }

        // getting this user notifikasi
        $notifikasi = Notifikasi::where('user_id',Auth::user()->id)->where('status','unread')->get();

        $toEdit = null;
        if($er){
            // getting data to edit
            if($page === 'manajemen-ruangan'){
                $kode_ruang = $request->query('kr');
                $ruang = Ruangan::find($kode_ruang);
                if($ruang)
                    $toEdit = $ruang;
            }
            if($page === 'manajemen-gedung'){
                $kode_ruang = $request->query('kr');
                $gedung_ = Gedung::find($kode_ruang);
                if($gedung_)
                    $toEdit = $gedung_;
            }
            if($page === 'manajemen-departemen'){
                $kode_ruang = $request->query('kr');
                $departemen_ = Departemen::find($kode_ruang);
                if($departemen_)
                    $toEdit = $departemen_;
            }
            if($page === 'alokasi-ruangan'){
                $kode_ruang = $request->query('kr');
                $alokasi_ruang_ = AlokasiRuang::find($kode_ruang);
                if($alokasi_ruang_)
                    $toEdit = $alokasi_ruang_;
            }
            if($page === 'notification'){
                $kode_ruang = $request->query('kr');
                $notifikasi_ = Notifikasi::find($kode_ruang);
                if($notifikasi_)
                    $toEdit = $notifikasi_;
            }
        }

        $valid_alokasi_ruang = [];
        $alokasi_ruangan_data = AlokasiRuang::all();
        foreach($alokasi_ruangan_data as $item){
            $fakultas_ = Fakultas::find($item->id_fakultas);
            $prodi_ = ProgramStudi::find($item->id_prodi);
            $gedung_item_alokasi = Gedung::find($item->id_gedung);
            $ruangan_item_alokasi = Ruangan::find($item->id_ruang);
            if($fakultas_ && $prodi_ && $gedung_item_alokasi && $ruangan_item_alokasi){
                $item->fakultas = $fakultas_;
                $item->program_studi = $prodi_;
                $item->gedung = $gedung_item_alokasi;
                $item->ruangan = $ruangan_item_alokasi;
                $valid_alokasi_ruang[] = $item;
            }
        }

        $alokasi_pending = AlokasiRuang::where('status','pending')->count();
        $alokasi_approved = AlokasiRuang::where('status','approved')->count();
        $alokasi_rejected = AlokasiRuang::where('status','rejected')->count();

        $jadwal_pending = Jadwal::where('status','pending')->count();
        $jadwal_approved = Jadwal::where('status','approved')->count();
        $jadwal_rejected = Jadwal::where('status','rejected')->count();

        $jadwal_kuliah = Jadwal::all();
        foreach($jadwal_kuliah as $item){
            $mata_kuliah_ = MataKuliah::where('kode_mk',$item->kode_mk)->first();
            if($mata_kuliah_)
                $item->mata_kuliah = $mata_kuliah_;
            $dosen_ = Dosen::find($item->nip);
            if($dosen_)
                $item->dosen = $dosen_;
            $ruangan_ = Ruangan::find($item->kode_ruang);
            if($ruangan_)
                $item->ruangan = $ruangan_;
        }

        // working on data irs
        $irs_mahasiswa = Irs::where('nim',$mahasiswa_data->nim)
        ->get();

        $irs_mahasiswa_items = [];
        $kr = null;
        $mata_kuliah = null;
        if($id){
            // this mean i should get the data items
            $kr = $request->query('kr');
            $irs_mahasiswa_items = IrsItems::where('id_irs',$kr)->get();
            foreach($irs_mahasiswa_items as $item){
                $mata_kuliah_ = MataKuliah::find($item->id_mata_kuliah);
                if($mata_kuliah_)
                    $item->mata_kuliah = $mata_kuliah_;
            }
            if($tr){
                $mata_kuliah = MataKuliah::where('id_prodi',$mahasiswa_data->id_prodi)->where('semester',$mahasiswa_data->semester)->get();
            }
        }

        return view('mahasiswa.pages.'.$page,[
            'user'=>$user,
            'page'=>$page,
            'ck'=>$ck,
            'kalender_akademik'=>$kalender_akademik,
            'tr'=>$tr,
            'er'=>$er,
            'om'=>$om,
            'id'=>$id,
            'kr'=>$kr,
            'ruangan'=>$ruang_valid,'gedung'=>$gedung,
            'departemen'=>$departemen,'departemen_alokasi'=>$departemen_alokasi,
            'toEdit'=>$toEdit,
            'valid_alokasi_ruang'=>$valid_alokasi_ruang,
            'notifikasi'=>$notifikasi,
            'alokasi_pending'=>$alokasi_pending,
            'alokasi_approved'=>$alokasi_approved,
            'alokasi_rejected'=>$alokasi_rejected,
            'jadwal_pending'=>$jadwal_pending,
            'jadwal_approved'=>$jadwal_approved,
            'jadwal_rejected'=>$jadwal_rejected,
            'fakultas'=>$fakultas,
            'program_studi'=>$program_studi_valid,
            'ruangan_kosong'=>$ruangan_kosong,
            'jadwal_kuliah'=>$jadwal_kuliah,
            'data_mahasiswa'=>$mahasiswa_data,
            'irs_mahasiswa'=>$irs_mahasiswa,
            'irs_mahasiswa_items'=>$irs_mahasiswa_items,
            'mata_kuliah'=>$mata_kuliah
        ]);
    }
}
