<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authorization()
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
                width: 200px;
                height: 200px;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);">
                <form action="" style="padding: 10px; background-color: white; display: flex; flex-direction: column;">
                    <input type="text" placeholder="Login" style="width: 170px; height: 30px; margin: 5px auto;">
                    <input type="text" placeholder="Password" style="width: 170px; height: 30px; margin: 5px auto;">
                    <div style="margin: 5px auto;">
                    <label for="Remember">Запомнить меня</label><input type="checkbox" name="Remember" >
                    </div>
                    <button type="submit" style="width: 100px; height: 30px; margin: 5px auto;">Авторизация</button>
                </form>
            </div>
        </div>
HTML;
    }

}
