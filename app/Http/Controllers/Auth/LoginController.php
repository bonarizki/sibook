<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegisterEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
     /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt($request->except(['_token','remember']))) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'user') {
                return redirect()->intended('/');
            }else{
                return redirect('admin-dashboard');
            }
        }
        
        return back()->with('login_fail','Login Failed! ')
            ->withInput($request->all());
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function changePass(ChangePasswordRequest $request)
    {
        User::find(Auth::user()->id)
        ->update(["password" => bcrypt($request->new_password)]);
        return response()->json(["status"=>"success","message"=>"Password Updated"]); 
    }

    public function resetPass($id)
    {
        User::find($id)
        ->update(["password" => bcrypt("defaultpass123")]);
        return response()->json(["status"=>"success","message"=>"Password Reset"]); 
    }

    public function register(RegisterRequest $request)
    {
        DB::transaction(function () use($request){
            
            $request->merge([
                "password" => bcrypt($request->password)
            ]);

            $data = User::create($request->except('_token','re_password'));
    
            event(new RegisterEvent($data));
        });

        return redirect('login')->with('register_success','Register Success! ');
    }
}
