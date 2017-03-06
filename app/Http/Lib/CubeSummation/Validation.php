<?php

namespace App\Http\Lib\CubeSummation;

use App\Http\Lib\CubeSummation\exceptions\ErrorMatrixSizeException;
use App\Http\Lib\CubeSummation\exceptions\ErrorNumberCasesException;

/**
 * Description of Validator.
 *
 * @author marlon
 */
class Validation
{
    protected $data;

    public function __construct(DataManager $data)
    {
        //        if (!is_array($data)) {
//            $this->build_array($data->get());
//        } else {
//            $this->data = $data;
//        }
    }

//    public function build_array(): array {
//
//    }

    public function isValidNumberCases(int $numberCases): bool
    {
        if ($numberCases < 1 || $numberCases > 50) {
            throw new ErrorNumberCasesException(sprintf('Número de pruebas invalido "%s".'
                    .'El número de pruebas debe ser mayor o igual a 1 (uno) y '
                    .'menor o igual a 50 (cincuenta). Error en la línea 1', $numberCases));
        }

        return true;
    }

    public function isValidMatrixSize(int $matrix_size, int $case_number): bool
    {
        if ($matrix_size < 1 || $matrix_size > 100) {
            throw new ErrorMatrixSizeException(sprintf('El tamaño de la matrix es invalido.'
                    .'El tamaño de la matrix debe ser mayor o igual a 1 (uno) y '
                    .'menor o igual a 100 (cien). Error en caso %s', $case_number));
        }

        return true;
    }
}
