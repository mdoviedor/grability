<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationQuery extends Model
{
    protected $table = 'operations_query';

    public function cube()
    {
        return $this->belongsTo(Cube::class);
    }
}
