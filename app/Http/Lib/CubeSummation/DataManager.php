<?php

namespace App\Http\Lib\CubeSummation;

/**
 * Description of DataManager.
 *
 * @author marlon
 */
class DataManager
{
    protected $data;

    /**
     * @var DataDriverInterface
     */
    protected $driver;

    public function __construct(DataDriverInterface $driver)
    {
        $this->driver = $driver;

        $this->load();
        $this->validate();
    }

    protected function load(): void
    {
        $this->data = $this->driver->load();
    }

    public function get()
    {
        return $this->data;
    }
}
