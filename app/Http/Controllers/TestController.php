<?php
namespace App\Http\Controllers;

use App\Services\ApiResponse\Models\ApiResponser;
use App\Services\Test\Models\Tester;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    private Tester $test_service;

    public function __construct()
    {
        $this->test_service = new Tester();
    }

    public function print_request(Request $request)
    {
        return Tester::print_request($request);
    }
}
