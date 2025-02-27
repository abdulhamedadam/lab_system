<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllTestsController extends Controller
{


    /*************************************************/
    public function index()
    {
        return view('dashbord.tests.all_tests');
    }
}
