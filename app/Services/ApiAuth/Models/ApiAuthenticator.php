<?php

namespace App\Services\ApiAuth\Models;

use App\Exceptions\ApiResponseException;
use App\Services\User\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ApiAuthenticator
{

    /**
     * Valida os parametros passados para o endpoint api/auth-interface/login
     * @param Request $request
     * @return array
     */
    function loginRequestValidation(Request $request) {
        $request->validate([
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);
        return $request->toArray();
    }

    /**
     * Valida o usuário pelo client_id e o client_secret 
     * @param FormRequest $request
     * @throws ApiResponseException
     * @return User
     */
    function validateUserClientId(FormRequest $request) {
        $user = User::find_first([['where', 'email', '=', $request->client_id]]);
        $request_client_secret = hash('sha256', $request->client_secret);
        if ($user instanceof User) {
            $user_client_secret = $user->client_secret;  
            #if ($request_client_secret == $user_client_secret) {  
                return $user;
            #}
        } 
        throw new ApiResponseException(
            'Usuário não encontrado para o par client_id/client_secret',
            400
        );
    }

    /**
     * Cria o token de login para o usuário
     * @param User $user
     */
    public function createLoginToken(User $user)
    {
        $token = $user->createToken('auth_token')->plainTextToken;
        $token_id = explode('|', $token)[0];
        $personalAccessToken = PersonalAccessToken::find($token_id);
        $personalAccessToken->expires_at = Carbon::now()->addHours(1);
        $personalAccessToken->save();
        
        return $token;
    }

    /**
     * Deleta tokens expirados no banco
     * @return void
     */
    function deleteExpiredTokens() {
        PersonalAccessToken::deleteExpiredTokens();
    }
}
