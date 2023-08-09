<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataSource\Store;
use App\Http\Requests\DataSource\Update;
use App\Models\DataSource;
use App\Queries\DataSourcesQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataSourceController extends Controller
{
    protected QueryBuilder $dataSourcesQueryBuilder;
    public function __construct(
        DataSourcesQueryBuilder $dataSourcesQueryBuilder
    ) {
        $this->dataSourcesQueryBuilder = $dataSourcesQueryBuilder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.data_sources.index', [
            'resourceList' => $this->dataSourcesQueryBuilder->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.data_sources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request): RedirectResponse
    {
        $resource = DataSource::create($request->validated());
        if ($resource) {
                return redirect()->route('admin.data_sources.index')->with('success', __('Resource has been created'));
        }

        return back()->with('error', __('Resource has not been created'));
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
    public function edit(DataSource $dataSource): View
    {
        return view('admin.data_sources.edit', [
            'data_source' => $dataSource,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, DataSource $dataSource): RedirectResponse
    {
        $dataSource = $dataSource->fill($request->validated());
        if ($dataSource->save()) {
            return redirect()->route('admin.data_sources.index')->with('success', __('Resource has been updated'));
        }

        return back()->with('error', __('Resource has not been update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataSource $dataSource): JsonResponse
    {
        try {
            $dataSource->delete();

            return  response()->json('ok');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());

            return  response()->json('error', 400);
        }
    }
}
