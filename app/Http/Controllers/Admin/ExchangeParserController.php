<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Parser;
use App\Services\ExchangeParserService;
use Illuminate\Http\Request;

class ExchangeParserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ExchangeParserService $parser): string
    {
        $url = "https://www.cbr-xml-daily.ru/daily_eng.xml";

        $parser->setLink($url)->saveParseData();

        return "Data saved";
    }
}
