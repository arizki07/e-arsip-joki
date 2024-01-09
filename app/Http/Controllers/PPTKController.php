<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PPTKController extends Controller
{
    public function index()
    {
        return view('pages.admin.pengguna.pptk', [
            'title' => 'Data Pptk',
        ]);
    }
}
