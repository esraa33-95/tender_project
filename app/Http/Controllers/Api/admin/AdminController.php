<?php

namespace App\Http\Controllers\Api\admin;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\admin\LoginRequest;
use App\Http\Requests\Api\admin\RegisterRequest;
use App\Models\User;
use App\Traits\Response;
use App\Transformers\admin\admintransform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use Response;

    //register
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

       $admin =  User::create($data);

        event(new UserRegistered($admin ));

      return $this->responseApi(__('Admin register successfully'));

    }

    //login
    public function login(LoginRequest $request)
    {
      $data = $request->validated();

    $user =  User::where('email',$data['email'])
                 ->where('user_type', 1)
                 ->first();

    if(!$user || !Hash::check($data['password'],$user->password))
    {
        return $this->responseApi(__('invalid credintials'));
    }

    $token = $user->createtoken('auth_token')->plaintexttoken();

      $admin = fractal()
                 ->item($user)
                 ->transformWith(new admintransform())
                 ->toArray();

          return $this->responseApi(__('admin login successfully'),$admin,200,['token'=>$token]);

    }

  //logout 
public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return $this->responseApi(__('admin logout from device'));
        
}







}
