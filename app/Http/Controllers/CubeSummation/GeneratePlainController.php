<?php

namespace App\Http\Controllers\CubeSummation;

use App\Http\Controllers\Controller;
use App\Http\Lib\CubeSummation\CubeSummation;
use App\Http\Lib\CubeSummation\DataPlainDriver;
use Illuminate\Http\Request;
use SebastianBergmann\RecursionContext\Exception;

class GeneratePlainController extends Controller
{
    public function generateAction()
    {
        return view('cube_summation.generate_plain');
    }

    public function executeAction(Request $request)
    {
        $this->validate($request, [
            'cases' => ['required'],
        ]);

        $data = trim($request->get('cases'));

        $dataPlainDriver = new DataPlainDriver($data);
        $cubeSummation = new CubeSummation($dataPlainDriver);

        try {
            $response = $cubeSummation->get();

            $test = auth()->user()->createTest([
                'size' => $response['T'],
            ]);

            foreach ($response['cases'] as $case) {
                $cube = $test->createCube([
                    'matrix_size' => $case['matrix_size'],
                    'number_operations' => $case['number_operations'],
                ]);

                foreach ($case['operation'] as $operation) {
                    $cube->createOperation($operation);
                }
            }

            return redirect()->route('cube_summation.details', [$test->id]);
        } catch (Exception $exc) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors(['cases' => $exc->getMessage()]);
        }

        return view('cube_summation.generate_plain');
    }
}
