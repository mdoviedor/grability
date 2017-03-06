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

    //put your code here
    public function load(): array
    {
        return $this->data;
    }

    public function errors(): array
    {
    }

    public function validation()
    {
    }
}
