<?php

namespace App\Services\ApiAuth\Models;

use Illuminate\Database\Eloquent\Model;

class EndpointAuthorizator extends Model
{

    protected $table = 'endpoint_authorizations';

    /**
     * Relacionamento com frontend (join)
     */
    public function frontend()
    {
        return $this->belongsTo(Frontend::class, 'id_frontend');
    }
}
