<?php
namespace App\Services\ApiResponse\Models;

class ApiResponser {
    static function show($array_data, $http_code) {
        return response()->json($array_data, $http_code);
    }
}