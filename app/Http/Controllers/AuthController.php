<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        try {
            
            return view('auth/login');

        } catch (Exception $e) {
            return view('error/404');
        }
    }

    public function doLogin(Request $request)
    {
        $request->validate(
            [
                'loginId'=>'required',
                'password'=>'required',
            ]
        );

        $admin=Login::where('USER_ID','=',$request->loginId)->first();
        if($admin)
        {
            if($admin->USER_ROLE == "ADMIN"){
                
                if( md5($request->password) == $admin->USER_PASS)
                {
                    $request->session()->put('aid',$admin->ID);
                    // return session('aid');
                    return redirect()->route('dashboard');
                }
                else{
                    return back()->with('Fail','Password not matches !');
                }
            }else{
                return back()->with('Fail','Only Admin can access this !');
            }

        }
        else{
            return back()->with('Fail','User Id is not valid');
        }
    }

    public function logout()
    {
        session()->forget('aid');
        return redirect()->route('login_page');
    }

    
}
