<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PAController extends Controller
{
    public function index()
    {
        return view('pages.admin.document.pa.index', [
            'title' => 'Pa',
        ]);
    }
}
