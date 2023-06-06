<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryNewsController extends Controller
{

    public function categories()
    {
        $data = $this->getCategory();
        $title = "<h1>euronews</h1>";
        foreach ($data as $category) {
            $routeName = route('category.show', $category['id']);
            $title .= <<<HTML
            <h2 style="">
                <a href="{$routeName}">
                    {$category['title']}
                </a>
            </h2>
            <hr>
HTML;
        }
        $html = "<div style='width: 1200px; margin: 0 auto; display: flex; flex-direction: column; align-items: center; justify-content: center;'>
                $title
            </div>";
        return $html;
    }

    public function show($id)
    {
        $news = new NewsController;
        $newsList = $news->news($id);
        $category = $this->getNewsById($id);

        if (!empty($category)) {
            $html = <<<HTML
            <div style='width: 1200px; margin: 0 auto; display: flex; flex-direction: column; align-items: center; justify-content: center;'>
                <h1>{$category['title']}</h1>
                <div style="justify-content: flex-start">{$newsList}</div>
                <hr>
                <a href="/categories">Back</a>
            </div>
HTML;
            return $html;
        }

        return redirect('/categories');
    }

    private function getNewsById($id)
    {
        return $this->getCategory($id);
    }
}
