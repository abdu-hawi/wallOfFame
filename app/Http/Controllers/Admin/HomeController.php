<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\TrackCompany;
use App\Model\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
//        $CompanyNotRead = TrackCompany::query()->where("isRead","=",0)->count();
//        session()->put('CompanyNotRead',$CompanyNotRead);
        $CompanyNotActive = TrackCompany::query()->where("isActive","=",0)->count();
        $companyCount = Company::query()->count();
        return view('admin.home',[
            'CompanyNotActive'=>$CompanyNotActive,
            'companyCount'=>$companyCount
        ]);
    }
}
