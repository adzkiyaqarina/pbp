<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Settings;
use App\Models\Ruangan;
use App\Models\Gedung;
use App\Models\Departemen;
use App\Models\AlokasiRuang;
use App\Models\Notifikasi;
use App\Models\Fakultas;
use App\Models\ProgramStudi;

class AkademikController extends Controller
{
    public function index(Request $request){
        // getting the query
        $ck = $request->query('ck');
        $tr = $request->query('tr');
        $er = $request->query('er');
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
                if($mode === 'add'){
                    $id_fakultas = $request->input('id_fakultas');
                    $id_prodi = $request->input('id_prodi');
                    $alokasi_gedung = $request->input('id_gedung');
                    $alokasi_ruangan = $request->input('id_ruangan');
                    $prodi_ = ProgramStudi::find($id_prodi);
                    $departemen_name = $prodi_->nama;
                    AlokasiRuang::create([
                        'id_fakultas'=>$id_fakultas,
                        'id_prodi'=>$id_prodi,
                        'id_gedung'=>$alokasi_gedung,
                        'id_ruang'=>$alokasi_ruangan
                    ]);
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>"Data alokasi ruang program studi $departemen_name berhasil ditambahkan!"
                    ]);
                }else if($mode === 'delete'){
                    $id = $request->input('id');
                    $alokasi_ruang = AlokasiRuang::find($id);
                    $prodi_ = ProgramStudi::find($alokasi_ruang->id_prodi);
                    if($alokasi_ruang){
                        $departemen_name = $prodi_->nama;
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data alokasi ruang program studi $departemen_name berhasil dihapus!"
                        ]);
                        $alokasi_ruang->delete();
                    }
                }else if($mode === 'edit'){
                    $id_fakultas = $request->input('id_fakultas');
                    $id_prodi = $request->input('id_prodi');
                    $alokasi_gedung = $request->input('id_gedung');
                    $alokasi_ruangan = $request->input('id_ruangan');
                    $ruang_id = $request->input('ruang_id');
                    $prodi_ = ProgramStudi::find($id_prodi);
                    $alokasi_ruang = AlokasiRuang::find($ruang_id);
                    if($alokasi_ruang && $prodi_){
                        $departemen_name = $prodi_->nama;
                        $alokasi_ruang->update([
                            'id_fakultas'=>$id_fakultas,
                            'id_prodi'=>$id_prodi,
                            'id_gedung'=>$alokasi_gedung,
                            'id_ruang'=>$alokasi_ruangan,
                            'status'=>'pending'
                        ]);
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data alokasi ruangan program studi $departemen_name berhasil dilakukan, dan saat ini sedang dalam status Pending!"
                        ]);
                    }
                }
                return redirect('/akademik?page=alokasi-ruangan');
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
            }else if($page === 'fakultas'){
                $mode = $request->input('mode');
                if($mode === 'add'){
                    $nama = $request->input('nama');
                    Fakultas::create([
                        'nama'=>$nama
                    ]);
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>"Data fakultas $nama berhasil ditambahkan!"
                    ]);
                }else if($mode === 'delete'){
                    $id = $request->input('id');
                    $fakultas_ = Fakultas::find($id);
                    if($fakultas_){
                        $departemen_name = $fakultas_->nama;
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data fakultas $departemen_name berhasil dihapus!"
                        ]);
                        $fakultas_->delete();
                    }
                }
                return redirect('/akademik?page=fakultas');
            }else if($page === 'program-studi'){
                $mode = $request->input('mode');
                if($mode === 'add'){
                    $nama = $request->input('nama');
                    $id_fakultas = $request->input('id_fakultas');
                    ProgramStudi::create([
                        'nama'=>$nama,
                        'id_fakultas'=>$id_fakultas
                    ]);
                    Notifikasi::create([
                        'user_id'=>Auth::user()->id,
                        'teks'=>"Data program studi $nama berhasil ditambahkan!"
                    ]);
                }else if($mode === 'delete'){
                    $id = $request->input('id');
                    $program_studi_ = ProgramStudi::find($id);
                    if($program_studi_){
                        $departemen_name = $program_studi_->nama;
                        Notifikasi::create([
                            'user_id'=>Auth::user()->id,
                            'teks'=>"Data program studi $departemen_name berhasil dihapus!"
                        ]);
                        $program_studi_->delete();
                    }
                }
                return redirect('/akademik?page=program-studi');
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
            $tidak_terpakai = AlokasiRuang::where('id_ruang',$item->kode_ruang)->count() === 0;
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

        $alokasi_pending = AlokasiRuang::where('status','pending')->count();
        $alokasi_approved = AlokasiRuang::where('status','approved')->count();
        $alokasi_rejected = AlokasiRuang::where('status','rejected')->count();

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
                $ruangan_teralokasi = AlokasiRuang::where('id_gedung',$item->id)->where('id_ruang',$ruangan_gedung->kode_ruang)->first();
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

        return view('akademik.pages.'.$page,[
            'user'=>$user,
            'page'=>$page,
            'ck'=>$ck,
            'kalender_akademik'=>$kalender_akademik,
            'tr'=>$tr,
            'er'=>$er,
            'ruangan'=>$ruang_valid,'gedung'=>$gedung,
            'departemen'=>$departemen,'departemen_alokasi'=>$departemen_alokasi,
            'toEdit'=>$toEdit,
            'valid_alokasi_ruang'=>$valid_alokasi_ruang,
            'notifikasi'=>$notifikasi,
            'alokasi_pending'=>$alokasi_pending,
            'alokasi_approved'=>$alokasi_approved,
            'alokasi_rejected'=>$alokasi_rejected,
            'fakultas'=>$fakultas,
            'program_studi'=>$program_studi_valid,
            'ruangan_kosong'=>$ruangan_kosong
        ]);
    }
}
