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
