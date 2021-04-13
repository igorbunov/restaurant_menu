<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreMenuRequest;

class MenuController extends Controller
{
    public const TAB_NAME = '#nav-menu-tab';

    public function index(Request $request)
    {
        $categories = Category::orderBy('position', 'asc')->get();

        $menus = null;
        $selectedCategory = null;
        $category_id = (int) $request->get('category_id', 0);

        if ($category_id > 0) {
            $selectedCategory = Category::findOrFail($category_id);

            $menus = Menu::where('category_id', $category_id)->orderBy('position', 'asc')->paginate(10);
        } else {
            $menus = Menu::orderBy('position', 'asc')->paginate(10);
        }

        return view('admin.menu.index', compact('categories', 'menus', 'selectedCategory'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.menu.create', compact('categories'));
    }

    public function store(StoreMenuRequest $request)
    {
        $position = (int) Menu::max('position');
        $position++;
        $filename = null;

        $menu = Menu::create($request->validated() + [
            'position' => $position
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = rand() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images/', $filename, 'public');

            $menu->update([
                'photo' => $filename
            ]);
        }

        return redirect()
            ->route('admin.menu.index')
            ->withStatus('Меню добавлено');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::all();

        return view('admin.menu.edit', compact('menu', 'categories'));
    }

    public function update(StoreMenuRequest $request, Menu $menu)
    {
        $menu->update($request->validated());

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = rand() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images/', $filename, 'public');

            $menu->update([
                'photo' => $filename
            ]);
        }

        return redirect()
            ->route('admin.menu.index')
            ->withStatus('Меню изменено');
    }

    public function destroy(Menu $menu)
    {
        DB::transaction(function () use ($menu) {
            $menu->delete();

            (new PositionController())->recalculate(Menu::class);
        });

        return redirect()
            ->route('admin.menu.index')
            ->withStatus('Меню удалено');
    }
}
