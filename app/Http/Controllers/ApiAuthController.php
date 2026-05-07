<?php
namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Services\ApiAuth\Models\ApiAuthenticator;
use App\Services\ApiResponse\Models\ApiResponser;
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
        $user = $this->apiAuthenticator->validateUserCredentials($request);
        $token = $this->apiAuthenticator->createLoginToken($user);
        $this->apiAuthenticator->deleteExpiredTokens();
        return ApiResponser::show(["token" => $token], Response::HTTP_OK);
    }
}
