<?php
namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Services\ApiAuth\Models\ApiAuthenticator;
use App\Services\ApiResponseService;
use Illuminate\Http\Response;

class ApiAuthController extends Controller
{
    private ApiAuthenticator $apiAuthenticationService;

    public function __construct()
    {
        $this->apiAuthenticationService = new ApiAuthenticator();
    }

    public function login(LoginRequest $request)
    {
        $user = $this->apiAuthenticationService->validateUserClientId($request);
        $token = $this->apiAuthenticationService->createLoginToken($user);
        $this->apiAuthenticationService->deleteExpiredTokens();
        return ApiResponseService::show(["token" => $token], Response::HTTP_OK);
    }
}
