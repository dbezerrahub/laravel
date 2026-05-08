<?php

namespace App\Http\Middleware;

use App\Services\ApiAuth\Models\EndpointAuthorizator;
use App\Services\ApiAuth\Models\Frontend;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EndpointAuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->header('Authorization')) {
            $authKey = hash('sha256', $request->header('Endpoint-Authorization-Token'));
            $id_frontend = (int) $request->header('Id-Frontend');
            $endpoint = EndpointAuthorizator::where('token', $authKey)
            ->where('endpoint', $request->path())
            ->where('id_frontend', $id_frontend )
            ->first();
            if(is_null($endpoint)) {
                return response()->json(["message"=>"EndpointAuthorization: A chave informada não existe. Verifique a autorização no servidor em endpoint_authorizations"], response::HTTP_UNAUTHORIZED);
            }           
            if(!$endpoint->authorized) {
                return response()->json(["message"=>"Endpoint não autorizado para ".$endpoint->frontend->name], response::HTTP_UNAUTHORIZED);
            }

            $frontend = Frontend::where('id', $id_frontend)->first();
            if(is_null($frontend)) {
                return response()->json(["message"=>"Frontend não encontrado"], response::HTTP_UNAUTHORIZED);
            }           
            if(!$frontend->authorized) {
                return response()->json(["message"=>"Frontend não autorizado"], response::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }
}
