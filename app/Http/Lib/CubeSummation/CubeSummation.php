<?php

namespace App\Http\Lib\CubeSummation;

/**
 * Description of CubeSummation.
 *
 * @author marlon
 */
class CubeSummation
{
    /**
     * @var array
     */
    protected $matrix = [];

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var DataDriverInterface
     */
    protected $driver;

    public function __construct(DataDriverInterface $drive)
    {
        $this->driver = $drive;
    }

    public function get(): array
    {
        $this->run();

        return $this->data;
    }

    protected function run()
    {
        $this->loadDependencies();

        foreach ($this->data['cases'] as $case) {
            foreach ($case['operation'] as $key => $operation) {
                switch ($operation['type']) {
                    case 'UPDATE':
                        $this->update($operation);
                        break;
                    case 'QUERY':
                        $result = $this->query($operation);
                        $this->data['cases'][$case['case_number']]['operation'][$key]['result'] = $result;
                        break;
                }
            }
        }
    }

    protected function loadDependencies()
    {
        $dataManager = new DataManager($this->driver);
        $validation = new Validation($dataManager);
        $this->data = $validation->get();
    }

    protected function update(array $operation)
    {
        $this->matrix[$operation['x']][$operation['y']][$operation['z']] = $operation['W'];
    }

    protected function query(array $operation): int
    {
        $result = 0;
        for ($x = $operation['x1']; $x <= $operation['x2']; ++$x) {
            for ($y = $operation['y1']; $y <= $operation['y2']; ++$y) {
                for ($z = $operation['z1']; $z <= $operation['z2']; ++$z) {
                    if (isset($this->matrix[$x][$y][$z])) {
                        $result += $this->matrix[$x][$y][$z];
                    }
                }
            }
        }

        return $result;
    }
}
