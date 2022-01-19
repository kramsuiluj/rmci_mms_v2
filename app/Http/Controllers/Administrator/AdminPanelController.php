<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;

class AdminPanelController extends Controller
{
    public function index()
    {
        return view('administrator.index');
    }
}
