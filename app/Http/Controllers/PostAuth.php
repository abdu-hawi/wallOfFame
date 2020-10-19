<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class PostAuth{

    public function postToAuth(ServerRequestInterface $request,$server, $tokens, $jwt){
        $client = DB::table('oauth_clients')
            ->where('name','=','Wall Of Fame Password Grant Client')
            ->get(['id','secret']);

        $request = $request->withParsedBody($request->getParsedBody() +
            [
                'grant_type' => 'password',
                'client_id' => $client[0]->id,//config('services.passport.client_id'), //client id
                'client_secret' => $client[0]->secret,//'ncLuPyiWhcRqNI9vqRKyPNhU0dWrVpPkCMgI4o7T'//config('services.passport.client_secret'), //client secret
            ]);
        return with(new AccessTokenController($server, $tokens, $jwt))
            ->issueToken($request);
    }
}
