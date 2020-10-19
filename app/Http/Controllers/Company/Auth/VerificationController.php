<?php

namespace App\Http\Controllers\Company\Auth;

use App\Mail\CompanyEmailVerify;
use App\Model\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VerificationController extends Controller{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:3,1')->only('verify', 'resend');
        Config::set('auth.guards.api.provider','companies');
    }


    public function resendVerifyEmail(Request $request){
        $company = Company::where('email',$request->email)->first();
        if (!request()->has("resend")){
            if (!empty($company->email_verified_at))
                return response(['message'=>trans('company.Already verified'),'status'=>401],401);
        }

        if (empty($company))
            return response(['message'=>trans('company.This email is not register in our data'),'status'=>400],400);
        $code = rand(1111,9999);
        $verify = DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$code,
            'created_at'=>Carbon::now(),
        ]);
        Mail::to($company->email)->send(new CompanyEmailVerify($code));
        return response([
            'message'=>trans('company.Please Check your email and verified'),
            'status'=>200
        ],200);
    }

    public function resendVerifyPhone(Request $request){
        $company = Company::where('phone',$request->phone)->first();
//        if (!empty($company->verify_phone ))
//            return response(['message'=>trans('company.Already verified'),'status'=>401],401);
        if (empty($company))
            return response([
                'message'=>trans('company.This phone is not register in our data'),'status'=>400
            ],400);

        if ( substr(auth()->user()['phone'],-9) !=  $request->phone){
            return response(['status'=>401]);
        }

        $code = rand(1111,9999);
        DB::table('password_resets')->insert([
            'email'=>$request->phone,
            'token'=>$code,
            'created_at'=>Carbon::now(),
        ]);
//        sendSMS('0'.$request->phone);
        return response([
            'message'=>trans('company.Please check your phone and verify'),
            'status'=>200
        ],200);
    }

    public function verifyEmail(Request $request){
        $data = Validator::make(request()->all(),[
            'email'=>'required|email',
            'code'=>'required|numeric|min:4'
        ],[],[
            'email'=>trans('admin.Email'),
            'code' => trans('company.Verify code'),
        ]);
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>404]);

        $user = Company::where('email',$request->email)->first();
        if (!empty($user->email_verified_at))
            return response([
                'message'=>trans('company.Already verified'),
                'status' => 403
            ]);

        $check = DB::table('password_resets')
            ->where('email',$request->email)
            ->where('token',$request->code)
            ->where('created_at','>',Carbon::now()->subHours(3))
            ->first();
        if (empty($check))
            return response(['message'=>trans(trans('company.Code is incorrect')),'status'=>404]);

        Company::where('email',$request->email)->update(['email_verified_at'=>Carbon::now()]);

        DB::table('password_resets')
            ->where('email',$request->email)->delete();

        return response(['status'=>200],200);
    }


    public function verifyPhone(Request $request){
        $data = Validator::make(request()->all(),[
            'phone'=>'required|numeric|min:10',
            'code'=>'required|numeric|min:4'
        ],[],[
            'phone'=>trans('company.Phone'),
            'code' => trans('company.Verify code'),
        ]);
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>406]);

        $user = Company::where('phone',$request->phone)->first();
        if (empty($user)) return response([
            'message'=> trans('company.This Data not in our Data'),
            'status'=>403
        ]);

        $check = DB::table('password_resets')
            ->where('email',$request->phone)
            ->where('token',$request->code)
            ->where('created_at','>',Carbon::now()->subHours(3))
            ->first();

        if (empty($check))
            return response(['message'=>trans(trans('company.Code is incorrect')),'status'=>404]);

        Company::where('phone',$request->phone)->update(['verify_phone'=>true]);

        DB::table('password_resets')
            ->where('email',$request->phone)->delete();

//        return response(["message"=>auth()->user(),'status'=>200]);
        return response(["message"=>Company::where('phone',$request->phone)->first(),'status'=>200]);
    }


}
