<?php

namespace App\Http\Controllers\ModelUser\Auth;

use App\Http\Controllers\Controller;
use App\Model\ModelUser\ModelInit;
use App\Model\UserCollect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\AuthorizationServer;
use Lcobucci\JWT\Parser as JwtParser;
use Psr\Http\Message\ServerRequestInterface;


class AuthController extends Controller
{
    protected $server;
    protected $tokens;
    protected $jwt;

    public function __construct(AuthorizationServer $server,
                                TokenRepository $tokens,
                                JwtParser $jwt){
        $this->jwt = $jwt;
        $this->server = $server;
        $this->tokens = $tokens;
    }

    protected function register(Request $request){

        $data = Validator::make($request->all(),[
            'phone'=>'required|unique:model_inits|numeric|min:10',
            'instagram'=>'required|unique:model_inits',
        ]);
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
        $pass = bcrypt("Wall0fFame");
        DB::beginTransaction();
        try {
            $us = UserCollect::create(['type'=>'model']);
            ModelInit::create([
                'id'=>$us->id,
                'phone'=>$request['phone'],
                'password'=>$pass,//$data['password'],
                'instagram'=>$request['instagram'],
            ]);
            DB::commit();
//            $accessToken = $user->createToken('authToken')->accessToken;
//            return response(['user'=>$user, 'token'=>$accessToken]);
            return response(['message'=>'confirm phone','status'=>200],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response(['message'=>$e->getMessage(),'status'=>402],402);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function login(ServerRequestInterface $request){
        $data = Validator::make(request()->all(),[
            'phone'=>'required|numeric|min:10',
        ]);
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
        $data = [
            'username'=>request("phone"),
            "password"=>bcrypt("Wall0fFame")
        ];
        $data = $request->withParsedBody($data);
        return postAuth()->postToAuth($data,$this->server, $this->tokens, $this->jwt);
    }

    function sendSMS(){
//        $username = "abdu.7awi";
//        $password = "123456";
//        $msg = 4545;
//        $to = request('phone');
//        $sender = "RIOFTECH";
//        $client = new \GuzzleHttp\Client();
//        $result = $client->post("www.oursms.net/api/sendsms.php?username=$username&password=$password&message=$msg&numbers=$to&sender=$sender");
//        return response(["message"=>$result]);
        $re = rand(0,1);
        if ($re){
            return response(['status'=>200]);
        }else{
            return response(['status'=>400]);
        }
//        return response(sendSMS(request('phone')));
    }
}
