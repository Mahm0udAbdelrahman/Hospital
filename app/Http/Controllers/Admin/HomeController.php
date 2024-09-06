<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $languages = Language::latest()->get();

        return view('admin.layouts.header', compact('languages'));
        
    }
}
