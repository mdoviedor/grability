<?php

namespace App\Http\Controllers\CubeSummation;

use App\Http\Controllers\Controller;
use App\Http\Lib\CubeSummation\CubeSummation;
use App\Http\Lib\CubeSummation\DataPlainDriver;
use Exception;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class PublicGeneratorController extends Controller
{
    public function generateAction()
    {
        return view('cube_summation.public_generator.generate');
    }

    public function executeAction(Request $request)
    {
        $this->validate(request(), [
            'cases' => ['required'],
        ]);

        $data = trim($request->get('cases'));

        $dataPlainDriver = new DataPlainDriver($data);
        $cubeSummation = new CubeSummation($dataPlainDriver);
        try {
            $response = $cubeSummation->get();
        } catch (Exception $exc) {
            Alert::info('Ejecución fallida')
                    ->details($exc->getMessage());

            \error_log(print_r($exc, true));

            return redirect()->route('cube_summation.public_generator');
        }

        \error_log(print_r($response, true));
    }
}
