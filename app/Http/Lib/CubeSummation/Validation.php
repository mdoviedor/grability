<?php

namespace App\Http\Lib\CubeSummation;

use App\Http\Lib\CubeSummation\exceptions\ErrorInOperationException;
use App\Http\Lib\CubeSummation\exceptions\ErrorMatrixSizeException;
use App\Http\Lib\CubeSummation\exceptions\ErrorNumberCasesException;
use App\Http\Lib\CubeSummation\exceptions\ErrorNumberOperations;
use App\Http\Lib\CubeSummation\exceptions\ErrorNumberOperationsException;

/**
 * Description of Validator.
 *
 * @author marlon
 */
class Validation
{
    /**
     * @var DataManager
     */
    protected $dataManager;

    /**
     * @param DataManager $data
     */
    public function __construct(DataManager $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function validate(array $data): array
    {
        $this->isValidNumberCases($data['T']);

        foreach ($data['cases'] as $key => $value) {
            $this->isValidMatrixSize($value['matrix_size'], $key);
            $this->isValidNumberOperations($value['number_operations'], $key);
            $this->isValidNumberOperations(count($value['operation']), $key);

            foreach ($data['operation'] as $operation) {
                switch ($operation['type']) {
                    case 'UPDATE':
                        $this->isValidOperationUpdate($operation, $matrixSize, $key);
                        break;
                    case 'QUERY':
                        $this->isValidOperationQuery($operation, $matrixSize, $key);
                        break;
                }
            }
        }

        return $data;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->validate($this->dataManager->get());
    }

    /**
     * @param array $operation
     * @param int   $matrixSize
     * @param int   $caseNumber
     *
     * @return bool
     *
     * @throws ErrorInOperationException
     */
    public function isValidOperationUpdate(array $operation, int $matrixSize, int $caseNumber): bool
    {
        if (!isset($operation['x']) || !isset($operation['y']) || !isset($operation['z']) || !isset($operation['W'])) {
            throw new ErrorInOperationException('Operación UPDATE incompleta en el caso '.$caseNumber);
        }

        $W = $operation['W'];
        $x = $operation['x'];
        $y = $operation['y'];
        $z = $operation['z'];

        if ($W < -10000000000 || $W > 10000000000) {
            throw new ErrorInOperationException(sprintf('La definición de la operación UPDATE es invalida. '
                    .'W debe se mayor a -10^9 y menor a 10^9'
                    .'. Error en el caso %s', $caseNumber));
        } elseif ($x < 1 || $y < 1 || $z < 1 || $x > $matrixSize || $y > $matrixSize || $z > $matrixSize) {
            throw new ErrorInOperationException(sprintf('La definición de la operación UPDATE es invalida. '
                    .'x,y,z deben ser mayor a 1 y menor a %s'
                    .'. Error en el caso %s', $matrixSize, $caseNumber));
        }

        return true;
    }

    /**
     * @param array $operation
     * @param int   $matrixSize
     * @param int   $caseNumber
     *
     * @return bool
     *
     * @throws ErrorInOperationException
     */
    public function isValidOperationQuery(array $operation, int $matrixSize, int $caseNumber): bool
    {
        if (!isset($operation['x1']) || !isset($operation['x2']) || !isset($operation['y1']) || !isset($operation['y2']) || !isset($operation['z1']) || !isset($operation['z2'])) {
            throw new ErrorInOperationException('Operación QUERY incompleta en el caso '.$caseNumber);
        }

        $x1 = $operation['x1'];
        $x2 = $operation['x2'];
        $y1 = $operation['y1'];
        $y2 = $operation['y2'];
        $z1 = $operation['z1'];
        $z2 = $operation['z2'];

        if ($x1 < 1 || $x2 < 1 || $x1 > $x2 || $x1 > $matrixSize || $x2 > $matrixSize) {
            throw new ErrorInOperationException(sprintf('La definición de la operación QUERY es invalida. '
                    .' 1 <= x1 <= x2 <= %s '
                    .'. Error en el caso %s', $matrixSize, $caseNumber));
        } elseif ($y1 < 1 || $y2 < 1 || $y1 > $y2 || $y1 > $matrixSize || $y2 > $matrixSize) {
            throw new ErrorInOperationException(sprintf('La definición de la operación QUERY es invalida. '
                    .' 1 <= y1 <= y2 <= %s '
                    .'. Error en el caso %s', $matrixSize, $caseNumber));
        } elseif ($z1 < 1 || $z2 < 1 || $z1 > $z2 || $z1 > $matrixSize || $z2 > $matrixSize) {
            throw new ErrorInOperationException(sprintf('La definición de la operación QUERY es invalida. '
                    .' 1 <= z1 <= z2 <= %s '
                    .'. Error en el caso %s', $matrixSize, $caseNumber));
        }

        return true;
    }

    /**
     * @param int $numberCases
     *
     * @return bool
     *
     * @throws ErrorNumberCasesException
     */
    public function isValidNumberCases(int $numberCases): bool
    {
        if ($numberCases < 1 || $numberCases > 50) {
            throw new ErrorNumberCasesException(sprintf('Número de pruebas invalido "%s".'
                    .'El número de pruebas debe ser mayor o igual a 1 (uno) y '
                    .'menor o igual a 50 (cincuenta). Error en la línea 1', $numberCases));
        }

        return true;
    }

    /**
     * @param int $matrixSize
     * @param int $caseNumber
     *
     * @return bool
     *
     * @throws ErrorMatrixSizeException
     */
    public function isValidMatrixSize(int $matrixSize, int $caseNumber): bool
    {
        if ($matrixSize < 1 || $matrixSize > 100) {
            throw new ErrorMatrixSizeException(sprintf('El tamaño de la matrix es invalido.'
                    .'El tamaño de la matrix debe ser mayor o igual a 1 (uno) y '
                    .'menor o igual a 100 (cien). Error en el caso %s', $caseNumber));
        }

        return true;
    }

    /**
     * @param int $number_operations
     * @param int $case_number
     *
     * @return bool
     *
     * @throws ErrorNumberOperations
     */
    public function isValidNumberOperations(int $numberOperations, int $caseNuber): bool
    {
        if ($numberOperations < 1 || $numberOperations > 1000) {
            throw new ErrorNumberOperationsException(sprintf('Número de operaciones invalido.'
                    .'El numero de operaciones debe ser mayor o igual a 1 (uno) y '
                    .'menor o igual a 1000 (mil). Error en el caso %s', $caseNuber)
            );
        }

        return true;
    }
}
