<?php

namespace App\Exports;

use App\Models\Wo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(Request $request)
    {
        $this->validate($request, [
            'startdate' => 'required',
            'toDate' => 'required'
        ]);

        $startDate = $request->startdate;
        $toDate = $request->todate;

        $query = DB::table('wo')
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
               
        return $query;
    }

    public function headings(): array
    {
        return [
            'kode_wo',
            'jenis_laporan',
            'tanggal_masalah',
            'jam_masalah',
            'tanggal_selesai',
            'jam_selesai',
            'lokasi',
            'perangkat', 
            'part', 
            'jenis_masalah', 
            'penyebab',
            'solusi',
            'sumber',
            'status',
            'keterangan',
        ];
    }
}
