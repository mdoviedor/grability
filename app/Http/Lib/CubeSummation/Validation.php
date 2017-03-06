<?php

namespace App\Http\Lib\CubeSummation;

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
     * @var array
     */
    protected $data;

    /**
     * @param DataManager $data
     */
    public function __construct(DataManager $data)
    {
        $this->data = $this->validate($data->get());
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
            $this->isValidMatrixSize($value[$matrix_size], $key);
            $this->isValidNumberOperations($value['number_operations'], $key);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->data;
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
     * @param int $matrix_size
     * @param int $case_number
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
