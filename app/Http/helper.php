<?php

use App\Model\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

if(!function_exists('aurl')){
    function aurl($url=null){
        return url('admin/'.$url);
    }
}

if(!function_exists('admin')){
    function admin(){
        return auth()->guard('admin');
    }
}

if(!function_exists('lang')){
    function lang(){
        if(session()->has('lang')){
            return session('lang');
        } else{
            session()->put('lang',setting()->main_lang);
            return session('lang');
        }
    }
}

if(!function_exists('a_dir')){
    function a_dir()
    {
        if(session()->has('lang')){
            if( session('lang') === 'ar' ){
                return 'rtl';
            } else{
                return 'ltr';
            }
        } else{
            if( setting()->main_lang === 'ar' ){
                return 'rtl';
            } else{
                return 'ltr';
            }
        }
    }
}

if(!function_exists('angle')){
    function angle()
    {
        if( lang() == 'ar' ){
            return 'right';
        } else{
            return 'left';
        }
    }
}

if(!function_exists('datatableLang')){
    function datatableLang(){
        return [
            "sProcessing"=> trans('admin.sProcessing'),
            "sLengthMenu"=> trans('admin.sLengthMenu'),
            "sZeroRecords"=> trans('admin.sZeroRecords'),
            "sEmptyTable"=> trans('admin.sEmptyTable'),
            "sInfo"=> trans('admin.sInfo'),
            "sInfoEmpty"=> trans('admin.sInfoEmpty'),
            "sInfoFiltered"=> trans('admin.sInfoFiltered'),
            "sInfoPostFix"=> "",
            "sSearch"=> trans('admin.sSearch'),
            "sUrl"=> "",
            "sInfoThousands"=> ",",
            "sLoadingRecords"=> trans('admin.sLoadingRecords'),
            "oPaginate"=> [
                "sFirst"=> trans('admin.sFirst'),
                "sLast"=> trans('admin.sLast'),
                "sNext"=> trans('admin.sNext'),
                "sPrevious"=> trans('admin.sPrevious')
            ],
            "oAria"=> [
                "sSortAscending"=> trans('admin.sSortAscending'),
                "sSortDescending"=> trans('admin.sSortDescending')
            ]
        ];
    }
}

if(!function_exists('active_menu')){
    function active_menu($link){
        if (preg_match('/'.$link.'/i',Request::segment(2))){
            return ['active' , 'menu-open' , 'display: block;'];
        }else{
            return ['','',''];
        }
    }
}

if(!function_exists('setting')){
    function setting(){
        return Setting::orderBy('id','desc')->first();
    }
}

if(!function_exists('validate_image')){
    function validate_image($ext = null){
        if ($ext === null) return 'file|image|mimes:jpeg,png,jpg,bmp,gif|max:5120';
        else return 'image|mime:'.$ext;
    }
}

if(!function_exists('upload_file')){
    function upload_file(){
        return new App\Http\Controllers\UploadController();
    }
}

if(!function_exists('postAuth')){
    function postAuth(){
        return new App\Http\Controllers\PostAuth();
    }
}

if(!function_exists('displayStart')){
    function displayStart(){
        return session()->has('displayStart')?$displayStart=intval(session()->get('displayStart')):0;
    }
}

if(!function_exists('pageLength')){
    function pageLength(){
        return session()->has('pageLength')?$pageLength=intval(session()->get('pageLength')):10;
    }
}

if(!function_exists('column')){
    function column(){
        return session()->has('column')?$column=intval(session()->get('column')):0;
    }
}

if(!function_exists('sendSMS')){
    function sendSMS($to){
        DB::beginTransaction();
        try {
            $rand = rand(1111,9999);
            DB::table('password_resets')->insert([
                'email'=>$to,
                'token'=>$rand,
                'created_at'=>Carbon::now(),
            ]);
            $username = "abdu.7awi";
            $password = "123456";
            $msg = $rand;
            $sender = "RIOFTECH";
            $client = new \GuzzleHttp\Client();
            $result = $client->post("www.oursms.net/api/sendsms.php?username=$username&password=$password&message=$msg&numbers=$to&sender=$sender");
            DB::commit();
            return response(["message"=>$result,'status'=>200]);
        }catch (\Exception $e){
            DB::rollBack();
            return response(['status'=>500]);
        }


    }
}

if(!function_exists('fcm_notification')){
    function fcm_notification($fcm,$msg){
        $key = "AAAAVtnY2xE:APA91bEZ6SiOqpdw5Bp5QrIeJ0vFW12fZFabr-3ogqinLoOEoxXULD2fTg8IjP8LatlyajKyT9wPbPJ23WSqkk0-C96O2kzfltw0cC9CQNLW_FrX56Ehl0BK1RiHOqlSGNX6SMkY3mY7";
        $url = "https://fcm.googleapis.com/fcm/send";
        $fields = array (
            'registration_ids' => array (
                $fcm
            ),
            'data' => array (
                "message" => $msg
            )
        );
        $headers = array (
            'Authorization: key=' . $key,
            'Content-Type: application/json'
        );
        $client = new GuzzleHttp\Client();
        $result = $client->request("post",$url,[
            'form_params' => $fields,
            'headers' => [
                'Authorization: key=' . $key ,
                'Content-Type: application/json'
            ]
        ]);
        return response(["message"=>$result,'status'=>200]);
    }
}

//if(!function_exists('load_section')){
//    function load_section($select = null , $id = null){
//        $sections = App\Model\Section::selectRaw('id')
//            ->selectRaw('section_name_'.lang().' as text')->selectRaw('parent')->get('id','text','parent');
//        $section_arr = [];
//        foreach ($sections as $section){
//            $list_arr = [];
//
//            $list_arr['icon'] = '';
//            $list_arr['children'] = [];
//            $list_arr['li_attr'] = '';
//            $list_arr['a_attr'] = '';
//
//            if($select !== null && $select == $section->id){
//                $list_arr['state'] = [
//                    'opened' => true,
//                    'selected' => true,
//                ];
//            }
//            if($id !== null && $id == $section->id){
//                $list_arr['state'] = [
//                    'opened' => false,
//                    'selected' => false,
//                    'disabled' => true,
//                    'hidden' => true,
//                ];
//            }
//            $list_arr['id'] = $section->id;
//            $list_arr['text'] = $section->text;
//            $list_arr['parent'] = $section->parent !== null?$section->parent:"#";
//            array_push($section_arr,$list_arr);
//        }
//        return json_encode($section_arr,JSON_UNESCAPED_UNICODE);
//    }
//}
