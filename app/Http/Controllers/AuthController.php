<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $status_code = 200;

    public function view() {
        $page = 'sign-in';
        return view('auth.login')->withTitle('Sign In')->with(['page' => $page]);
    }

    // Sign Method
    public function authenticate(Request $request)
    {
        $credentials = $request -> validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return redirect()->back()->with('error','Gagal Login, Masukan email atau password yang sesuai!');
    }


    // Register View
    public function register_view(){
        $page = 'sign-up';
        return view('auth.register')->withTitle('Sign Up')->with(['page' => $page]);
    }
    
    public function store_register(Request $request)
    {
        $page = 'sign-up';

        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required',
            
        ]);

        $validate['password'] = Hash::make($validate['password']);
        $validate['access_token'] = Str::random(40);
        User::create($validate);        
        return redirect()->route('sign-in')->with('success', 'Registrasi berhasil, silahkan login !');
        
    }


    //log-out 
    public function destroy(Request $request){
        Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();

         return redirect('/');
    }

    public function loginApi(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 400);
        }

        $user = User::where('username', $request['username'])->firstOrFail();

        $token = $user->createToken('acess_token')->plainTextToken;

        // $token = $user -> where('username',$request->username)->select('access_token')->first();
        
        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home', 'api_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function registerApi(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
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
             return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! username already registered"]);
         }
         
         $val = User::create($userDataArray);
         $token = $val->createToken('aceess_token')->plainTextToken;
         
         
         if(!is_null($val)) {
             return response()->json(["status" => $this->status_code, "success" => true, "message" => "Registration completed successfully", "result" => $val]);
             return response()
             ->json(['data' => $user,'access_token' => $user->access_token, 'token_type' => 'Bearer', ]);
         }
 
         else {
             return response()->json(["status" => "failed", "success" => false, "message" => "failed to register"]);
         }


         
        // $token = $user->createToken('access_token')->plainTextToken;

       
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
