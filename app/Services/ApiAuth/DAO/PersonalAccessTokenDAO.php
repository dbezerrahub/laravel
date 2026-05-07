<?php

namespace App\Services\ApiAuth\DAO;

use App\Models\DAO\DAO;
use App\Services\ApiAuth\Models\PersonalAccessToken;


class PersonalAccessTokenDAO extends DAO
{
    public static function select($query_key, $where) {
        $queries = [
            
        ];
        return $queries[$query_key]($where);
    }

    public static function update($query_key, $where) {
        $queries = [
            
        ];
        return $queries[$query_key]($where);
    }

    public static function delete($query_key, $where_conditions) {
        $queries = [
            'object'=> function($where_conditions) {
                return self::buildQuery($where_conditions, PersonalAccessToken::query());
            }
        ];
        return $queries[$query_key]($where_conditions)->delete();
    }
}