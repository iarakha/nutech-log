<?php

namespace App\Http\Controllers;


use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Part;

class PartController extends Controller
{

    public function index()
    {
        $page = 'Settings';
        $title = 'Part';
        $user = auth()->user();

        $part = Part::paginate(10);
        
        return view('pages.part.view')->withTitle('Part')
        ->with([
            'title' => $title,
            'page' => $page,
            'data' => $part,
            'role' => $user->role,
        ]);
    }


    public function form(Request $request)
    {
        $page = 'Settings';
        $user = auth()->user();

        
        if($request->id){
            $items = Part::where('id',$request->id)->find($request->id);
        }else{
           
            $items = [];
        }
        
        return view('pages.part.form')->withTitle('Tambah Part')
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
            'part' => 'required',
        ]);

        if($validate) {
            Part::create($validate);
            return redirect()->route('part')->with('success', 'Success membuat Part baru!');
        }
    }

    public function update(Request $request, $id)
    {
        $page = 'Settings';

        $part = Part::find($id);
        $part -> nama = $request->nama;
        $part -> save();

        if($part){
            //redirect dengan pesan sukses
            return redirect()->route('part')->with(['success' => 'Data Part Baru Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('part')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function destroy (Request $request, $id) {
        $page = 'Setting';

        $delete = Part::find($request->id)
                -> delete();

        return redirect()->route('part')->with(['error' => 'Data Part Berhasil Dihapus!']);
    
   }
}
