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
     * @var string
     */
    protected $data;

    /**
     * @param string $data
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function load(): array
    {
        return $this->buildArray($this->data);
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
            throw new ErrorFormatInfoCaseException(sprintf('Formato de la información  del caso invalido.'
                    .' Error en el caso %s', $caseNumber));
        }

        return true;
    }

    public function isValidFormatInfoOperation(array $infoOperation, int $caseNumber): bool
    {
        if ($infoOperation[0] === 'UPDATE' && count($infoOperation) !== 5) {
            throw new ErrorFormatInfoOperationException(sprintf('Formato de la información de la '
                    .'operación UPDATE invalido. Error en el caso %s', $caseNumber));
        } elseif ($infoOperation[0] === 'QUERY' && count($infoOperation) !== 7) {
            throw new ErrorFormatInfoOperationException(sprintf('Formato de la información de la '
                    .'operación QUERY invalido. Error en el caso %s', $caseNumber));
        } elseif ($infoOperation[0] !== 'UPDATE' && $infoOperation[0] !== 'QUERY') {
            throw new ErrorFormatInfoOperationException(sprintf('La operación no es de ningún tipo.'
                    .' Error en el caso %s', $caseNumber));
        }

        return true;
    }

    /**
     * @param string $data
     *
     * @throws ErrorFormatInfoCaseException, ErrorFormatInfoOperationException
     */
    public function buildArray(string $data): array
    {
        $array = [];
        $lines = explode("\n", $data);

        if (count($lines) === 1) {
            throw new ErrorFormatInfoCaseException('Definición incorrecta de la prueba');
        }

        $numberCases = intval($lines[0]);

        $array['T'] = $numberCases;
        $indexCase = 1;
        $caseNumber = 0;
        do {
            ++$caseNumber;

            $infoCase = explode(' ', $lines[$indexCase]);
            $this->isValidFormatInfoCase($infoCase, $caseNumber);

            $matrixSize = $infoCase[0];
            $numberOperations = $infoCase[1];

            $array['cases'][$caseNumber] = [
                'case_number' => intval($caseNumber),
                'matrix_size' => intval($matrixSize),
                'number_operations' => intval($numberOperations),
            ];

            for ($operation = $indexCase + 1; $operation <= ($indexCase + $numberOperations); ++$operation) {
                $infoOperation = explode(' ', $lines[$operation]);

                $this->isValidFormatInfoOperation($infoOperation, $caseNumber);

                if ($infoOperation[0] === 'UPDATE') {
                    $array['cases'][$caseNumber]['operation'][] = [
                        'type' => 'UPDATE',
                        'text' => $lines[$operation],
                        'x' => intval($infoOperation[1]),
                        'y' => intval($infoOperation[2]),
                        'z' => intval($infoOperation[3]),
                        'W' => intval($infoOperation[4]),
                    ];
                } else {
                    $array['cases'][$caseNumber]['operation'][] = [
                        'type' => 'QUERY',
                        'text' => $lines[$operation],
                        'x1' => intval($infoOperation[1]),
                        'y1' => intval($infoOperation[2]),
                        'z1' => intval($infoOperation[3]),
                        'x2' => intval($infoOperation[4]),
                        'y2' => intval($infoOperation[5]),
                        'z2' => intval($infoOperation[6]),
                    ];
                }
            }
            $indexCase += $numberOperations + 1;
        } while ($caseNumber !== $numberCases);

        return $array;
    }
}
