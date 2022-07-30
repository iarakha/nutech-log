<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Illuminate\Support\Facades\Validator;
use App\Models\Wo;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Masalah;
use App\Models\Part;
use App\Models\Perangkat;

class apiController extends Controller
{

    // use Sentinel;
    
    
    private $status_code = 200;


    //login api
    public function lo(Request $request){
        // $val = $this($request->validate->all(),[
        //     'username' => 'required',
        //     'password' => 'required'
        // ]);

        // $val = Validator::make($request->all(),[
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);
        //    
        // $val= $request->all();
        
        // if(Auth::attempt($val)){            
            // $data = User::where("username", $username)->first();
        if($val){
            return response()->json(['message' => 'login success', 'result' => $val, "status" => $this->status_code, "success" => true]);
        }else{
            return response()->json(['message' => 'failed cok']);
        } 
    }
    

    
    public function getUser(Request $request){
        

        $user = User::orderBy('name','ASC') ->get();

    	return response()->json([
                    'status' => 200,
                    'result' => $user,
                    'success' => true,
                    'message' => '',
                    
                ]);
    }

    public function getWo(){

        $user = Wo::get();

    	return response()->json([
                    'status' => 200,
                    'result' => $user,
                    'success' => true,
                    'message' => '',
                ]);

    }

    //REGISTER
    public function registerApi (Request $request) {

        
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required',
            
        ]);
        

        if($validate->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validate->errors()]);
        }

        $userDataArray = array(
           'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'access_token' => Str::random(40),
            'password' => Hash::make($request->password)
        );
        
        // return response()->json(["status" => $this->status_code, "success" => true, "message" => "successfully", "data" => $userDataArray]);
        
        $user_status = User::where("username", $request->username)->first();

        if(!is_null($user_status)) {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! email already registered"]);
        }
        
        $val = User::create($userDataArray);
        
        if(!is_null($val)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Registration completed successfully", "result" => $val]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "failed to register"]);
        }

    }
    
    
    
    
    
    public function ll(Request $request) {
        
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        $user = User::where('username',$credentials['username']);

        if(!empty($user)){

            $pass_check = $user->select('password')->get();

            if(!Hash::check($credentials['password'], $pass_check)){
                return response()->json(["status" => "failed", "success" => false, "message" => "error password"]);
            }else{
                $api_token = $user->select('access_token')->get();
                return response()->json(['access_token' => $api_token]);
            }

            return response()->json(['access_token' => $user]);
            // if(!Hash::check($request->password, $user->password)){
            //     $api_token = $user->select('access_token')->get();
            //     return response()->json(['access_token' => $api_token]);
            // }else{
            //     return response()->json(["status" => "failed", "success" => false, "message" => "error password"]);
            // }
           
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Email doesn't exist."]);
        }

        
    }

    

    public function createWo(Request $request) {
        
        $code = date('Ym');
        
        $wo = Wo::count();

        if($wo == 0) {
            $auto_inc = '00001';
            $kode_wo = 'NLT-' . $code . $auto_inc;
        }else {
            $wo_check = Wo::all()->last();
            $auto_inc = (int)substr($wo_check->kode_wo, 5) +1;
            $kode_wo = 'NLT-'.$auto_inc;
            
        }
        
        $valDataArray = array(
            'id_user' => $request->id_user,
            'id_lokasi' => $request->id_lokasi,
            'id_perangkat' => $request->id_perangkat,
            'id_part' => $request->id_part,
            'kode_wo' => $kode_wo,
            'jenis_laporan' => $request->jenis_laporan,
            'project' => $request->project,
            'penyebab' => $request->penyebab,
            'solusi' => $request->solusi,
            'sumber' => $request->sumber,
            'status' => $request->status,
            'tanggal_masalah' => $request->tanggal_masalah,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jam_selesai' => $request->jam_selesai,
            'keterangan' => $request->keterangan,
         );
         
         // return response()->json(["status" => $this->status_code, "success" => true, "message" => "successfully", "data" => $userDataArray]);
         
        //  if(!is_null($valDataArray)) {
        //     return response()->json(["status" => "failed", "validation_error" => $valDataArray->errors() ]);
        // }
         
         $kode_wo = Wo::where("kode_wo", $kode_wo)->first();
 
         if(!is_null($kode_wo)) {
             return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! Wo already registered"]);
         }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Error Kode Wo"]);
        }

        $val = Wo::get();

        return response()->json(["status" => $this->status_code, "success" => true, "message" => "get wo", "data" => $val]);
     
        
    }
       




    public function loginApi(Request $request)
    {
        $credentials = [
            'username'   => $request->username,
            'password' => $request->password
        ];
        $user = User::where('username', $credentials['username'])->first();
        
        if (!empty($user)) {
            if (!Hash::check($credentials['password'], $user->password)) {
                return response()->json(["status" => "failed", "success" => false, "message" => "password salah"]);
            } else {
                $user = $user->where('username', $credentials['username'])->first();                
                return response()->json(["status" => $this->status_code, "success" => true, "message" => "successfully", "result" => $user]);
                }
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Email doesn't exist."]);
        }
    }
    
    public function userByApi(){
        $user = user();
        return response()->json(["status" => $this->status_code, "success" => true, "message" => "successfully", "result" => $user]);
               
    }
    
    
}
