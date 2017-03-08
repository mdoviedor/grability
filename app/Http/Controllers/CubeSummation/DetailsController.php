<?php

namespace App\Http\Controllers\CubeSummation;

use App\Http\Controllers\Controller;
use App\Test;

class DetailsController extends Controller
{
    public function executeAction(Test $test)
    {
        //dd($test->cubes());
        return view('cube_summation.details', [
            'test' => $test,
        ]);
    }
}
