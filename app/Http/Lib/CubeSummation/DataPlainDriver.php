<?php

namespace App\Http\Lib\CubeSummation;

/**
 * Description of DataPlainDriver.
 *
 * @author marlon
 */
class DataPlainDriver implements DataDriverInterface
{
    protected $data;

    protected $errors;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function errors(): array
    {
    }

    public function load(): array
    {
    }

    public function validation()
    {
    }
}
