<?php

namespace App\Http\Controllers;

use App\Model\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public static function upload($data = []){
        if (in_array('new_name',$data)){
            $new_name = $data['new_name'] === null?time():$data['new_name'];
        }
        if (request()->has($data['file']) && $data['upload_type'] == 'single'){
            Storage::has($data['delete_file'])?Storage::delete($data['delete_file']):'';
            return request()->file($data['file'])->store($data['path']);
        }elseif (request()->has($data['file']) && $data['upload_type'] == 'files'){
            $file = request()->file($data['file']);
            $hashName = $file->hashName();
            $file->store($data['path']);
            DB::table('files')->insert([
                'id'=>$data['id'],
                'path'=>$data['path'].'/'.$hashName,
            ]);
            return $data['path'].'/'.$hashName;
        }
    }
}
