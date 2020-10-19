<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }

    protected function showLoginForm(){
        return view('admin.auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    protected function login(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ],[],[
            'email' => trans('admin.Email'),
            'password' => trans('admin.Password'),
        ]);
        if (admin()->attempt([
            'email' => $request->email,
            'password' => $request->password,],$request->remember)){
            return redirect(aurl());
        }
        session()->flash('error_login',trans('admin.Email Or Password is not correct'));
        return redirect()->back()->withInput($request->only('email','remember'));
    }

}
