<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscriptionDataTable;
use App\Http\Controllers\Controller;
use App\Model\Subscription;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SubscriptionDataTable $dataTable
     * @return Response
     */
    public function index(SubscriptionDataTable $dataTable)
    {
        return $dataTable->render('admin.subscription.home',['title' => trans('admin.Subscriptions')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(){
        return view('admin.subscription.create' , ['title'=>trans('admin.New Subscription')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store()
    {
        $data = $this->validate(request(),[
            'duration_ar' => 'required|unique:subscriptions',
            'duration_en' => 'required|unique:subscriptions',
            'price' => 'required|numeric|unique:subscriptions',
        ],[],[
            'duration_ar' => trans('admin.Duration of subscription in Arabic'),
            'duration_en' => trans('admin.Duration of subscription in English'),
            'price' => trans('admin.Price'),
        ]);
        Subscription::create($data);
        session()->flash('success',trans('admin.Record Add Successfully'));
        return redirect(aurl('subscriptions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $subscription = Subscription::find($id);
        return view('admin.subscription.edit',['subscription'=>$subscription,'title'=>trans('admin.Edit Subscription')]);
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
            'duration_ar' => 'required|unique:subscriptions,duration_ar,'.$id,
            'duration_en' => 'required|unique:subscriptions,duration_en,'.$id,
            'price' => 'required|numeric|unique:subscriptions,price,'.$id,
        ],[],[
            'duration_ar' => trans('admin.Duration of subscription in Arabic'),
            'duration_en' => trans('admin.Duration of subscription in English'),
            'price' => trans('admin.Price'),
        ]);
        Subscription::where('id',$id)->update($data);
        session()->flash('success',trans('admin.Record Update Successfully'));
        return redirect(aurl('subscriptions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Subscription::find($id)->delete();
        session()->flash('success',trans('admin.Record Delete Successfully'));
        return redirect(aurl('subscriptions'));
    }

    protected function multi_delete(){
        if(is_array(request('item'))){
            foreach (request('item') as $id){
                Subscription::find($id)->delete();
            }
        }else{
            Subscription::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.Record Delete Successfully'));
        return redirect(aurl('subscriptions'));
    }
}
