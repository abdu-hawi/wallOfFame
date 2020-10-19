<?php

namespace App\Http\Controllers\ModelUser;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RolesValidation;
use App\Model\Booking;
use App\Model\Complaint;
use App\Model\QuotationPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ModelsController extends Controller
{
    /*
    public function sendQuotation(){
        $role = new RolesValidation();
        $data = Validator::make(request()->all(),$role->quotationPrice());
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
        $r_quotation = QuotationPrice::create($data);
        fcm_notification(request('fcm_token'),"You have new request quotation");
        return response(["message"=>$r_quotation,"status"=>200]);
    }
    */



    public function getComplaint(){
        $complaint = Complaint::query()
            ->where("model_id",Auth::id())
//            ->where("from","company")
            ->join("companies","complaints.company_id","=","companies.id")
            ->select([
                "complaints.id as id",
                "company_id",
                "company_name",
                "from",
                "gm_name",
                "description",
                "status",
                "complaints.created_at as created_at",
            ])
            ->get();
        return response($complaint);
    }

    public function addComplaint($id){
        $validate = Validator::make(request()->all(),[
            "description"=>"required|string",
        ]);
        if ($validate->fails()) return response(
            ['message'=> $validate->messages(),'status'=>401]
        );
        $data = [
            "model_id" => Auth::id(),
            'company_id'=>$id,
            "description"=>request("description"),
            "from"=>"model"
        ];
        $complaint = Complaint::create($data);
        if ($complaint){
            return response(["status"=>200]);
        }else{
            return response(["status"=>400]);
        }
    }

    public function requestQuotation(){
        $role = new RolesValidation();
        $data = Validator::make(request()->all(),$role->quotationPrice());
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
        $model = Auth::user();
        $r_quotation = QuotationPrice::updateOrCreate([
            "id"=>request("id")
        ],[
            "model_id"=>$model->id,
            "model_nickname"=>$model->nick_name,
            "img_cover"=>$model->img_cover,
            "company_id"=>request("company_id"),
            "company_name"=>request("company_name"),
            "title"=>request("title"),
            "description"=>request("description"),
            "date"=>request("date"),
            "country"=>request("country"),
            "city"=>request("city"),
            "from_user"=>"model",
            "status"=>3,
        ]);
//        $company = (Company::query()->where("id",request("company_id"))->get())[0]->fcm_token;
        // fcm_notification(request('fcm_token'),"new request quotation from: ".$company_name);
        return response(["message"=>$r_quotation,"status"=>200]);
    }

    public function requestsSent(){
        return response(QuotationPrice::query()
            ->where("model_id",Auth::id())
            ->where("from_user", "model")
            ->get());
    }

    public function requestsReceive(){
        return response(QuotationPrice::query()
            ->where("model_id",Auth::id())
            ->where("from_user", "company")
            ->get());
    }

    public function getAllBooking(){
        return response(Booking::query()
            ->where("model_id",Auth::id())
            ->get());
    }

    public function getOpenBooking(){
        return response(Booking::query()
            ->where("model_id",Auth::id())
            ->where("status","open")
            ->get());
    }

    public function getCloseBooking(){
        return response(Booking::query()
            ->where("model_id",Auth::id())
            ->where("status","close")
            ->get());
    }

    public function getCancelBooking(){
        return response(Booking::query()
            ->where("model_id",Auth::id())
            ->where("status","cancel")
            ->get());
    }
}
