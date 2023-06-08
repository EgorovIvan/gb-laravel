<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function news($categoryId)
    {
        $data = $this->getNews();
        $html = "<h1>News</h1>";
        foreach ($data as $news) {
            $routeName = route('news.show', [$categoryId, $news['id']] );
            $html .= <<<HTML
            <h2>
                <a href="{$routeName}">
                    {$news['title']}
                </a>
            </h2>
            <hr>
HTML;
        }
        return $html;
    }

    public function show($id, $categoryId)
    {
        $news = $this->getNewsById($id);
        if (!empty($news)) {
            $html = <<<HTML
            <h1>{$news['title']}</h1>
            <div>{$news['text']}</div>
            <hr>
            <a href="/categories/{$categoryId}">Back</a>
HTML;
            return $html;
        }

        return redirect(`/categories/{$categoryId}`);
    }

    private function getNewsById($id)
    {
        return $this->getNews($id);
    }
}
