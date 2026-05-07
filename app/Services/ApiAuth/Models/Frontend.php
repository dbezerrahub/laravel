<?php

namespace App\Services\ApiAuth\Models;

use App\Services\ApiAuth\DAO\FrontendDAO;
use App\Services\ApiAuth\Models\EndpointAuthorizator;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Frontend extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'client_id', 'client_secret'];

    // Relacionamento com FrontendAuthorization
    public function frontendAuthorizations()
    {
        return $this->hasMany(EndpointAuthorizator::class, 'id_frontend');
    }

    public static function find_first($where) {
        return FrontendDAO::select('find_first', $where);
    }
}
