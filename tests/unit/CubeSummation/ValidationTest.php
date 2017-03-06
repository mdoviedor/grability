<?php

use App\Http\Lib\CubeSummation\DataManager;
use App\Http\Lib\CubeSummation\exceptions\ErrorMatrixSizeException;
use App\Http\Lib\CubeSummation\exceptions\ErrorNumberCasesException;
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
}
