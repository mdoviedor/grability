<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'size',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cubes()
    {
        return $this->hasMany(Cube::class);
    }
}
