<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\perangkat;

class PerangkatController extends Controller
{

    public function index()
    {
        $page = 'Settings';
        $title = 'Perangkat';
        $user = auth()->user();

        $perangkat = Perangkat::paginate(10);
        
        return view('pages.perangkat.view')->withTitle('Perangkat')
        ->with([
            'title' => $title,
            'page' => $page,
            'data' => $perangkat,
            'role' => $user->role,
        ]);
    }


    public function form(Request $request)
    {
        $page = 'Settings';
        $user = auth()->user();
        
        if($request->id){
            $items = Perangkat::where('id',$request->id)->find($request->id);
        }else{
           
            $items = [];
        }
        
        return view('pages.perangkat.form')->withTitle('Tambah Perangkat')
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
            Perangkat::create($validate);
            return redirect()->route('perangkat')->with('success', 'Success membuat Perangkat baru!');
        }
    }

    public function update(Request $request, $id)
    {
        $page = 'Settings';

        $perangkat = Perangkat::find($id);
        $perangkat -> nama = $request->nama;
        $perangkat -> save();

        if($perangkat){
            //redirect dengan pesan sukses
            return redirect()->route('perangkat')->with(['success' => 'Data Perangkat Baru Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('perangkat')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy (Request $request, $id) {
        $page = 'Setting';

        $delete = Perangkat::find($request->id)
                -> delete();

        return redirect()->route('perangkat')->with(['error' => 'Data Perangkat Berhasil Dihapus!']);
    
   }
}
