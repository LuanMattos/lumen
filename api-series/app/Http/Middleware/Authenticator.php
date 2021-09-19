<?php
namespace App\Http\Middleware;

use App\Models\User;
use Firebase\JWT\JWT;

class Authenticator
{
    public function handle( $request, \Closure $next)
    {
        try{
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace( 'Bearer ', env('JWT_KEY'), $authorizationHeader );
            $dadosAutenticacao = JWT::decode( $token, '', ['HS256'] );
            $user = User::where( 'email', $dadosAutenticacao['email'])->first();

            if ( is_null( $user ) ){
                throw new \Exception();
            }
            
            return $next( $request );
        }catch( \Exception $e ){
            return response()->json('Não autorizado', 401);
        }
    }

}