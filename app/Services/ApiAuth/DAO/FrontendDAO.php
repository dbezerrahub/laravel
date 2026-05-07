<?php

namespace App\Services\ApiAuth\DAO;

use App\Models\DAO;
use App\Services\ApiAuth\Models\Frontend;

class FrontendDAO extends DAO
{
    public static function select($query_key, $where_conditions) {
        $queries = [
            'find_first'=> function($where_conditions) {
                return self::buildQuery($where_conditions, Frontend::query())->first();
            }
        ];
        return $queries[$query_key]($where_conditions);
    }

    public static function update($query_key, $where) {
        $queries = [
            
        ];
        return $queries[$query_key]($where);
    }
}