<?php

namespace App\Http\Controllers\ModelUser\Auth;

use App\Http\Controllers\Controller;
use App\Model\ModelUser\ModelInit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller{


    public function checkCode(Request $request){
        if (request()->has('email')){
            $data = Validator::make(request()->all(),[
                'email'=>'required|email',
                'code'=>'required|numeric|min:4'
            ]);
            if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
            $check = DB::table('password_resets')
                ->where('email',$request->email)
                ->where('token',$request->code)
                ->where('created_at','>',Carbon::now()->subHours(3))
                ->first();
        }else{
            $data = Validator::make(request()->all(),[
                'phone'=>'required|numeric',
                'code'=>'required|numeric|min:4'
            ]);
            if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
            $check = DB::table('password_resets')
                ->where('email',$request->email)
                ->where('token',$request->code)
                ->where('created_at','>',Carbon::now()->subMinutes(15))
                ->first();
        }
        if (empty($check))
            return response(['message'=>trans(trans('company.Code is incorrect')),'status'=>404]);

        if (request()->has('email')){
            ModelInit::where('id',Auth::id())->update(['email_verified_at'=>Carbon::now()]);

            DB::table('password_resets')
                ->where('email',$request->email)->delete();
        }else{
            ModelInit::where('id',Auth::id())->update(['verify_phone'=>true]);

            DB::table('password_resets')
                ->where('email',$request->phone)->delete();
        }

        return response(['status'=>200],200);
    }
}
