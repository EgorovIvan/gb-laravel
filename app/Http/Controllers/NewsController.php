<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = $this->getNews();

        return view('news.index', ['news' => $news]);
    }

    public function show(int $id): View
    {
        return view('news.show', ['newsItem' => $this->getNews($id)]);
    }
}
