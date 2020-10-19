<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CompanyRestPassword;
use App\Model\Company;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller{

    public function __construct(){
        $this->middleware(['guest:company']);
    }

    public function sendResetLinkEmail(Request $request){
        $request->validate(['email' => 'required|email']);

//        $company = Company::query()->where("email",$request->email)->first();

        if(!Company::query()->where("email",$request->email)->first()) {
            return response(["status"=>404]);
        }

        $token = rand(1111,9999);
        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);
        Mail::to($request->email)->send(new CompanyRestPassword($token));
        return response(['message'=>trans('company.Email reset password sent to your email'),"status"=>200],200);
    }

}
