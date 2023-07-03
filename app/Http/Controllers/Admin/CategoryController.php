<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected QueryBuilder $categoriesQueryBuilder;
    public function __construct(
        CategoriesQueryBuilder $categoriesQueryBuilder,
    ) {
        $this->categoriesQueryBuilder = $categoriesQueryBuilder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index', [
            'categoryList' => $this->categoriesQueryBuilder->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
        ]);

        $category = $request->only([ 'title', 'description']);
        $category = Category::create($category);
        if ($category !== false) {
            return \redirect()->route('admin.categories.index')->with('success', 'Category has been create');
        }

        return \back()->with('error', 'Category has not been create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return \view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $category = $category->fill($request->only(['title', 'description']));
        if ($category->save()) {
            return \redirect()->route('admin.categories.index')->with('success', 'Category has been update');
        }

        return \back()->with('error', 'Category has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
