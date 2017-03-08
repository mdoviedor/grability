<?php

namespace App\Http\Lib\CubeSummation;

/**
 * Description of DataDriverInterface.
 *
 * @author marlon
 */
interface DataDriverInterface
{
    public function load(): array;
}
