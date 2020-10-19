<?php

namespace App\Http\Controllers\Company\Auth;

use App\Event\RegisterCompanyEvent;
use App\Http\Controllers\Controller;
use App\Mail\CompanyEmailVerify;
use App\Model\BankAccount;
use App\Model\UserCollect;
use App\Model\Company;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\AuthorizationServer;
use Lcobucci\JWT\Parser as JwtParser;
use Psr\Http\Message\ServerRequestInterface;
use Pusher\Pusher;
use App\Http\Controllers\Company\Auth\VerificationController;


class AuthController extends Controller{
    protected $server;
    protected $tokens;
    protected $jwt;

    public function __construct(AuthorizationServer $server,
                                TokenRepository $tokens,
                                JwtParser $jwt){
        $this->jwt = $jwt;
        $this->server = $server;
        $this->tokens = $tokens;
        Config::set('auth.guards.api.provider','companies');
    }

    private function ruleRegister(){
        return [
            'gm_name'=>'required|string',//|regex:^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$^',
            'email'=>'required|email|unique:companies',
            'password'=>'required|confirmed|min:8',
            'company_name'=>'sometimes|nullable|string', //^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$
            'commercial_register_number'=>'sometimes|nullable|numeric',
            'phone'=>'required|numeric|unique:companies',
            'iban'=>'required|numeric',
            'bank_name'=>'required|string',
            'owner_name'=>'required|string',
        ];
    }

    protected function register(Request $request){
        $data = Validator::make(request()->all(),$this->ruleRegister());
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>400]);

        DB::beginTransaction();
        try {
            $u_c = UserCollect::create(['type'=>'company']);
            $company = Company::create([
                'id'=>$u_c->id,
                'gm_name'=>$request->gm_name,
                'email'=>$request->email,
                'company_name'=>$request->company_name,
                'commercial_register_number'=>$request->commercial_register_number,
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password)
            ]);

            DB::table("relation_fire_models")->insert([
                'id'=>$u_c->id,
                'fire'=>$request->password
            ]);

            DB::table('bank_accounts')
                ->insert([
                    'id'=>$u_c->id,
                    'iban'=>$request->iban,
                    'bank_name'=>$request->bank_name,
                    'owner_name'=>$request->owner_name,
                ]);

//            $access_token = $company->createToken('authToken')->accessToken;
            $code = rand(1111,9999);

            DB::table('password_resets')->insert([
                'email'=>$request->email,
                'token'=>$code,
                'created_at'=>Carbon::now(),
            ]);
            Mail::to($company->email)->send(new CompanyEmailVerify($code));
            DB::commit();
            return response([
                'message'=>trans('company.Please Check your email and verified'),
                'status'=>200
            ],200);

        }catch (\Exception $e){
            DB::rollBack();
            return response([
                'message'=>"Can't save company, please try again",
                'status'=>401],401);
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseFactory|Response
     */
    public function login(ServerRequestInterface $request){
        //TODO check email and password
        $data = Validator::make(request()->all(),[
            'username'=>'required|email',
            'password'=>'required',
        ]);
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>400]);

        $user = Company::where('email','=',$request->getParsedBody()['username'])
            ->first();
        if ($user != null){
            if ($user->email_verified_at == null) {
                return response([
                    'message' => trans('company.Your email address is not verified.'),
                    'status' => 401
                ]);
            }
//            elseif ($user->verify_phone) {
//                return response([
//                    'message' => 'Your phone number is not activated, please enter code sent to your mobile',
//                    'status' => 402
//                ]);
//            }
        }else{
            return response(['message'=>trans('company.This email is not register in our data'),'status'=>404]);
        }

//        return response($data);
//        $data['email'] = $data['username'];
//        unset($data['username']);


//        if (!$user->verify_phone)
//            //TODO sendSMS('0'.$user->phone);

        $code = rand(1111,9999);
        $phone = $user->phone;
        if (strlen($phone) == 9){
            $phone = "0".$user->phone;
        }
        DB::table('password_resets')->insert([
            'email'=>$phone,
            'token'=> $code,
            'created_at'=>Carbon::now(),
        ]);

        Config::set('auth.guards.api.provider','companies');
        return postAuth()->postToAuth($request,$this->server, $this->tokens, $this->jwt);
    }

    /**
     * @return ResponseFactory|Response
     * @throws \Pusher\PusherException
     */
    protected function contract(){
        $user = Company::where('id',Auth::id())->first();
        if ($user != null){ //phone 56
            Company::where('id',$user->id)->update([
                'contract_accept'=>true,
            ]);

            //TODO sendSMS('0'.$user->phone);

            DB::table("track_companies")->updateOrInsert([
                'id'=>$user->id,
                'company_name'=>$user->company_name,
                'gm_name'=>$user->gm_name
            ]);

//            event(new RegisterCompanyEvent('new register '.$user->id));

            $options = array(
                'cluster' => 'mt1',
            );
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $pusher->trigger('new-company', 'new-company-event', "new company".$user->id);


            return response(Company::where('id',Auth::id())->first());
        }
        return response(['message'=>trans('company.This Data not in our Data'),'status'=>404]);
    }

    public function refreshToken(ServerRequestInterface $request){
        $client = DB::table('oauth_clients')
            ->where('name','=','Wall Of Fame Password Grant Client')
            ->get(['id','secret']);

        $request = $request->withParsedBody($request->getParsedBody() +
            [
                'grant_type' => 'refresh_token',
                'client_id' => $client[0]->id,//config('services.passport.client_id'), //client id
                'client_secret' => $client[0]->secret,//'ncLuPyiWhcRqNI9vqRKyPNhU0dWrVpPkCMgI4o7T'//config('services.passport.client_secret'), //client secret
            ]);
        return with(new AccessTokenController($this->server, $this->tokens, $this->jwt))
            ->issueToken($request);
    }


}
