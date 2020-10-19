<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CityDataTable;
use App\Http\Controllers\Controller;
use App\Model\City;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CityDataTable $dataTable
     * @return Response
     */
    public function index(CityDataTable $dataTable)
    {
        return $dataTable->render('admin.cities.home',['title' => trans('admin.Cities')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create(){
        return view('admin.cities.create' , ['title'=>trans('admin.New City')]);
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
            'city_name_ar' => 'required|unique:cities',
            'city_name_en' => 'required|unique:cities'
        ],[],[
            'city_name_ar' => trans('admin.Arabic City Name'),
            'city_name_en' => trans('admin.English City Name')
        ]);
        $data['city_name_en'] = ucwords($data['city_name_en']);
        City::create($data);
        session()->flash('success',trans('admin.Record Add Successfully'));
        return redirect(aurl('cities'));
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
        $city = City::find($id);
        return view('admin.cities.edit',['city'=>$city,'title'=>trans('admin.Edit City')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuotationPrice $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),[
            'city_name_ar' => 'required|unique:cities,city_name_ar,'.$id,
            'city_name_en' => 'required|unique:cities,city_name_en,'.$id
        ],[],[
            'city_name_ar' => trans('admin.Arabic City Name'),
            'city_name_en' => trans('admin.English City Name')
        ]);
        $data['city_name_en'] = ucwords($data['city_name_en']);
        City::where('id',$id)->update($data);
        session()->flash('success',trans('admin.Record Update Successfully'));
        return redirect(aurl('cities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        City::find($id)->delete();
        session()->flash('success',trans('admin.Record Delete Successfully'));
        return redirect(aurl('cities'));
    }

    protected function multi_delete(){
        if(is_array(request('item'))){
            foreach (request('item') as $id){
                City::find($id)->delete();
            }
        }else{
            City::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.Record Delete Successfully'));
        return redirect(aurl('cities'));
    }
}
