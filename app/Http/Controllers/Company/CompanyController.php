<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RolesValidation;
use App\Model\Booking;
use App\Model\CancelBooking;
use App\Model\Company;
use App\Model\Complaint;
use App\Model\Favorite;
use App\Model\ModelUser\ModelInit;
use App\Model\QuotationPrice;
use App\Model\BankCard;
use App\Model\Rate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Model\City;
use App\Model\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{

    public function __construct(){
        Config::set('auth.guards.api.provider','companies');
    }

    public function uploadImage(){
        if (!request()->has("image") && !request()->has("id"))
            return response(['message'=>'can not store','status'=>500]);
        $image = request("image");
        $path = 'chat/company/'.auth()->id()."/".request("id")."/".time().".jpeg";

        if (Storage::put($path,base64_decode($image)))
            return response(['message'=>$path,'status'=>200]);
        else
            return response(['message'=>'can not store','status'=>500]);
    }

    public function getCity(){
        return City::Query()->get();
    }

    public function getModels(){
        if (request()->has("city_id") && request("city_id") != 1)
            return DB::table("model_profiles")
                ->join("model_inits",function ($qry){
                    $qry->on("model_inits.id","=","model_profiles.id")
                        ->where([
                            ["active","=","active"],
                            ["verify_phone","=",true],
                            ["contract_accept","=",true],
                            ["fcm_token","!=",null],
                            ["end_of_subscription",">",Carbon::now()],
                        ]);
                })
                ->where("model_profiles.city_id","=",request("city_id"))
                ->leftJoin("favorites",function ($qry){
                    $qry->on("favorites.model_id","=","model_profiles.id");
//                        ->where("favorites.company_id","=",auth()->id());
                })
                ->leftJoin("cities","model_profiles.city_id","=","cities.id")
                ->select([
                    "model_inits.id as id",
                    "phone",
                    "city_name_ar",
                    "city_name_en",
                    "city_id" ,
                    "nick_name",
                    "img_cover",
                    "age",
                    "length",
                    "weight",
                    "favorites.id as favorite",
                    "rate",
                    "nationality",
                    "fcm_uid",
                ])
                ->paginate(10);
        else
            return DB::table("model_profiles")
                ->join("model_inits",function ($qry){
                    $qry->on("model_inits.id","=","model_profiles.id")
                        ->where([
                            ["active","=","active"],
                            ["verify_phone","=",true],
                            ["contract_accept","=",true],
                            ["fcm_token","!=",null],
                            ["end_of_subscription",">",Carbon::now()],
                        ]);
                })
                ->leftJoin("favorites",function ($qry){
                    $qry->on("favorites.model_id","=","model_profiles.id");
//                        ->where("favorites.company_id","=",auth()->id());
                })
                ->leftJoin("cities","model_profiles.city_id","=","cities.id")
                ->select([
                    "model_inits.id as id",
                    "phone",
                    "city_name_ar",
                    "city_name_en",
                    "city_id" ,
                    "nick_name",
                    "img_cover",
                    "age",
                    "length",
                    "weight",
                    "favorites.id as favorite",
                    "rate",
                    "nationality",
                    "fcm_uid",
                ])
                ->paginate(10);
    }

    public function requestQuotation(){
        $role = new RolesValidation();
        $data = Validator::make(request()->all(),$role->quotationPrice());
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
        $company_id = Auth::user()->id;
        $company_name = "" ;
        if (Auth::user()->company_name == null) {
            $company_name = Auth::user()->gm_name;
        }else{
            $company_name = Auth::user()->company_name;
        }
        // return response($company_name);
        $r_quotation = QuotationPrice::updateOrCreate([
            "id"=>request("id")
        ],[
            "model_id"=>request("model_id"),
            "model_nickname"=>request("model_nickname"),
            "img_cover"=>request("img_cover"),
            "company_id"=>$company_id,
            "company_name"=>$company_name,
            "title"=>request("title"),
            "description"=>request("description"),
            "date"=>request("date"),
            "country"=>request("country"),
            "city"=>request("city"),
            "from_user"=>"company",
        ]);
//        $company = (Company::query()->where("id",request("company_id"))->get())[0]->fcm_token;
        // fcm_notification(request('fcm_token'),"new request quotation from: ".$company_name);
        return response(["message"=>$r_quotation,"status"=>200]);
    }

    public function show(){
        // Company::where("id",Auth::user()->id)->update("fcm_uid",request("fcm_uid"));
        return response(Auth::user(),200);
    }

    public function requestsSent(){
        return response(QuotationPrice::query()
            ->where("company_id",Auth::user()->id)
            ->where("from_user", "company")
            ->get());
    }

    public function requestsReceive(){
        return response(QuotationPrice::query()
            ->where("company_id",Auth::user()->id)
            ->where("from_user", "model")
            ->get());
    }

    public function quotationStatus(){
        $status = QuotationPrice::query()
            ->where("id",request("id"))
            ->update([
                "status"=> request("status"),
                "explain_status" => request("msg")
            ]);
        if ($status) {
            return response(['qStatus'=>request("status"),"status"=>200]);
        }
        return response(["status"=>400]);
    }

    public function getModelsCover(){
         return response(ModelInit::query()
             ->where("id",request("id"))
             ->get("img_cover"));
    }

    public function saveCard(){
        $role = new RolesValidation();
        $data = Validator::make(request()->all(),$role->saveCard());
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
        $r_quotation = BankCard::updateOrCreate([
            "id"=>Auth::id()
        ],[
            "card_type"=>request("type"),
            "card_number"=>request("number"),
            "owner_name"=>request("owner"),
            "exp_date"=>request("expDate"),
            "ccv"=>request("ccv"),
        ]);
        return response(["message"=>$r_quotation,"status"=>200]);
    }

    public function getAllBooking(){
        return response(Booking::query()
             ->where("company_id",Auth::id())
             ->get());
    }

    public function getOpenBooking(){
        return response(Booking::query()
             ->where("company_id",Auth::id())
             ->where("status","open")
             ->get());
    }

    public function getCloseBooking(){
        return response(Booking::query()
             ->where("company_id",Auth::id())
             ->where("status","close")
             ->get());
    }

    public function getCancelBooking(){
        return response(Booking::query()
             ->where("company_id",Auth::id())
             ->where("status","cancel")
             ->get());
    }

    public function postCloseBooking(){
        $data = Validator::make(request()->all(),[
            'booking_id' => "required|numeric",
            'model_id' => "required|numeric",
            'rate' => "required|numeric|in:1,2,3,4,5",
            "comment" => "sometimes|nullable|string",
        ]);
        if ($data->fails()) {return response(["status"=>401]);}//, "message"=>$data->messages()]);}
        DB::beginTransaction();
        try {
            Rate::query()->create([
                'booking_id' => request('booking_id'),
                'model_id' => request('model_id'),
                'rate' => request('rate'),
                "comment" => request('comment'),
                "company_id" => Auth::id()
            ]);
            Booking::query()->where("id",request('booking_id'))->update([
                "status"=>"close"
            ]);
            DB::commit();
            //TODO: push to admin to trans money
            return response(["status"=>200]);
        }catch (\Exception $e){
            DB::rollBack();
            return response(["status"=>402]);//, "message"=>$e]);
        }
    }


    public function postCancelBooking(){
        $data = Validator::make(request()->all(),[
            'booking_id' => "required|numeric",
            'model_id' => "required|numeric",
        ]);
        if ($data->fails()) {return response(["status"=>401]);}//, "message"=>$data->messages()]);}
        DB::beginTransaction();
        try {
            Rate::query()->create([
                'booking_id' => request('booking_id'),
                'model_id' => request('model_id'),
                'rate' => 5,
                "company_id" => Auth::id()
            ]);
            Booking::query()->where("id",request('booking_id'))->update([
                "status"=>"cancel"
            ]);
            DB::commit();
            //TODO: push to admin to trans money
            return response(["status"=>200]);
        }catch (\Exception $e){
            DB::rollBack();
            return response(["status"=>402]);//, "message"=>$e]);
        }
    }

    public function postCancelReturnMoneyBooking(){
        $data = Validator::make(request()->all(),[
            'booking_id' => "required|numeric",
            'model_id' => "required|numeric",
            "description" => "required|string",
        ]);
        if ($data->fails()) {return response(["status"=>401]);}//, "message"=>$data->messages()]);}
        DB::beginTransaction();
        try {
            CancelBooking::query()->create([
                'booking_id' => request('booking_id'),
                'model_id' => request('model_id'),
                "description" => request('description'),
                "company_id" => Auth::id()
            ]);
            Booking::query()->where("id",request('booking_id'))->update([
                "status"=>"cancel"
            ]);
            DB::commit();
            //TODO: push to admin to trans money
            return response(["status"=>200]);
        }catch (\Exception $e){
            DB::rollBack();
            return response(["status"=>402]);//, "message"=>$e]);
        }
    }

    public function doPayment(){
        DB::beginTransaction();
        try {

            QuotationPrice::query()->where("id",request("id"))
                ->update(["status"=> request("status")]);

            $quotation = QuotationPrice::where("id",request("id"))->get();
            $quotation = $quotation[0];
            $model_uid = (ModelInit::query()->where('id',$quotation->model_id)->get("fcm_uid"))[0]->fcm_uid;
            $company_uid = (Company::query()->where('id',Auth::id())->get("fcm_uid"))[0]->fcm_uid;
            Booking::create([
                'ref_payment'=>'ref_payment',
                'model_id' =>$quotation->model_id,
                'model_nickname' =>$quotation->model_nickname,
                'company_id' =>$quotation->company_id,
                'company_name' =>$quotation->company_name,
                'title' =>$quotation->title,
                'country' =>$quotation->country,
                'city' =>$quotation->city,
                'description' =>$quotation->description,
                'date' =>$quotation->date,
                'img_cover' =>$quotation->img_cover,
                'model_uid' =>$model_uid,
                'company_uid' =>$company_uid,
                'time' =>$quotation->time,
                'price' =>$quotation->price,
            ]);
            DB::commit();
            return response(["qStatus"=>"","status"=>200]);
        }catch (\Exception $e){
            DB::rollBack();
            return response(["status"=>400,$e]);
        }

    }

    public function getImageProfile($id){
        return response(File::where("id",$id)->get());
    }

    public function addFavorite($id){
        if ( DB::table("favorites")->updateOrInsert([
            "model_id"=>$id,
            "company_id"=>Auth::id()
        ],[
            "model_id"=>$id,
            "company_id"=>Auth::id()
        ]) ) return response(["status"=>200]);
        else return response(["status"=>400]);
    }

    public function deleteFavorite($id){
        if (DB::table("favorites")->where([
            "model_id"=>$id,
            "company_id"=>Auth::id()
        ])->delete()) return response(["status"=>200]);
        else return response(["status"=>400]);
    }

    public function getFavorite(){
        return Favorite::query()->where("company_id",Auth::id())
            ->join("model_inits","model_inits.id","=","model_id")
            ->select([
                "favorites.id as id",
                "model_id",
                "img_cover",
                "nick_name"
            ])
            ->get();
    }

    public function getComplaint(){
        $complaint = Complaint::query()
            ->where("company_id",Auth::id())
//            ->where("from","company")
            ->join("model_inits","complaints.model_id","=","model_inits.id")
            ->select([
                "complaints.id as id",
                "model_id",
                "from",
                "img_cover",
                "nick_name",
                "description",
                "status",
                "complaints.created_at as created_at",
            ])
            ->get();
        return response($complaint);
    }

    public function addComplaint($id){
        $validate = Validator::make(request()->all(),[
            "description"=>"required|string"//regex:^[a-zA-Z0-9\/_.,:-]+( [a-zA-Z0-9\/_.,:-]+)*$^",
        ]);
        if ($validate->fails()) return response(
            ['status'=>401]
        );
        $data = [
                "model_id" => $id,
                'company_id'=>Auth::id(),
                "description"=>request("description"),
                "from"=>"company"
            ];
        if (Complaint::create($data) ){
            return response(["status"=>200]);
        }else{
            return response(["status"=>400]);
        }
    }

    public function updateAccount(){
        $role = new RolesValidation();
        $data = Validator::make(request()->all(),$role->updateAccount());
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
        $data = [
                'phone'=>request("phone"),
                "email"=>request("email"),
                "gm_name"=>request("gm_name")
            ];
        Company::where("id",Auth::id())->update($data);
        $company = Company::query()->where("id",Auth::id())->get();
        return response(["message"=>$company,"status"=>200]);
    }

    public function updateFCM(){
        request()->validate([
            'fcm_token'=>"required"
        ]);
        $data = [
            'fcm_token'=>request("fcm_token")
        ];
        Company::where("id",Auth::id())->update($data);
    }
/*
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
*/
}
