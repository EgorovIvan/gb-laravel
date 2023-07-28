<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\Parser;
use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade;

class ExchangeParserService implements Parser
{
    private string $link;

    public function setLink(string $link): Parser
    {
        $this->link = $link;

        return $this;
    }

    public function saveParseData(): void
    {
        $xml = Facade::load($this->link);

        $data = $xml->parse([
            'Valute' => [
                'uses' => 'Valute[NumCode,CharCode,Nominal,Name,Value]'
            ]
        ]);

        $explode = explode("/", $this->link);
        $fileName = end($explode);

        Storage::append('exchange/' . $fileName . ".txt", json_encode($data));
    }
}
