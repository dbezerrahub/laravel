<?php

namespace App\Http\Middleware;

use App\Services\ApiAuth\Models\EndpointAuthorizator;
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
            $endpoint = EndpointAuthorizator::where('token', $authKey)
            ->where('endpoint', $request->path())
            ->first();
            if(is_null($endpoint)) {
                return response()->json(["message"=>"EndpointAuthorization: A chave informada não existe. Verifique a autorização no servidor em endpoint_authorizations"], response::HTTP_UNAUTHORIZED);
            }           
            if(!$endpoint->authorized) {
                return response()->json(["message"=>"Endpoint não autorizado para ".$endpoint->frontend->name], response::HTTP_UNAUTHORIZED);
            }
            
        }
        return $next($request);
    }
}
