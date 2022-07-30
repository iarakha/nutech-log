<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Exports\WoExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Wo;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Masalah;
use App\Models\Part;
use App\Models\Perangkat;

use Illuminate\Support\Facades\DB;

class WoController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $page = 'Log Trouble';

        $data = Wo::paginate(10);

        $join = Wo::join('users', 'users.id', '=', 'wo.id_user')
                ->join('lokasi', 'lokasi.id', '=', 'wo.id_lokasi')
                ->join('perangkat', 'perangkat.id', '=', 'wo.id_perangkat')
                ->join('part', 'part.id', '=', 'wo.id_part')
                ->join('jenis_masalah', 'jenis_masalah.id', '=', 'wo.id_masalah')
                ->where('wo.status', '!=', 'waiting')
                ->select([
                    'wo.*',
                    'users.name AS user_name', 
                    'lokasi.lokasi AS lokasi',
                    'perangkat.nama AS perangkat', 
                    'part.part AS part', 
                    'jenis_masalah.nama AS jenis_masalah', 
                    ])
                ->get();
        
        return view('pages.wo.view')->withTitle('Log Trouble')
        ->with([
            'page' => $page,
            'data' => $data,
            'join' => $join,
            'role' => $user->role,
        ]);        
    }

    public function form(Request $request)
    {
        $page = 'Log Trouble';

        $user = auth()->user();

        if($request->id){
            $items = Wo::where('id',$request->id)->find($request->id);

            $jenis_masalah = Masalah::get();
            $lokasi = Lokasi::get();
            $perangkat = Perangkat::get();
            $part = Part::get();
                      
            $user = $request->user();             
            $kode_wo = $items->kode_wo;
            
        }else{
           
            $code = date('Ym');
        
            $wo = Wo::count();
    
            if($wo == 0) {
                $auto_inc = '00001';
                $kode_wo = 'NTL-' . $code . $auto_inc;
            }else {
                $wo_check = Wo::all()->last();
                $auto_inc = (int)substr($wo_check->kode_wo, 5) +1;
                $kode_wo = 'NTL-'.$auto_inc;
                
            }

            $items = [];
            
            $jenis_masalah = Masalah::get();
            $lokasi = Lokasi::get();
            $perangkat = Perangkat::get();
            $part = Part::get();
                    
            $user = auth()->user();
         
        }
        
        return view('pages.wo.form')->withTitle('Tambah Ticket')
        ->with([
            'page' => $page,
            'item' => $items,
            'kode_wo' => $kode_wo,
            'id' => $request->id,
            'users' => $user,
            'masalah' => $jenis_masalah,
            'lokasi' => $lokasi,
            'perangkat' => $perangkat,
            'part' => $part,
            'role' => $user->role,
        ]);
    }


    public function store(Request $request)
    {
        $page = 'Log Trouble';

        $code = date('Ym');
        
        $wo = Wo::count();

        $startDate = $request->tanggal_masalah;
        $toDate = $request->todate;
        
        if($wo == 0) {
            $auto_inc = '00001';
            $kode_wo = 'NLT-' . $code . $auto_inc;
        }else {
            $wo_check = Wo::all()->last();
            $auto_inc = (int)substr($wo_check->kode_wo, 5) +1;
            $kode_wo = 'NLT-'.$auto_inc;
        }
        
        // $user = $request->user(); 
        $user = auth()->user();

        $val = new Wo();
        // $val -> id_user = $user->id;
        $val -> id_user = $user->id;
        $val -> id_lokasi = $request->id_lokasi;
        $val -> id_perangkat = $request->id_perangkat;
        $val -> id_part = $request->id_part;
        $val -> id_masalah = $request->id_masalah;
        $val -> kode_wo = $kode_wo;        
        $val -> jenis_laporan = $request->jenis_laporan;
        $val -> project = $request->project;
        $val -> penyebab = $request->penyebab;
        $val -> solusi = $request->solusi;
        $val -> sumber = $request->sumber;
        $val -> status = "waiting";
        $val -> tanggal_masalah = $request->tanggal_masalah;
        $val -> jam_masalah = $request->jam_masalah; 
        $val -> tanggal_selesai = null;
        $val -> jam_selesai  = null;
        $val -> keterangan = strip_tags($request->keterangan);

        $val -> save();
        
        if($val){
            //redirect dengan pesan sukses
            return redirect()->route('wo')->with(['success' => 'Data Laporan Baru Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('wo')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }   

    public function done(Request $request) {

        $mytime = Carbon::now();
        $query = Wo::find($request->id);

        $query->jam_selesai = $mytime->toTimeString();
        $query->tanggal_selesai = $mytime->toDateString();
        $query->status = "done";

        $query->update();
        if($query){
            //redirect dengan pesan sukses
            return redirect()->route('wo')->with(['success' => 'Data Laporan Baru Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('wo')->with(['error' => 'Data Gagal Disimpan!']);
        }

    } 
    
    public function open(Request $request) {

        $mytime = Carbon::now();
        $query = Wo::find($request->id);

        $query->jam_selesai = $mytime->toTimeString();
        $query->tanggal_selesai = $mytime->toDateString();
        $query->status = "open";

        $query->update();
        if($query){
            //redirect dengan pesan sukses
            return redirect()->route('wo')->with(['success' => 'Data Laporan Baru Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('wo')->with(['error' => 'Data Gagal Disimpan!']);
        }

    } 
    
    public function export() 
    {
        return Excel::download(new WoExport, 'Report Log Trouble.xlsx');
    }

}
