<?php

namespace App\Http\Controllers;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;



class AuthController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login','register','forgotpassword']]);
//    }

  public function login(LoginRequest $request)
    {

    $credentials = $request->only(['email', 'password']);

    try {
        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
            }
        }
        catch (JWTException $e) {
        return response()->json(['error' => 'Could not create token'], 500);
         }

        $user = Auth::user();

        return response()->json(['status'=>'Success','token'=>$token,'user'=>$user],200);
    }
/*----------------------------------------------------------------------------------------*/
    public function register(RegisterRequest $request)
    {
        //validation


        $user =new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->nasab = $request->nasab;
        $user->key = Hash::make($request->key);
        $user->password = Hash::make($request->password);
        $user->save();


        return response()->json(['status' => 'Success','user'=>$user], 200);
    }
    /*--------------------------------------------------------------------------------*/

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    /*-------------------------------------------------------------------------------*/
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
    /*---------------------------------------------------------------------------------*/
    public function changePassword(ChangePasswordRequest $request){


        $email = $request->email;
        $key = $request->key;
        $new_password = $request->new_password;
        $user = User::where('email', $email)->first();
        if($user === null){
            return response()->json(['status'=>'not exist'],400);
        }
        if (Hash::check($key, $user->key)){
            $user->password = Hash::make($new_password);
            $user->save();
            return response()->json(['status'=>'Password changed successfully Success'],200);
        }
        return response()->json(['status'=>'key or email is wrong'],400);

    }
    /*------------------------------------------------------------------------------------*/
    public function deleteAccount(){
        // user should be authenticated
        $userId=Auth::id();
        $user=User::find($userId);
        $user->delete();
        return response()->json(['status'=>'Deleted succesffully'],200);

    }

    }

