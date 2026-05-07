<?php

namespace App\Services\ApiAuth\Models;

use App\Services\ApiAuth\DAO\PersonalAccessTokenDAO;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PersonalAccessToken extends Model
{
    public static function deleteExpiredTokens() {
        $qtd_deleted_tokens = PersonalAccessTokenDAO::delete('object', [['where','expires_at','<',Carbon::now()],['orwhere','expires_at',null]]);
        return response()->json(['deleteExpiredApiTokens'=>"$qtd_deleted_tokens api tokens deletados"]);
    }
}
