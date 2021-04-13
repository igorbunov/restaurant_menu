<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('menus')->get();

        return view('menu', compact('categories'));
    }
}
