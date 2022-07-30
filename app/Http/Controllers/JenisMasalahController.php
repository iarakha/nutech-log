<?php

namespace App\Http\Controllers;


use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Masalah;

class JenisMasalahController extends Controller
{

    public function index()
    {
        $page = 'Settings';
        $title = 'Jenis Masalah';
        $user = auth()->user();

        $data = Masalah::paginate(10);
        
        return view('pages.jenis_masalah.view')->withTitle('Jenis Masalah')
        ->with([
            'title' => $title,
            'page' => $page,
            'data' => $data,
            'role' => $user->role,
        ]);
    }


    public function form(Request $request)
    {
        $page = 'Settings';
        $user = auth()->user();

        if($request->id){
            $items = Masalah::where('id',$request->id)->find($request->id);
        }else{
           
            $items = [];
        }
        
        return view('pages.jenis_masalah.form')->withTitle('Tambah Jenis Masalah')
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
            'nama' => 'required',
        ]);

        if($validate) {
            Masalah::create($validate);
            return redirect()->route('jenis_masalah')->with('success', 'Success membuat Jenis Masalah baru!');
        }
    }

    public function update(Request $request, $id)
    {
        $page = 'Settings';

        $validate = Masalah::find($id);
        $validate -> nama = $request->nama;
        $validate -> save();

        if($validate){
            //redirect dengan pesan sukses
            return redirect()->route('jenis_masalah')->with(['success' => 'Data Jenis Masalah Baru Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('jenis_masalah')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy (Request $request, $id) {
        $page = 'Setting';

        $delete = Masalah::find($request->id)
                -> delete();

        return redirect()->route('jenis_masalah')->with(['error' => 'Data Jenis Masalah Berhasil Dihapus!']);
    
   }
}
