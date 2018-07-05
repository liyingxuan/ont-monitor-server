<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NodeInfo extends Model
{
    protected $table = "node_infos";

    protected $fillable = [
        'ip_port',
        'time',
        'client_id'
    ];
}
