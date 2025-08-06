<?php

namespace App\Http\Controllers\Api\front;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\front\LoginRequest;
use App\Http\Requests\Api\front\RegisterRequest;
use App\Http\Requests\Api\front\ResetPassword;
use App\Http\Requests\Api\front\SendOtp;
use App\Http\Requests\Api\front\VerifyEmail;
use App\Models\Otp;
use App\Models\User;
use App\Traits\Response;
use App\Transformers\front\UserTransform;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use Response;

    //register
    public function register(RegisterRequest $request)
    {
      $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

       $user =  User::create($data);

        event(new UserRegistered($user ));

      return $this->responseApi(__('user register successfully'));

    }

    //login
    public function login(LoginRequest $request)
    {

      $data = $request->validated();

     $user = User::WithTrashed()
                  ->where('email',$data['email'])
                  ->first();

       if(!$user || !Hash::check($data['password'],$user->password))           
       {
          return $this->responseApi(__('invalid credintials'));
       }

       if($user->trashed())
       {
         return $this->responseApi(__('account has been deleted'));
       }

       if ($user->is_verified !== 1) 
       {
        return $this->responseApi(__('verify email first'));
       }
       $token = $user->createtoken('auth_token')->plaintexttoken();

       $user = fractal()
                 ->item($user)
                 ->transformWith(new UserTransform())
                 ->toArray();

          return $this->responseApi(__('user login successfully'),$user,200,['token'=>$token]);

    }

  //logout
  public function logout(Request $request)
  {
    $logout = $request->input('logout');

    if(!$logout || $logout == 'onedevice')
    {
        $request->user()->currenttokens()->delete();
        return $this->responseApi(__('user logout from one device'));
    }

    elseif( $logout == 'alldevices')
    {
         $request->user()->tokens()->delete();
        return $this->responseApi(__('user logout from all devices'));
    }

  }

    //sendotp
  public function sendotp(SendOtp $request)
    {
      $data = $request->validated();

    $usage =  $request->input('usage');

    $user =  User::where('email',$data['email'])
                  ->first();

    if(!$user )
    {
        return $this->responseApi(__('no user found'),404);
    }

    Otp::create([
      'user_id'=>$user->id,
      'code'=>rand('1000','9999'),
      'expires_at'=> Carbon::now()->addMinutes(3),
      'usage'=>$usage,
    ]);

     return $this->responseApi(__('send otp successfully'), 200);

}

//verify email
public function verifyemail(VerifyEmail $request)
{
   $data = $request->validated();

   $user = User::withTrashed()
                  ->where('email', $request->email)
                  ->first();

    if (!$user) 
    {
        return $this->responseApi(__('user not found'), 404);
    }

    if ($user->trashed())
     {
        return $this->responseApi(__('account is deleted'), 403);
    }

    $code = $user->otps()
                ->where('code',$data['code'])
                ->where('expired_at','>=',now())
                ->first();

     if(!$code)  
        {
            return $this->responseApi(__('invalid otp'),400);  
        }  
        
          $user->update(['is_verified'=>true]);
       
          $code->update(['usage' => 'verify']);
     
     return $this->responseApi(__('email verify succeessfully'), 200);
}

//reset password
public function resetpassword(ResetPassword $request)
{
    $request->validated();

    $user = User::withTrashed()
                 ->where('email', $request->email)
                 ->first();

    if (!$user) 
    {
        return $this->responseApi(__('user not found'),404);
    }

    if ($user->trashed()) 
    {
        return $this->responseApi(__('account has deleted'), 403);
    }

    $code = Otp::where('user_id', $user->id)
              ->where('code', $request->code)
              ->where('expired_at','>=', now())
              ->first();

    if (!$code) 
    {
        return $this->responseApi(__('invalid otp'), 404);
    }

    if (!Hash::check($request->old_password, $user->password)) {
        return $this->responseApi(__('old password is different than password'), 422);
    }

    if (Hash::check($request->new_password, $user->password)) {
        return $this->responseApi(__('current is same old password,continue'));
    }

    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    $user->save();

    $code->update(['usage' => 'forget']);

    return $this->responseApi(__('change password'), 200);
}

}
