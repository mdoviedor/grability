<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
    protected $fillable = [
        'matrix_size',
        'number_operations',
    ];

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

    /**
     * @param array $data
     *
     * @return \App\OperationQuery|\App\OperationUpdate
     */
    public function createOperation(array $data)
    {
        if ($data['type'] === 'UPDATE') {
            $operationUpdate = new OperationUpdate($data);

            $this->operationsUpdate()->save($operationUpdate);

            return $operationUpdate;
        } else {
            $operationQuery = new OperationQuery($data);

            $this->operationsQuery()->save($operationQuery);

            return $operationQuery;
        }
    }
}
