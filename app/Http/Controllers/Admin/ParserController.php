<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsingJob;
use Illuminate\Http\Request;
use App\Services\Contracts\Parser;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Parser $parser): string
    {
        $urls = [
            "https://news.rambler.ru/rss/tech",
            "https://news.rambler.ru/rss/world",
            "https://news.rambler.ru/rss/games",
            "https://news.rambler.ru/rss/community",
            "https://news.rambler.ru/rss/articles",
            "https://news.rambler.ru/rss/Austria/",
            "https://news.rambler.ru/rss/Italy/"
        ];

        foreach ($urls as $url) {
            dispatch(new NewsParsingJob($url));
        }

        return "News saved";
    }
}
