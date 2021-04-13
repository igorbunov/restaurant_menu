<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public const TAB_NAME = '#nav-categories';

    public function index()
    {
        $categories = Category::orderBy('position', 'asc')->get();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $position = (int) Category::max('position');
        $position++;

        Category::create(
            $request->validated() + [
                'position' => $position
            ]
        );

        return redirect()
            ->route('admin.category.index')
            ->withStatus('Категория добавлена');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);

        return redirect()
            ->route('admin.category.index')
            ->withStatus('Категория изменена');
    }

    public function destroy(Category $category)
    {
        if (!$category->menus->isEmpty()) {
            return redirect()
                ->route('admin.category.index')
                ->withStatus('Нельзя удалить категорию у которой есть меню');
        }

        $category->delete();

        return redirect()
            ->route('admin.category.index')
            ->withStatus('Категория удалена');
    }
}
