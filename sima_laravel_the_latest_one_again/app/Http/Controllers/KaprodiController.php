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
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use App\Models\JadwalItems;

class KaprodiController extends Controller
{
    public function index(Request $request){
        // getting the query
        $ck = $request->query('ck');
        $tr = $request->query('tr');
        $er = $request->query('er');
        $om = $request->query('om');
        $id = $request->query('id');
        $kr = $request->query('kr');
        $user = Auth::user();
        $page = $request->query('page') ?? 'dashboard';

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
                    $departemen = Departemen::find($alokasi_ruang->id_departemen);
                    if($alokasi_ruang){
                        $departemen_name = $departemen->nama;
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data alokasi ruang departemen $departemen_name berhasil ditolak!"
                        ]);
                        $alokasi_ruang->update(['status'=>'rejected']);
                    }
                }else if($mode === 'approved'){
                    $ruang_id = $request->input('id');
                    $alokasi_ruang = AlokasiRuang::find($ruang_id);
                    $departemen = Departemen::find($alokasi_ruang->id_departemen);
                    if($alokasi_ruang && $departemen){
                        $departemen_name = $departemen->nama;
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
            }else if($page === 'mahasiswa'){
                $mode = $request->input('mode');
                if($mode === 'add'){
                    $data = $request->all();
                    $user_account = User::find($data['user_id']);
                    $data['email'] = $user->email;
                    $data['ipk'] = 4;
                    // generating nim
                    $data['nim'] = strval(time());
                    $mahasiswa_name = $data['nama_lengkap'];
                    Mahasiswa::create($data);
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>"Data mahasiswa $mahasiswa_name berhasil ditambahkan!"
                    ]);
                }else if($mode === 'edit'){
                    $data = $request->all();
                    $data_mahasiswa_ = Mahasiswa::find($data['id']);
                    $mahasiswa_name = $data_mahasiswa_->nama_lengkap;
                    if($data_mahasiswa_){
                        $data_mahasiswa_->update($data);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data mahasiswa $mahasiswa_name berhasil diedit!"
                        ]);
                    }
                }else if($mode === 'delete'){
                    $data = $request->all();
                    $data_mahasiswa_ = Mahasiswa::find($data['id']);
                    $mahasiswa_name = $data_mahasiswa_->nama_lengkap;
                    if($data_mahasiswa_){
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data mahasiswa $mahasiswa_name berhasil dihapus!"
                        ]);
                        $data_mahasiswa_->delete();
                    }
                }
                return redirect('/kaprodi?page=mahasiswa');
            }else if($page === 'dosen'){
                $mode = $request->input('mode');
                if($mode === 'add'){
                    $data = $request->all();
                    $data['user_id'] = 2;
                    Dosen::create($data);
                    $dosen_name = $data['nama'];
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>"Data dosen $dosen_name berhasil ditambahkan!"
                    ]);
                }else if($mode === 'edit'){
                    $data = $request->all();
                    $dosen_ = Dosen::find($data['id']);
                    if($dosen_){
                        $dosen_name = $dosen_->nama;
                        $dosen_->update($data);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data dosen $dosen_name berhasil diedit!"
                        ]);
                    }
                }else if($mode === 'delete'){
                    $data = $request->all();
                    $dosen_ = Dosen::find($data['id']);
                    $dosen_name = $dosen_->nama;
                    if($dosen_){
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data dosen $dosen_name berhasil dihapus!"
                        ]);
                        $dosen_->delete();
                    }
                }
                return redirect('/kaprodi?page=dosen');
            }else if($page === 'mata-kuliah'){
                $mode = $request->input('mode');
                if($mode === 'add'){
                    $data = $request->all();
                    MataKuliah::create($data);
                    $nama_matakuliah = $data['nama'];
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>"Data mata kuliah $nama_matakuliah berhasil ditambahkan!"
                    ]);
                }else if($mode === 'edit'){
                    $data = $request->all();
                    $mata_kuliah_ = MataKuliah::find($data['id']);
                    if($mata_kuliah_){
                        $mata_kuliah_nama = $mata_kuliah_->nama;
                        $mata_kuliah_->update($data);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data mata kuliah $mata_kuliah_nama berhasil diedit!"
                        ]);
                    }
                }else if($mode === 'delete'){
                    $data = $request->all();
                    $mata_kuliah_ = MataKuliah::find($data['id']);
                    $mata_kuliah_nama = $mata_kuliah_->nama;
                    if($mata_kuliah_){
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data mata kuliah $mata_kuliah_nama berhasil dihapus!"
                        ]);
                        $mata_kuliah_->delete();
                    }
                }
                return redirect('/kaprodi?page=mata-kuliah');
            }else if($page === 'jadwal-kuliah'){
                $mode = $request->input('mode');
                if($mode === 'add'){
                    if($id){
                        $data = $request->all();
                        $data['id_jadwal'] = $data['kr'];
                        $data['kode_ruang'] = $data['id_ruangan'];
                        JadwalItems::create($data);
                        return redirect('/kaprodi?page=jadwal-kuliah&id=1&kr='.$kr);
                    }else{
                        $data = $request->all();
                        $program_studi_ = ProgramStudi::find($data['id_prodi']);
                        $nama_prodi_ = $program_studi_->nama;
                        $kelas_ = $data['kelas'];
                        $semester_ = $data['semester'];
                        $tahun_ajaran_ = $data['tahun_ajaran'];
                        Jadwal::create($data);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data jadwal kuliah program studi $nama_prodi_ kelas $kelas_ semester $semester_ tahun ajaran $tahun_ajaran_ berhasil ditambahkan!"
                        ]);
                    }
                }else if($mode === 'edit'){
                    $data = $request->all();
                    $program_studi_ = ProgramStudi::find($data['id_prodi']);
                    $nama_prodi_ = $program_studi_->nama;
                    $kelas_ = $data['kelas'];
                    $semester_ = $data['semester'];
                    $tahun_ajaran_ = $data['tahun_ajaran'];
                    $data_jadwal_ = Jadwal::find($data['id']);
                    if($data_jadwal_){
                        $data_jadwal_->update($data);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data jadwal kuliah program studi $nama_prodi_ kelas $kelas_ semester $semester_ tahun ajaran $tahun_ajaran_ berhasil diedit!"
                        ]);
                    }
                }else if($mode === 'delete'){
                    if($id){
                        $id = $request->input('id');
                        $jadwal_item_ = JadwalItems::find($id);
                        if($jadwal_item_)
                            $jadwal_item_->delete();
                        return redirect('/kaprodi?page=jadwal-kuliah&id=1&kr='.$kr);
                    }else{
                        $data = $request->all();
                        $data_jadwal_ = Jadwal::find($data['id']);
                        $program_studi_ = ProgramStudi::find($data['id_prodi']);
                        $nama_prodi_ = $program_studi_->nama;
                        $kelas_ = $data_jadwal_->kelas;
                        $semester_ = $data_jadwal_->semester_;
                        $tahun_ajaran_ = $data_jadwal_->tahun_ajaran;
                        if($data_jadwal_){
                            Notifikasi::create([
                                'user_id'=>Auth::user()->id,
                                'teks'=>"Data jadwal kuliah program studi $nama_prodi_ kelas $kelas_ semester $semester_ tahun ajaran $tahun_ajaran_ berhasil dihapus!"
                            ]);
                            JadwalItems::where('id_jadwal',$data['id'])->delete();
                            $data_jadwal_->delete();
                        }
                    }
                }
                return redirect('/kaprodi?page=jadwal-kuliah');
            }
        }

        $kalender_akademik = Settings::where('name','kalender_akademik')->first();
        if($kalender_akademik)
            $kalender_akademik = $kalender_akademik->value;

        $ruangan = Ruangan::all();
        $ruang_valid = [];
        foreach($ruangan as $item){
            $gedung = Gedung::find($item->gedung_id);
            if($gedung){
                $item->nama_gedung = $gedung->nama;
                $ruang_valid[] = $item;
            }
        }
        // getting the gedung data
        $gedung = Gedung::all();
        foreach($gedung as $item){
            $item->data_ruangan = Ruangan::where('gedung_id',$item->id)->get();
            $item->ruangan = count($item->data_ruangan);
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
            if($page === 'mahasiswa'){
                $kode_ruang = $request->query('kr');
                $mahasiswa_ = Mahasiswa::find($kode_ruang);
                if($mahasiswa_)
                    $toEdit = $mahasiswa_;
            }
            if($page === 'dosen'){
                $kode_ruang = $request->query('kr');
                $dosen_ = Dosen::find($kode_ruang);
                if($dosen_){
                    $id_fakultas = ProgramStudi::find($dosen_->id_prodi);
                    if($id_fakultas){
                        $dosen_->id_fakultas = $id_fakultas->id_fakultas;
                    }
                    $toEdit = $dosen_;
                }
            }
            if($page === 'mata-kuliah'){
                $kode_ruang = $request->query('kr');
                $mata_kuliah_ = MataKuliah::find($kode_ruang);
                if($mata_kuliah_){
                    $id_fakultas = ProgramStudi::find($mata_kuliah_->id_prodi);
                    if($id_fakultas){
                        $mata_kuliah_->id_fakultas = $id_fakultas->id_fakultas;
                    }
                    $dosen_ = Dosen::find($mata_kuliah_->nip_dosen);
                    if($dosen_)
                        $mata_kuliah_->dosen = $dosen_;
                    $toEdit = $mata_kuliah_;
                }
            }
            if($page === 'jadwal-kuliah'){
                $kode_ruang = $request->query('kr');
                $jadwal_kuliah_ = Jadwal::find($kode_ruang);
                if($jadwal_kuliah_){
                    $program_studi_ = ProgramStudi::find($jadwal_kuliah_->id_prodi);
                    if($program_studi_)
                        $jadwal_kuliah_->program_studi = $program_studi_;
                    $toEdit = $jadwal_kuliah_;
                }
            }
        }

        $valid_alokasi_ruang = [];
        $alokasi_ruangan_data = AlokasiRuang::all();
        foreach($alokasi_ruangan_data as $item){
            $departemen_item_alokasi = Departemen::find($item->id_departemen);
            $gedung_item_alokasi = Gedung::find($item->id_gedung);
            $ruangan_item_alokasi = Ruangan::find($item->id_ruang);
            if($departemen_item_alokasi && $gedung_item_alokasi && $ruangan_item_alokasi){
                $item->departemen = $departemen_item_alokasi;
                $item->gedung = $gedung_item_alokasi;
                $item->ruangan = $ruangan_item_alokasi;
                $valid_alokasi_ruang[] = $item;
            }
        }

        $alokasi_pending = Jadwal::where('status','pending')->count();
        $alokasi_approved = Jadwal::where('status','approved')->count();
        $alokasi_rejected = Jadwal::where('status','rejected')->count();

        // handling akun mahasiswa
        $akun_mahasiswa_valid = [];
        $akun_mahasiswa = User::where('role','mahasiswa')->get();
        foreach($akun_mahasiswa as $item){
            if(Mahasiswa::where('user_id',$item->id)->count() === 0){
                // jadi mahasiswa ini mahasiswa belum terdaftar
                $akun_mahasiswa_valid[] = $item;
            }
        }

        $mahasiswa = Mahasiswa::all();

        foreach($mahasiswa as $item){
            $fakultas_ = Fakultas::find($item->id_fakultas);
            if($fakultas_)
                $item->fakultas = $fakultas_;
            $program_studi_ = ProgramStudi::find($item->id_prodi);
            if($program_studi_)
                $item->program_studi = $program_studi_;
            $dosen_wali_ = Dosen::where('user_id',$item->wali_dosen)->first();
            if($dosen_wali_)
                $item->dosen_wali = $dosen_wali_;
        }

        $dosen = Dosen::all();
        foreach($dosen as $item){
            $program_studi_ = ProgramStudi::find($item->id_prodi);
            if($program_studi_)
                $item->program_studi = $program_studi_;
        }

        $mata_kuliah = MataKuliah::all();
        foreach($mata_kuliah as $item){
            $dosen_ = Dosen::find($item->nip_dosen);
            if($dosen)
                $item->dosen = $dosen_;
            $program_studi_ = ProgramStudi::find($item->id_prodi);
            if($program_studi_)
                $item->program_studi = $program_studi_;
        }

        $jadwal_kuliah = Jadwal::all();
        foreach($jadwal_kuliah as $item){
            $data_prodi_ = ProgramStudi::find($item->id_prodi);
            if($data_prodi_)
                $item->program_studi = $data_prodi_;
        }

        $jadwal_kuliah_detail = [];
        $mata_kuliah_add_detail = [];
        if($id){
            $jadwal_kuliah_detail = JadwalItems::where('id_jadwal',$kr)->get();
            foreach($jadwal_kuliah_detail as $item){
                $mata_kuliah_ = MataKuliah::where('kode_mk',$item->kode_mk)->first();
                if($mata_kuliah_)
                    $item->mata_kuliah = $mata_kuliah_;
                $dosen_ = Dosen::find($mata_kuliah_->nip_dosen);
                if($dosen_)
                    $item->dosen = $dosen_;
                $ruangan_ = Ruangan::find($item->kode_ruang);
                if($ruangan_){
                    $item->ruangan = $ruangan_;
                    $gedung_ = Gedung::find($ruangan_->gedung_id);
                    if($gedung_)
                        $item->gedung = $gedung_;
                }
            }
            if($tr){
                $data_jadwal_ = Jadwal::find($kr);
                $mata_kuliah_add_detail = MataKuliah::where('id_prodi',$data_jadwal_->id_prodi)->get();
            }
        }

        return view('kaprodi.pages.'.$page,[
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
            'akun_mahasiswa' => $akun_mahasiswa_valid,
            'akun_mahasiswa_all' => $akun_mahasiswa,
            'fakultas' => $fakultas,
            'program_studi'=>$program_studi,
            'mahasiswa'=>$mahasiswa,
            'dosen'=>$dosen,
            'mata_kuliah'=>$mata_kuliah,
            'jadwal_kuliah'=>$jadwal_kuliah,
            'jadwal_kuliah_detail'=>$jadwal_kuliah_detail,
            'mata_kuliah_add_detail'=>$mata_kuliah_add_detail
        ]);
    }
}
