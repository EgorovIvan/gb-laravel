<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return <<<HTML
        <div style="width: 1200px; margin: 0 auto; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <h1>euronews</h1>
            <h3>О нас</h3><br>
            <p>Мы являемся ведущим международным новостным каналом Европы.</p><br>
            <div>
                <a href="/categories" style="padding-right: 20px;">Категории новостей</a>
                <a href="/auth" style="padding-right: 20px;">Авторизация</a>
                <a href="/admin" style="padding-right: 20px;">Панель админа</a>
            </div>
        </div>
HTML;
    }
}
