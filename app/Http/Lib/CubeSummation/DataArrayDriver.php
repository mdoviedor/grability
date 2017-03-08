<?php

namespace App\Http\Lib\CubeSummation;

/**
 * Description of DataArrayDriver.
 *
 * @author marlon
 */
class DataArrayDriver implements DataDriverInterface
{
    protected $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function load(): array
    {
        return $this->data;
    }
}
