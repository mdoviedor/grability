<?php

namespace App\Http\Lib\CubeSummation;

use Http\Lib\CubeSummation\DataDriverInterface;

/**
 * Description of CubeSummation.
 *
 * @author marlon
 */
class CubeSummation
{
    protected $erros;
    protected $results = [];

    /**
     * @var DataDriverInterface
     */
    protected $data;

    public function __construct(DataDriverInterface $data)
    {
        $this->data = $data;
    }

    public function execute(): void
    {
    }
}
