<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Contracts\Parser;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Parser $parser): string
    {
        $url = "https://news.rambler.ru/rss/tech/";

        $parser->setLink($url)->saveParseData();

        return "Data saved";
    }
}
