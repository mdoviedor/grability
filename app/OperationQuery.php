<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationQuery extends Model
{
    protected $fillable = ['x1', 'x2', 'y1', 'y2', 'z1', 'z2', 'result'];
    protected $table = 'operations_query';

    public function cube()
    {
        return $this->belongsTo(Cube::class);
    }
}
