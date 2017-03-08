<?php

use App\Http\Lib\CubeSummation\DataPlainDriver;
use App\Http\Lib\CubeSummation\exceptions\ErrorFormatInfoCaseException;
use App\Http\Lib\CubeSummation\exceptions\ErrorFormatInfoOperationException;

/**
 * Description of DataPlainDriverValidation.
 *
 * @author marlon
 */
class DataPlainDriverTest extends PHPUnit_Framework_TestCase
{
    public function test_build_array_success()
    {
        $data = '2
4 5
UPDATE 2 2 2 4
QUERY 1 1 1 3 3 3
UPDATE 1 1 1 23
QUERY 2 2 2 4 4 4
QUERY 1 1 1 3 3 3
2 4
UPDATE 2 2 2 1
QUERY 1 1 1 1 1 1
QUERY 1 1 1 2 2 2
QUERY 2 2 2 2 2 2
                ';

        $dataPlainDriver = new DataPlainDriver($data);

        $response = $dataPlainDriver->load();

        $this->assertEquals(2, count($response['cases']));
        $this->assertEquals(5, $response['cases'][1]['number_operations']);
        $this->assertEquals(4, $response['cases'][2]['number_operations']);
        $this->assertEquals('QUERY', $response['cases'][1]['operation'][3]['type']);
    }

    //----------------------------------------------------

    public function test_format_info_case_success()
    {
        $dataPlainDriver = new DataPlainDriver('xxx');

        $infoCase = explode(' ', '2 5');

        $response = $dataPlainDriver->isValidFormatInfoCase($infoCase, 1);

        $this->assertTrue($response);
    }

    public function test_error_in_format_info_case()
    {
        $dataPlainDriver = new DataPlainDriver('xxx');

        $infoCase = explode(' ', '2');

        $this->expectException(ErrorFormatInfoCaseException::class);

        $dataPlainDriver->isValidFormatInfoCase($infoCase, 1);
    }

    //----------------------------------------------------

    public function test_format_info_operation_update_success()
    {
        $dataPlainDriver = new DataPlainDriver('xxx');

        $infoOperation = explode(' ', 'UPDATE 2 2 2 1');

        $response = $dataPlainDriver->isValidFormatInfoOperation($infoOperation, 2);

        $this->assertTrue($response);
    }

    public function test_format_info_operation_update_error()
    {
        $dataPlainDriver = new DataPlainDriver('xxx');

        $infoOperation = explode(' ', 'UPDATE 2 2 2');

        $this->expectException(ErrorFormatInfoOperationException::class);

        $dataPlainDriver->isValidFormatInfoOperation($infoOperation, 2);
    }

    public function test_format_info_operation_query_success()
    {
        $dataPlainDriver = new DataPlainDriver('xxx');

        $infoOperation = explode(' ', 'QUERY 2 2 2 2 2 2');

        $response = $dataPlainDriver->isValidFormatInfoOperation($infoOperation, 2);

        $this->assertTrue($response);
    }

    public function test_format_info_operation_query_error()
    {
        $dataPlainDriver = new DataPlainDriver('xxx');

        $infoOperation = explode(' ', 'QUERY 2 2 2');

        $this->expectException(ErrorFormatInfoOperationException::class);

        $dataPlainDriver->isValidFormatInfoOperation($infoOperation, 2);
    }

    public function test_format_info_operation_diferent_type()
    {
        $dataPlainDriver = new DataPlainDriver('xxx');

        $infoOperation = explode(' ', 'RESET 2 2 2');

        $this->expectException(ErrorFormatInfoOperationException::class);

        $dataPlainDriver->isValidFormatInfoOperation($infoOperation, 2);
    }
}
