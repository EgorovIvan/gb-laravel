<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\News;
use App\Queries\NewsQueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class NewsController extends Controller
{
    public function index(NewsQueryBuilder $newsQueryBuilder): View
    {
        return view('news.index', ['news' => $newsQueryBuilder->getActiveNews()]);
    }

    public function show(News $news): View
    {
        return view('news.show', ['newsItem' => $news]);
    }

    public function order(): View
    {
        return view('news.order');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => ['required', 'string'],
            'phone-number' => ['required', 'string'],
            'email' => ['required', 'string'],
        ]);
        return response()->json($request->only(['customer', 'phone-number', 'email', 'info']));
    }
}
