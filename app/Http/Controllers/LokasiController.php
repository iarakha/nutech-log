<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLokasiRequest;
use App\Http\Requests\UpdateLokasiRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{

    public function index()
    {
        $page = 'Settings';
        $title = 'Lokasi';
        $user = auth()->user();

        $lokasi = Lokasi::paginate(10);
        
        return view('pages.lokasi.view')->withTitle('Lokasi')
        ->with([
            'title' => $title,
            'page' => $page,
            'data' => $lokasi,
            'role' => $user->role,
        ]);
    }


    public function form(Request $request)
    {
        $page = 'Settings';
        $user = auth()->user();

        if($request->id){
            $items = Lokasi::where('id',$request->id)->find($request->id);
        }else{
           
            $items = [];
        }
        
        return view('pages.lokasi.form')->withTitle('Tambah Lokasi')
        ->with([
            'page' => $page,
            'item' => $items,
            'id' => $request->id,
            'role' => $user->role,
        ]);
    }

    public function store(Request $request)
    {
        $page = 'Settings';
        $validate = $request->validate([
            'lokasi' => 'required',
        ]);

        if($validate) {
            Lokasi::create($validate);
            return redirect()->route('lokasi')->with('success', 'Success membuat Lokasi baru!');
        }
    }

    public function update(Request $request, $id)
    {
        $page = 'Settings';

        $lokasi = Lokasi::find($id);
        $lokasi -> lokasi = $request->lokasi;
        $lokasi -> save();

        if($lokasi){
            //redirect dengan pesan sukses
            return redirect()->route('lokasi')->with(['success' => 'Data Lokasi Baru Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('lokasi')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy (Request $request, $id) {
        $page = 'Setting';

        $delete = Lokasi::find($request->id)
                -> delete();

        return redirect()->route('lokasi')->with(['error' => 'Data Lokasi Berhasil Dihapus!']);
    
   }
}
