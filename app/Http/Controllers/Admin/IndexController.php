<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return <<<HTML
        <h1>Вход для админа</h1>
        text<br>
        <a href="/"> Главная страница</a>
        <a href="/admin/add-news"> Добавить новость</a>
HTML;
    }

}
