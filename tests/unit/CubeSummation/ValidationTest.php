<?php

use App\Http\Lib\CubeSummation\DataManager;
use App\Http\Lib\CubeSummation\exceptions\ErrorInOperationException;
use App\Http\Lib\CubeSummation\exceptions\ErrorMatrixSizeException;
use App\Http\Lib\CubeSummation\exceptions\ErrorNumberCasesException;
use App\Http\Lib\CubeSummation\exceptions\ErrorNumberOperationsException;
use App\Http\Lib\CubeSummation\Validation;

/**
 * Description of Validation.
 *
 * @author marlon
 */
class ValidationTest extends PHPUnit_Framework_TestCase
{
    public function test_number_cases_succes()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);
        $response = $validation->isValidNumberCases(2);

        $this->assertTrue($response);
    }

    public function test_number_cases_equal_51()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);
        $this->expectException(ErrorNumberCasesException::class);
        $validation->isValidNumberCases(51);
    }

    public function test_number_cases_equal_0()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);
        $this->expectException(ErrorNumberCasesException::class);
        $validation->isValidNumberCases(0);
    }

    //------------------------------------------------------------------------

    public function test_matrix_size_succes()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);
        $response = $validation->isValidMatrixSize(2, 2);

        $this->assertTrue($response);
    }

    public function test_matrix_size_equal_101()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);
        $this->expectException(ErrorMatrixSizeException::class);
        $validation->isValidMatrixSize(101, 2);
    }

    public function test_matrix_size_equal_0()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);
        $this->expectException(ErrorMatrixSizeException::class);
        $validation->isValidMatrixSize(0, 2);
    }

    //----------------------------------------------------------------------------
    public function test_number_operations_succes()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);
        $response = $validation->isValidNumberOperations(2, 2);

        $this->assertTrue($response);
    }

    public function test_number_operations_equal_1001()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);
        $this->expectException(ErrorNumberOperationsException::class);
        $validation->isValidNumberOperations(1001, 2);
    }

    public function test_number_operations_equal_0()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);
        $this->expectException(ErrorNumberOperationsException::class);
        $validation->isValidNumberOperations(0, 2);
    }

    //--------------------------------------

    public function test_operation_update_success()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);

        $operation = [
            'W' => 100,
            'x' => 2,
            'y' => 2,
            'z' => 2,
        ];

        $response = $validation->isValidOperationUpdate($operation, 4, 1);

        $this->assertTrue($response);
    }

    public function test_operation_update_x_equal_null()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);

        $operation = [
            'W' => 100,
            'y' => 2,
            'z' => 2,
        ];
        $this->expectException(ErrorInOperationException::class);

        $validation->isValidOperationUpdate($operation, 4, 1);
    }

    public function test_operation_update_x_greate_than_matrix()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);

        $operation = [
            'W' => 100,
            'x' => 100,
            'y' => 2,
            'z' => 2,
        ];
        $this->expectException(ErrorInOperationException::class);

        $validation->isValidOperationUpdate($operation, 4, 1);
    }

    //--------------------------------------------------------------------

    public function test_operation_query_success()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);

        $operation = [
            'x1' => 1,
            'y1' => 1,
            'z1' => 1,
            'x2' => 1,
            'y2' => 1,
            'z2' => 1,
        ];

        $response = $validation->isValidOperationQuery($operation, 4, 1);

        $this->assertTrue($response);
    }

    public function test_operation_query_x1_equal_null()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);

        $operation = [
            'y1' => 1,
            'z1' => 1,
            'x2' => 1,
            'y2' => 1,
            'z2' => 1,
        ];
        $this->expectException(ErrorInOperationException::class);

        $validation->isValidOperationQuery($operation, 4, 1);
    }

    public function test_operation_update_x1_greate_than_matrix()
    {
        $data_manager_stub = $this->createMock(DataManager::class);
        $data_manager_stub->method('get')
                ->willReturn('xxx');

        $validation = new Validation($data_manager_stub);

        $operation = [
            'x1' => 100,
            'y1' => 1,
            'z1' => 1,
            'x2' => 1,
            'y2' => 1,
            'z2' => 1,
        ];
        $this->expectException(ErrorInOperationException::class);

        $validation->isValidOperationQuery($operation, 4, 1);
    }
}
