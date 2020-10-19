<?php

namespace App\Http\Controllers\ModelUser;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RolesValidation;
use App\Mail\ModelsEmailVerify;
use App\Model\BankCard;
use App\Model\ModelUser\ModelInit;
use App\Model\ModelUser\ModelProfile;
use App\Model\Subscription;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ModelProfileController extends Controller
{

    public function uploadImage(){
        if (request()->has('img_cover')){
            $image = request("img_cover");
            $path = 'models/'.auth()->id()."/cover/".time().".jpeg";
        } elseif (\request()->has("image") && \request()->has("id")){
            $image = request("image");
            $path = 'models/'.auth()->id()."/".request("id")."/".time().".jpeg";
        } elseif (request()->has('img_profile')){
            $image = request("img_profile");
            $path = 'models/'.auth()->id()."/".time().".jpeg";
        }else{
            return response(['message'=>'can not store','status'=>500]);
        }

        if (Storage::put($path,base64_decode($image)))
            return response(['message'=>$path,'status'=>200]);
        else
            return response(['message'=>'can not store','status'=>500]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public function store(Request $request){
        $roles = new RolesValidation();
        $data = Validator::make(request()->all(),$roles->modelsProfile());
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);

        for ($i=0;$i<3;$i++){
            if (array_key_exists($i,$request->img_profile))
                DB::table('files')->updateOrCreate([
                    "path"=>$request->img_profile[$i]
                ],[
                    'id'=>Auth::id(),
                    'path'=>$request->img_profile[$i],
                ]);
        }

        ModelProfile::updateOrCreate([
            "id"=>Auth::id()
        ],[
            'full_name' => request('full_name'),
            'age' => request('age'),
            'email' => request('email'),
            'length' => request('length'),
            'weight' => request('weight'),
            'nationality' => request('nationality'),
            'start_work' => request('start_work'),
            'end_work' => request('end_work'),
            'city_id' => request('city_id'),
            'id'=>Auth::id(),
        ]);
        ModelInit::where('id',Auth::id())->update([
            'img_cover'=>request('img_cover'),
            'nick_name'=>request('nick_name'),
        ]);
        DB::table('bank_accounts')
            ->updateOrInsert (['id'=>Auth::id()],[
                'id'=>Auth::id(),
                'iban'=>$request->iban,
                'bank_name'=>$request->bank_name,
                'owner_name'=>$request->owner_name,
            ]);
        $rand = rand(1111,9999);
        DB::table('password_resets')->updateOrInsert([
            'email'=>request('email')
        ],[
            'email'=>request('email'),
            'token'=>$rand,
            'created_at'=>Carbon::now(),
        ]);
        Mail::to(request('email'))->send(new ModelsEmailVerify($rand));
        return response(['message'=>trans('company.Please Check your email and verified'),'status'=>200],200);

    }
    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(){
        $model = Auth::user();
        if ($model != null) {
            // todo sendSMS("0".$model->phone);
        }
        if ($model->end_of_subscription != null && $model->end_of_subscription < Carbon::now()) {
            return response(['status'=>100]);
        }
        $modelData = ModelProfile::where("id",Auth::id())->get();
        if ( count($modelData) > 0){
            $email =  $modelData[0]->email;
        }else{
            $email = "null" ;
        }
        return response(['message'=>Auth::user(),"email"=>$email,'status'=>200]);
    }

    public function getSubscription(){
        return response(["message"=>Subscription::query()->get(),"status"=>200]);
    }

    public function makePayment(){
        $role = new RolesValidation();
        $data = Validator::make(request()->all(),$role->saveCard());
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);

        $endSubscription = Subscription::query()
            ->where("id",request("subscription_id"))
            ->get("months_count");

        ModelInit::where('id',Auth::id())->update([
            'end_of_subscription'=>Carbon::now()->addMonths($endSubscription[0]->months_count)
        ]);

        BankCard::updateOrCreate([
            "id"=>Auth::id()
        ],[
            "card_type"=>request("type"),
            "card_number"=>request("number"),
            "owner_name"=>request("owner"),
            "exp_date"=>request("expDate"),
            "ccv"=>request("ccv"),
        ]);
        return response(["status"=>200]);
    }

    protected function contract(){
        ModelInit::where('id',Auth::id())->update([
            'contract_accept'=>true,
        ]);
        return response(['status'=>200]);
    }

    public function updateFCM(){
        request()->validate([
            'fcm_token'=>"required"
        ]);
        $data = [
            'fcm_token'=>request("fcm_token")
        ];
        ModelInit::where("id",Auth::id())->update($data);
    }

    /*
    public function index()
    {
        //
    }

    public function edit(ModelProfile $modelProfile)
    {
        //
    }

    public function update(Request $request, ModelProfile $modelProfile)
    {
        //
    }

    public function destroy(ModelProfile $modelProfile)
    {
        //
    }
  */
}
