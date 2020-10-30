<?php

namespace App\Http\Controllers;
use App\Bulletin;
use App\Headline;
use Illuminate\Http\Request;

class HeadlinesController extends Controller
{
    //
    public function index()
    {
        $bulletins = Bulletin::with('created_by')->orderBy('id','desc')->get()->take(20);
        $headlines = Headline::with('created_by')->orderBy('id','desc')->get()->take(20);
        return view('employee_dashboard',array(
            'header' => 'Dashboard Employee',
            'subheader' => '',
            'bulletins' => $bulletins,
            'headlines' => $headlines,

        ));
    }
}
