<?php

namespace App\Http\Controllers\CubeSummation;

use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function executeAction()
    {
        $tests = auth()->user()->tests();

        $tests = $tests->orderBy('created_at', 'DESC')->paginate();

        return view('cube_summation.list', [
            'tests' => $tests,
        ]);
    }
}
