<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPController extends Controller
{
    public function index()
    {
        return view('pages.admin.document.bp.index', [
            'title' => 'Bp',
        ]);
    }

    public function bp()
    {
        return view('pages.admin.pengguna.bp', [
            'title' => 'Data Bp',
        ]);
    }
}
