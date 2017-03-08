<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    /**
     * @param array $data
     *
     * @return Test
     */
    public function createTest(array $data)
    {
        $test = new Test($data);

        $this->tests()->save($test);

        return $test;
    }
}
