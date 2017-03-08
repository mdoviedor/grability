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

    /**
     * @param array $data
     *
     * @return \App\Cube
     */
    public function createCube(array $data)
    {
        $cube = new Cube($data);

        $this->cubes()->save($cube);

        return $cube;
    }
}
