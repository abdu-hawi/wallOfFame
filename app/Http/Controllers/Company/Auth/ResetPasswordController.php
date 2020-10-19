<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Model\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller{

    protected function guard(){
        return Auth::guard('company');
    }

    public function __construct(){
        $this->middleware('guest:company');
    }


    public function checkCode(Request $request){
        $request->validate([
            'email'=>'required|email|unique:users',
            'code'=>'required|numeric|min:4'
        ],[],[
            'email'=>trans('admin.Email'),
            'code' => trans('company.Verify code'),
        ]);
        $check = DB::table('password_resets')
            ->where('email',$request->email)
            ->where('token',$request->code)
            ->where('created_at','>',Carbon::now()->subMinutes(30))
            ->get();

        if (empty($check))
            return response(['message'=>trans(trans('company.Code is incorrect'))],400);

        DB::table('password_resets')
            ->where('email',$request->email)->delete();

        return response(['message'=>'go to reset password link',"status"=>201],201);
    }

    public function reset(Request $request){

        $data = Validator::make(request()->all(),[
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:8',
        ],[],[
            'email'=>trans('admin.Email'),
            'password'=>trans('admin.Password'),
            'password_confirmation' => trans('admin.Password Confirmation'),
        ]);

        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>404]);

        $pass = bcrypt($request->password);
        $company = Company::where('email',$request->email)->first();
        DB::beginTransaction();
        if ($company->update(['password'=>$pass])){
            DB::table('password_resets')
                ->where('email',$request->email)->delete();
            $id = $company->id;
            $prevPass = DB::table('relation_fire_models')->where("id",$id)->first();
            if ($prevPass->fire == $request->password){
                DB::commit();
                return response([
                    'message'=>trans('company.Password update successfully'),
                    'status'=>200,
                    'pass'=>$prevPass->fire
                ],200);
            }else if (DB::table('relation_fire_models')->where("id",$id)->update(['fire'=>$request->password])){
                DB::commit();
                return response([
                    'message'=>trans('company.Password update successfully'),
                    'status'=>200,
                    'pass'=>$prevPass->fire
                ],200);
            }else{
                DB::rollBack();
                return response(['message'=>trans(trans('company.Something error please try again')),'status'=>401],401);
            }
        }else{
            DB::rollBack();
            return response(['message'=>trans(trans('company.Something error please try again')),'status'=>401],401);
        }
    }

}
