<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function index()
    {
        return view('admin.sales.index');
    }
}
