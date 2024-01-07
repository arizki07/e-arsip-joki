<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PPKController extends Controller
{
    public function index()
    {
        return view('pages.admin.document.ppk.index', [
            'title' => 'Ppk',
        ]);
    }
}
