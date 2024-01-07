<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPPController extends Controller
{
    public function index()
    {
        return view('pages.admin.document.bpp.index', [
            'title' => 'Bpp',
        ]);
    }
}
