<?php

namespace App\Http\Lib\CubeSummation;

/**
 * Description of DataManager.
 *
 * @author marlon
 */
class DataManager
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var DataDriverInterface
     */
    protected $driver;

    public function __construct(DataDriverInterface $driver)
    {
        $this->driver = $driver;
        $this->load();
    }

    protected function load()
    {
        $this->data = $this->driver->load();
    }

    public function get(): array
    {
        return $this->data;
    }
}
