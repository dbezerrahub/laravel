<?php
namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Services\ApiAuth\Models\ApiAuthenticator;
use App\Services\ApiResponse\Models\ApiResponser;
use App\Exceptions\ApiResponseException;
use App\Services\User\Models\User;
use Illuminate\Http\Response;

class ApiAuthController extends Controller
{
    private ApiAuthenticator $apiAuthenticator;

    public function __construct()
    {
        $this->apiAuthenticator = new ApiAuthenticator();
    }

    public function login(LoginRequest $request)
    {
        $user = User::validateUserCredentials($request) ?? throw new ApiResponseException('Usuário não encontrado para o par client_id/client_secret');        $token = $this->apiAuthenticator->createLoginToken($user);
        $this->apiAuthenticator->deleteExpiredTokens();
        return ApiResponser::show(["token" => $token], Response::HTTP_OK);
    }
}
