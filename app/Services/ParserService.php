<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\NewsStatus;
use App\Services\Contracts\Parser;
use Illuminate\Support\Facades\DB;
use Orchestra\Parser\Xml\Facade;


class ParserService implements Parser
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
//
        $data = $xml->parse([
            'title' => [
                'uses' => 'channel.title',
            ],
            'link' => [
                'uses' => 'channel.link',
            ],
            'description' => [
                'uses' => 'channel.description',
            ],
            'image' => [
                'uses' => 'channel.image.url',
            ],
            'news' => [
                'uses' => 'channel.item[title,link,author,description,pubDate]'
            ],
            'newsTitle' => [
                'uses' => 'channel.item.title'
            ],
            'newsAuthor' => [
                'uses' => 'channel.item.author'
            ],
            'newsDescription' => [
                'uses' => 'channel.item.description'
            ],
            'newsCreated_at' => [
                'uses' => 'channel.item.pubDate'
            ],
        ]);

        $response = [
            'title' => $data['newsTitle'],
            'author' => $data['newsAuthor'],
            'image' => $data['image'],
            'status' => NewsStatus::ACTIVE->value,
            'description' => $data['newsDescription'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('news')->insert($response);
    }
}
