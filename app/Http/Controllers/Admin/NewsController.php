<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\DataSourcesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected QueryBuilder $categoriesQueryBuilder;
    protected QueryBuilder $newsQueryBuilder;
    protected QueryBuilder $dataSourcesQueryBuilder;

    public function __construct(
        CategoriesQueryBuilder $categoriesQueryBuilder,
        NewsQueryBuilder $newsQueryBuilder,
        DataSourcesQueryBuilder $dataSourcesQueryBuilder
    ) {
        $this->categoriesQueryBuilder = $categoriesQueryBuilder;
        $this->newsQueryBuilder = $newsQueryBuilder;
        $this->dataSourcesQueryBuilder = $dataSourcesQueryBuilder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.news.index', [
            'newsList' => $this->newsQueryBuilder->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return \view('admin.news.create', [
            'categories' => $this->categoriesQueryBuilder->getAll(),
            'data_sources' => $this->dataSourcesQueryBuilder->getAll(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
        ]);

        $categories = $request->input('categories');
        $data_sources = $request->input('data_sources');

        $news = $request->only([ 'title', 'author', 'status', 'description']);
        $news = News::create($news);
        if ($news !== false) {
            if ($categories !== null && $data_sources !== null ) {
                $news->categories()->attach($categories);
                $news->data_sources()->attach($data_sources);

                return \redirect()->route('admin.news.index')->with('success', 'News has been create');
            }
        }

        return \back()->with('error', 'News has not been create');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return 0;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news): View
    {
        return \view('admin.news.edit', [
            'news' => $news,
            'categories' => $this->categoriesQueryBuilder->getAll(),
            'data_sources' => $this->dataSourcesQueryBuilder->getAll(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news): RedirectResponse
    {
        $categories = $request->input('categories');
        $data_sources = $request->input('data_sources');

        $news = $news->fill($request->only(['title', 'author', 'status', 'description']));
        if ($news->save()) {
            $news->categories()->sync($categories);
            $news->data_sources()->sync($data_sources);

            return \redirect()->route('admin.news.index')->with('success', 'News has been update');
        }

        return \back()->with('error', 'News has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {

    }
}
