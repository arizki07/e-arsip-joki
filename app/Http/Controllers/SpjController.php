<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpjController extends Controller
{
    public function index()
    {
        return view('pages.admin.spj.index', [
            'title' => 'Spj',
        ]);
    }
}
