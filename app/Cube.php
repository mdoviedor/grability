<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function operationsUpdate()
    {
        return $this->hasMany(OperationUpdate::class);
    }

    public function operationsQuery()
    {
        return $this->hasMany(OperationQuery::class);
    }
}
