<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ModelUser\ModelInit;
use App\Model\UserCollect;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\DataTables\ModelDataTable;
use Illuminate\Http\Response;
use App\Model\Admin;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        $displayStart = session()->has('displayStart')?$displayStart=intval(session()->get('displayStart')):0;
        $pageLength = session()->has('pageLength')?$pageLength=intval(session()->get('pageLength')):10;
        $dir = session()->has('dir')?$dir=session()->get('dir'):'desc';
        $column = session()->has('column')?$column=intval(session()->get('column')):0;
        $dataTable = new ModelDataTable($displayStart,$pageLength,$column,$dir);
        return $dataTable->render('admin.models.home',['title' => trans('admin.Models Account')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(){
        return view('admin.admins.create' , ['title'=>trans('admin.New Admin')]);
    }

    public function updateStatus(){
        if (request()->ajax()){
            return 'ajax';
        }
        $data = $this->validate(request(),[
            'active'=>'required|in:active,inactive,pending'
        ]);
        ModelInit::where('id',request('id'))->update($data);
        session()->flash('displayStart',request('displayStart'));
        session()->flash('pageLength',request('pageLength'));
        session()->flash('dir',request('dir'));
        session()->flash('column',request('column'));
        session()->flash('success',trans('admin.Record Add Successfully'));
        return redirect(aurl('models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(){
        $data = $this->validate(request(),[
            'name' => 'required|min:6',
            'email' => 'required|email|unique:admins',
            'job_title'=>'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ],[],[
            'name' => trans('admin.Name'),
            'email' => trans('admin.Email'),
            'job_title'=>trans('admin.Job title'),
            'password' => trans('admin.Password'),
            'password_confirmation' => trans('admin.Password Confirmation')
        ]);
        DB::transaction(function () use ($data){
            $u_c = UserCollect::create(['type'=>'admin']);
            Admin::create([
                'id'=>$u_c->id,
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>bcrypt($data['password']),
                'job_title'=>$data['job_title'],
                'status'=>'inactive'
            ]);
        });
        session()->flash('success',trans('admin.Record Add Successfully'));
        return redirect(aurl('admins'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id){
//            ->join('model_profiles',function ($join) use ($id){
//                $join->on('model_inits.id','=','model_profiles.id')
//                    ->where('model_profiles.id', '=',$id);
//            })
//            ->select('model_inits.id as id','phone','instagram','nick_name','img_cover','verify_phone',
//                'active', 'reason_inactive', 'contract_accept', 'end_of_subscription', 'email_verified_at', 'model_inits.created_at',
//                'full_name','email','age','length','weight','nationality','start_work','end_work','path'
//                )
        $models = DB::table('model_inits')
            ->where('id', '=',$id)
            ->select('id','phone','instagram','nick_name','img_cover','verify_phone',
                'active', 'reason_inactive', 'contract_accept', 'end_of_subscription', 'email_verified_at', 'created_at')
            ->first();
        $profile = DB::table('model_profiles')
            ->where('id', '=',$id)
            ->select('full_name','email','age','length','weight','nationality','start_work','end_work')
            ->first();
        $images = DB::table('files')
            ->where('id', '=',$id)
            ->select('path')
            ->get();
        $bankInfo = DB::table('bank_accounts')
            ->where('id', '=',$id)
            ->first();
        return view('admin.models.show',['models'=>$models,'profile'=>$profile,'images'=>$images,'bankInfo'=>$bankInfo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id){
        $admin = Admin::find($id);
        return view('admin.admins.edit',[
            'admin'=>$admin,
            'title'=>trans('admin.Edit Admin'),
            'displayStart' => request('displayStart'),
            'pageLength' => request('pageLength'),
            'dir' =>request('dir'),
            'column' => request('column')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuotationPrice $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id){
        $data = $this->validate(request(),[
            'name' => 'required|min:6',
            'email' => 'required|email|unique:admins,email,'.$id,
            'status' => 'sometimes|nullable',
            'job_title' => 'sometimes|nullable',
            'password' => 'sometimes|nullable|confirmed|min:6',
            'password_confirmation' => 'sometimes|nullable'
        ],[],[
            'name' => trans('admin.Name'),
            'email' => trans('admin.Email'),
            'status' => trans('admin.Status'),
            'job_title' => trans('admin.Job title'),
            'password' => trans('admin.Password'),
            'password_confirmation' => trans('admin.Password Confirmation')
        ]);
        if(request()->has('password')){
            $data['password'] = bcrypt(request('password'));
            Admin::where('id',$id)->update([
                'name'=>$data['name'],'email'=>$data['email'],'status'=>$data['status'],'job_title'=>$data['job_title'], 'password'=>$data['password']]);
        }else{
            Admin::where('id',$id)->update(['name'=>$data['name'],'email'=>$data['email'],'status'=>$data['status'],'job_title'=>$data['job_title']]);
        }
        session()->flash('success',trans('admin.Record Update Successfully'));
        session()->flash('displayStart',request('displayStart'));
        session()->flash('pageLength',request('pageLength'));
        session()->flash('dir',request('dir'));
        session()->flash('column',request('column'));
        return redirect(aurl('admins'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id){
        UserCollect::find($id)->delete();
        session()->flash('success',trans('admin.Record Delete Successfully'));
        session()->flash('displayStart',request('displayStart'));
        session()->flash('pageLength',request('pageLength'));
        session()->flash('dir',request('dir'));
        session()->flash('column',request('column'));
        return redirect(aurl('admins'));
    }

    protected function multi_delete(){
        if(is_array(request('item'))){
            UserCollect::destroy(request('item'));
        }else{
            UserCollect::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.Record Delete Successfully'));
        session()->flash('displayStart',request('displayStart'));
        session()->flash('pageLength',request('pageLength'));
        session()->flash('dir',request('dir'));
        session()->flash('column',request('column'));
        return redirect(aurl('admins'));
    }
}
