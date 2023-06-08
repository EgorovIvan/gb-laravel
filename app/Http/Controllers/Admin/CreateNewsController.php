<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class CreateNewsController extends Controller
{
    public function index()
    {
        return <<<HTML
        <div style="position: fixed;
            overflow: auto;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);">
            <div style="position: absolute;
                width: 300px;
                height: 300px;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);">
                <div style="padding: 10px; background-color: white; display: flex; flex-direction: column;">
                    <input type="text" placeholder="News Name" style="width: 240px; height: 30px; margin: 5px auto;">
                    <textarea placeholder="Подробное описание" style="width: 240px; height: 100px; margin: 5px auto;"></textarea>
                    <input type="text" placeholder="Краткое описание" style="width: 240px; height: 30px; margin: 5px auto;"/>
                    <button style="width: 140px; height: 30px; margin: 5px auto;">Добавить новость</button>
                </div>
            </div>
        </div>
HTML;
    }
}
