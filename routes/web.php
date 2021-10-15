<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $url = '/api/telegram-bot-connect';
    $url = "https://c081-93-157-58-40.ap.ngrok.io{$url}";
    $telegram = new \App\Modules\Telegram\Telegram();
    dd($telegram->setWebhook($url));
    return view('welcome');
});
