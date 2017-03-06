<?php

namespace App\Http\Lib\CubeSummation;

use App\Http\Lib\CubeSummation\exceptions\ErrorFormatInfoCaseException;
use App\Http\Lib\CubeSummation\exceptions\ErrorFormatInfoOperationException;

/**
 * Description of DataPlainDriver.
 *
 * @author marlon
 */
class DataPlainDriver implements DataDriverInterface
{
    /**
     * @param string $data
     */
    public function __construct(string $data)
    {
        $this->data = $this->buildArray($data);
    }

    /**
     * @return array
     */
    public function load(): array
    {
        return $this->data;
    }

    /**
     * @param array $info_case
     * @param int   $case_number
     *
     * @return bool
     *
     * @throws ErrorFormatInfoCase
     */
    public function isValidFormatInfoCase(array $infoCase, int $caseNumber): bool
    {
        if (count($infoCase) !== 2) {
            throw new ErrorFormatInfoCase(spintf('Formato de la información  del caso invalido.'
                    .' Error en el caso %s', $caseNumber));
        }

        return true;
    }

    public function isValidFormatInfoOperation(array $infoOperation, int $caseNumber): bool
    {
        if ($infoOperation[0] === 'UPDATE' && count($infoOperation) !== 5) {
            throw new ErrorFormatInfoOperationException(sprintf('Formato de la información de la '
                    .'operación UPDATE invalido. Error en el caso %s'.$caseNumber));
        } elseif ($infoOperation[0] === 'QUERY' && count($infoOperation) !== 7) {
            throw new ErrorFormatInfoOperationException(sprintf('Formato de la información de la '
                    .'operación QUERY invalido. Error en el caso %s'.$caseNumber));
        } elseif ($infoOperation[0] !== 'UPDATE' && $infoOperation[0] !== 'QUERY') {
            throw new ErrorFormatInfoOperationException(sprintf('La operación no es de ningún tipo.'
                    .' Error en el caso %s'.$caseNumber));
        }

        return true;
    }

    /**
     * @param string $data
     *
     * @throws ErrorFormatInfoCaseException
     */
    public function buildArray(string $data): array
    {
        $array = [];
        $lines = explode("\n", $data);

        $numberCases = $lines[0];

        $array['T'] = $numberCases;
        $indexCase = 1;
        do {
            $caseNumber += 1;

            $infoCase = explode(' ', $lines[$indexCase]);

            $this->isValidFormatInfoCase($infoCase, $caseNumber);

            $matrixSize = $infoCase[0];
            $numberOperations = $info_case[1];

            $array['cases'][$caseNumber] = [
                'case_number' => $caseNumber,
                'matrix_size' => $matrixSize,
                'number_operations' => $numberOperations,
            ];

            for ($operation = $indexCase; $operation <= ($indexCase + $numberOperations); ++$operation) {
                $infoOperation = explode(' ', $lines[$indexCase]);

                $this->isValidFormatInfoOperation($infoOperation, $caseNumber);

                $array[$case_number]['operation'][] = $info_operation;
            }
        } while (true);

        return $array;
    }
}
