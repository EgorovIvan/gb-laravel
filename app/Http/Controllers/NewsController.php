<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = DB::table('news')->get();

        return view('news.index', ['news' => $news]);
    }

    public function show(int $id): View
    {
        $news = DB::table('news')->find($id);

        if (empty($news)) {
            return redirect()->route('news');
        }

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
