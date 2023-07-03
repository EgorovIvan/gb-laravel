<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataSource;
use App\Queries\DataSourcesQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DataSourceController extends Controller
{
    protected QueryBuilder $dataSourcesQueryBuilder;
    public function __construct(
        DataSourcesQueryBuilder $dataSourcesQueryBuilder,
    ) {
        $this->dataSourcesQueryBuilder = $dataSourcesQueryBuilder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.data-sources.index', [
            'resourceList' => $this->dataSourcesQueryBuilder->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data-sources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
        ]);

        $resource = $request->only([ 'name', 'description']);
        $resource = DataSource::create($resource);
        if ($resource !== false) {
                return \redirect()->route('admin.data-sources.index')->with('success', 'Resource has been create');
        }

        return \back()->with('error', 'Resource has not been create');
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
    public function edit(DataSource $data_source): View
    {
        return \view('admin.data-sources.edit', [
            'data_source' => $data_source,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataSource $data_source): RedirectResponse
    {
        $data_source = $data_source->fill($request->only(['name', 'description']));
        if ($data_source->save()) {
            return \redirect()->route('admin.data-sources.index')->with('success', 'Resource has been update');
        }

        return \back()->with('error', 'Resource has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
