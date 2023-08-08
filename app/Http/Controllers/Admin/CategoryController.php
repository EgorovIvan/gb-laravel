<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Store;
use App\Http\Requests\Category\Update;
use App\Models\Category;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected QueryBuilder $categoriesQueryBuilder;
    public function __construct(
        CategoriesQueryBuilder $categoriesQueryBuilder
    ) {
        $this->categoriesQueryBuilder = $categoriesQueryBuilder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.categories.index', [
            'categoryList' => $this->categoriesQueryBuilder->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        if ($category) {
            return redirect()->route('admin.categories.index')->with('success', __('Category has been created'));
        }

        return back()->with('error', __('Category has not been created'));
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
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Category $category): RedirectResponse
    {
        $category = $category->fill($request->validated());
        if ($category->save()) {
            return redirect()->route('admin.categories.index')->with('success', __('Category has been updated'));
        }

        return back()->with('error', __('Category has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        try {
            $category->delete();

            return  response()->json('ok');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());

            return  response()->json('error', 400);
        }
    }
}
