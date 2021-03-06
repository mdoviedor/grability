<?php

namespace App\Http\Controllers\CubeSummation;

use App\Http\Controllers\Controller;
use App\Http\Lib\CubeSummation\CubeSummation;
use App\Http\Lib\CubeSummation\DataPlainDriver;
use Exception;
use Illuminate\Http\Request;

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
            return redirect()->back()
                            ->withInput()
                            ->withErrors(['cases' => $exc->getMessage()]);
        }

        return view('cube_summation.public_generator.generate', [
            'response' => $response,
        ]);
    }
}
