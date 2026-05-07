<?php

namespace App\Services\Log\Models;

use Illuminate\Database\Eloquent\Model;

class CustomLog extends Model
{
    protected $table = 'custom_logs';

    function set($values) {
        $this->error_code = $values['error_code'];
        $this->trace_code = $values['trace_code'];
        $this->trace = $values['trace'];
    }

    function get() {

    }
}
