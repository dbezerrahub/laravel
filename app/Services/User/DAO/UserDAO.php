<?php

namespace App\Services\User\DAO;

use App\Models\DAO\DAO;
use App\Services\User\Models\User;
use Illuminate\Support\Facades\DB;

class UserDAO extends DAO
{
    /**
     * @param $where_conditions [
     * 'where ou orWhere', 
     * 'nome da coluna', 
     * Operador lógico (pode ser omitido), 
     * Valor da condição (pode ser null)
     * ]
     */
    public static function select($query_key, $where_conditions) {
        $queries = [
            'find_first'=> function($where_conditions) {
                return self::buildQuery($where_conditions, User::query())->first();
            },
            'find_all'=> function($where_conditions) {
                return self::buildQuery($where_conditions, User::query())->get();
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