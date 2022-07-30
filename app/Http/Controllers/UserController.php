<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;




class UserController extends Controller
{

    public function index() {
        
        $user = auth()->user();
        
        $page = 'Settings';

        $users = User::paginate(10);
        
        return view('pages.user.view')->withTitle('User')
        ->with([
            'role' => $user->role,
            'page' => $page,
            'data' => $users
        ]);
    }
     
     
   public function form(Request $request){

        $user = auth()->user();
        $page = 'Settings';
        
        if($request->id){
            $items = User::where('id',$request->id)->find($request->id);
        }else{
           
            $items = [];
        }
        
        return view('pages.user.form')->withTitle('Tambah User')
        ->with([
            'role' => $user->role,
            'page' => $page,
            'item' => $items,
            'id' => $request->id,
        ]);
       
   }

   public function store(Request $request) {

        $page = 'Settings';
        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required',
        ]);

        $validate['password'] = Hash::make($validate['password']);
        $validate['access_token'] = Str::random(40);
        
        if($validate) {
            User::create($validate);
            return redirect()->route('user')->with('success', 'Success Create User!');
        }
   }

   public function update(Request $request, $id) {
        $page = 'Settings';

        $users = User::find($id);
        $users -> name = $request->name;
        $users -> username = $request->username;
        $users -> email = $request->email;
        $users -> password = Hash::make($request->password);
        $users -> role = $request->role;

        $users -> save();

        if($users){
            //redirect dengan pesan sukses
            return redirect()->route('user')->with(['success' => 'Data User Baru Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('user')->with(['error' => 'Data Gagal Disimpan!']);
        }

   }

   public function destroy (Request $request, $id) {
        $page = 'Setting';

        $delete = User::find($request->id)
                -> delete();

        return redirect()->route('user')->with(['error' => 'Data User Berhasil Dihapus!']);
    
   }
   
}