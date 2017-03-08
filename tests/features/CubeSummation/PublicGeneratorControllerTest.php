<?php

/**
 * Description of PublicGeneratorControllerTest.
 *
 * @author marlon
 */
class PublicGeneratorControllerTest extends TestCase
{
    public function test_success_execute_case()
    {
        $data = '2
4 5
UPDATE 2 2 2 4
QUERY 1 1 1 3 3 3
UPDATE 1 1 1 23
QUERY 2 2 2 4 4 4
QUERY 1 1 1 3 3 3
5 4
UPDATE 2 2 2 1
QUERY 1 1 1 1 1 1
QUERY 1 1 1 2 2 2
QUERY 2 2 2 2 2 2
            ';
        $this->visit('cube_summation/public_generator')
                ->type($data, 'cases')
                ->press('generar')
                ->seePageIs('cube_summation/public_generator')
                ->see('Resultados')
                ->see('4')
                ->see('27')
                ->see('23');
    }

    public function test_error_format_data()
    {
        $data = '2
4 100
UPDATE 2 2 2 4
QUERY 1 1 1 3 3 3
UPDATE 1 1 1 23
QUERY 2 2 2 4 4 4
QUERY 1 1 1 3 3 3
5 4
UPDATE 2 2 2 1
QUERY 1 1 1 1 1 1
QUERY 1 1 1 2 2 2
QUERY 2 2 2 2 2 2
            ';
        $this->visit('cube_summation/public_generator')
                ->type($data, 'cases')
                ->press('generar')
                ->seePageIs('cube_summation/public_generator')
                ->dontSee('Resultados');
    }
}
