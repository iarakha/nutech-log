<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;


use Illuminate\Http\Request;
use App\Models\Wo;
use Carbon\Carbon;
use DateTime;

class OpenTaskController extends Controller
{
    public function index()
    {
        $page = 'Open Task';
        $user = auth()->user();

        $data = Wo::paginate(10);

        $query = Wo::join('users', 'users.id', '=', 'wo.id_user')
        ->join('lokasi', 'lokasi.id', '=', 'wo.id_lokasi')
        ->join('perangkat', 'perangkat.id', '=', 'wo.id_perangkat')
        ->join('part', 'part.id', '=', 'wo.id_part')
        ->join('jenis_masalah', 'jenis_masalah.id', '=', 'wo.id_masalah')
        ->where('wo.status', '=', 'waiting')
        ->select([
            'wo.*',
            'users.name AS user_name', 
            'lokasi.lokasi AS lokasi',
            'perangkat.nama AS perangkat', 
            'part.part AS part', 
            'jenis_masalah.nama AS jenis_masalah', 
            ])
        ->get();
        
        
        return view('pages.open_task.view')->withTitle('Open Task')
        ->with([
            'page' => $page,
            'data' => $data,
            'query' => $query,
            'role' => $user->role,
        ]);        
    }

    public function progress(Request $request) 
    {
        $mytime = Carbon::now();
        
        $query = Wo::find($request->id);

        $query->jam_selesai = $mytime->toTimeString();
        $query->tanggal_selesai = $mytime->toDateString();
        $query->status = "on progress";

        $query->update();
        
        if($query){
            //redirect dengan pesan sukses
            return redirect()->route('open_task')->with(['success' => 'Data Laporan Baru Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('open_task')->with(['error' => 'Data Gagal Disimpan!']);
        }        
    }
    
}
