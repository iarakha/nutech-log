<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wo;
use App\Exports\WoExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use Rap2hpoutre\FastExcel\FastExcel;


class ReportController extends Controller
{
    public function index(Request $req)
    {
        $page = 'Report';
        $user = auth()->user();
        
        return view('pages.report.view')->withTitle('Report')
        ->with([
            'page' => $page,
            'role' => $user->role,
        ]);     
    }
  
    public function export(Request $request) {

        $startDate = $request->startdate;
        $toDate = $request->todate;

        $rows = DB::table('wo')
        ->join('users', 'users.id', '=', 'wo.id_user')
        ->join('lokasi', 'lokasi.id', '=', 'wo.id_lokasi')
        ->join('perangkat', 'perangkat.id', '=', 'wo.id_perangkat')
        ->join('part', 'part.id', '=', 'wo.id_part')
        ->join('jenis_masalah', 'jenis_masalah.id', '=', 'wo.id_masalah')
        ->select([
            'wo.kode_wo',
            'wo.jenis_laporan',
            'wo.tanggal_masalah',
            'wo.jam_masalah',
            'wo.tanggal_selesai',
            'wo.jam_selesai',
            'lokasi.lokasi AS lokasi',
            'perangkat.nama AS perangkat', 
            'part.part AS part', 
            'jenis_masalah.nama AS jenis_masalah', 
            'wo.penyebab',
            'wo.solusi',
            'wo.sumber',
            'wo.status',
            'wo.keterangan',
            ])
        ->where('tanggal_masalah', '>=', $startDate)
        ->where('tanggal_masalah', '<=', $toDate)
        ->get();

        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'kode_wo' => $row->kode_wo,
                'jenis_laporan' => $row->jenis_laporan,
                'tanggal_masalah' => $row->tanggal_masalah,
                'jam_masalah' => $row->jam_masalah,
                'tanggal_selesai' => $row->tanggal_selesai,
                'jam_selesai' => $row->jam_selesai,
                'lokasi' => $row->lokasi,
                'perangkat' => $row->perangkat, 
                'part' => $row->part, 
                'jenis_masalah' => $row->jenis_masalah, 
                'penyebab' => $row->penyebab,
                'solusi' => $row->solusi,
                'sumber' => $row->sumber,
                'status' => $row->status,
                'keterangan' => $row->keterangan,
            ];
        }
        
        return (new FastExcel($data))->download('report.xlsx');
    }
}
