<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $menuCount = Menu::count();
        $categoryCount = Category::count();

        return view('admin.dashboard', compact('menuCount', 'categoryCount'));
    }
}
