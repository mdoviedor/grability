<?php

use App\Http\Lib\CubeSummation\CubeSummation;
use App\Http\Lib\CubeSummation\DataPlainDriver;
use App\Http\Lib\CubeSummation\exceptions\ErrorFormatInfoOperationException;
use App\Http\Lib\CubeSummation\exceptions\ErrorInOperationException;

/**
 * Description of CubeSummationTest.
 *
 * @author marlon
 */
class CubeSummationTest extends PHPUnit_Framework_TestCase
{
    public function test_run_success()
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
QUERY 2 2 2 2 2 2';

        $dataPlainDriver = new DataPlainDriver($data);
        $cubeSummation = new CubeSummation($dataPlainDriver);

        $response = $cubeSummation->get();

        $this->assertEquals(2, count($response['cases']));
        $this->assertEquals(5, $response['cases'][1]['number_operations']);
        $this->assertEquals(4, $response['cases'][2]['number_operations']);
        $this->assertEquals('QUERY', $response['cases'][1]['operation'][3]['type']);
    }

    public function test_run_incomple_operation_update_1_case_1()
    {
        $data = '2
4 5
UPDATE 2 2 2
QUERY 1 1 1 3 3 3
UPDATE 1 1 1 23
QUERY 2 2 2 4 4 4
QUERY 1 1 1 3 3 3
2 4
UPDATE 2 2 2 1
QUERY 1 1 1 1 1 1
QUERY 1 1 1 2 2 2
QUERY 2 2 2 2 2 2';

        $dataPlainDriver = new DataPlainDriver($data);
        $cubeSummation = new CubeSummation($dataPlainDriver);

        $this->expectException(ErrorFormatInfoOperationException::class);
        $cubeSummation->get();
    }

    public function test_run_operation_with_diferent_type_case_1()
    {
        $data = '2
4 5
RESET 2 2 2 4
QUERY 1 1 1 3 3 3
UPDATE 1 1 1 23
QUERY 2 2 2 4 4 4
QUERY 1 1 1 3 3 3
2 4
UPDATE 2 2 2 1
QUERY 1 1 1 1 1 1
QUERY 1 1 1 2 2 2
QUERY 2 2 2 2 2 2';

        $dataPlainDriver = new DataPlainDriver($data);
        $cubeSummation = new CubeSummation($dataPlainDriver);

        $this->expectException(ErrorFormatInfoOperationException::class);
        $cubeSummation->get();
    }

    public function test_run_operation_update_x_greate_than_matrix()
    {
        $data = '2
4 5
UPDATE 100 2 2 4
QUERY 1 1 1 3 3 3
UPDATE 1 1 1 23
QUERY 2 2 2 4 4 4
QUERY 1 1 1 3 3 3
2 4
UPDATE 2 2 2 1
QUERY 1 1 1 1 1 1
QUERY 1 1 1 2 2 2
QUERY 2 2 2 2 2 2';

        $dataPlainDriver = new DataPlainDriver($data);
        $cubeSummation = new CubeSummation($dataPlainDriver);

        $this->expectException(ErrorInOperationException::class);
        $cubeSummation->get();
    }
}
