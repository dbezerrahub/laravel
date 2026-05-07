<?php
namespace App\Services\Test\Models;

use App\Exceptions\Handler;
use App\Services\ApiResponse\Models\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Tester
{

    public function saveLog(Request $request) {
        $request_array = $request->toArray();
        $Handler = new Handler();
        $Handler->saveLog($request_array);
    }

    static function print_request(Request $request) {
        $request_array = $request->toArray();
        return ApiResponser::show($request_array, Response::HTTP_OK);
    }
}