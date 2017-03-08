<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationUpdate extends Model
{
    protected $table = 'operations_update';

    public function cube()
    {
        return $this->belongsTo(Cube::class);
    }
}
