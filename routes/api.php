<?php

use App\Http\Controllers\Telegram\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('', function() {
//    $a = '{"update_id":391393942,"message":{"message_id":10974,"from":{"id":287956415,"is_bot":false,"first_name":"\ud835\udd71\ud835\udd8e\ud835\udd97\ud835\udd89\ud835\udd86\ud835\udd9b\ud835\udd98\u2079\u2079","username":"UserFS","language_code":"en"},"chat":{"id":287956415,"first_name":"\ud835\udd71\ud835\udd8e\ud835\udd97\ud835\udd89\ud835\udd86\ud835\udd9b\ud835\udd98\u2079\u2079","username":"UserFS","type":"private"},"date":1634289205,"forward_from":{"id":287956415,"is_bot":false,"first_name":"\ud835\udd71\ud835\udd8e\ud835\udd97\ud835\udd89\ud835\udd86\ud835\udd9b\ud835\udd98\u2079\u2079","username":"UserFS","language_code":"en"},"forward_date":1634289150,"photo":[{"file_id":"AgACAgIAAxkBAAIq3mFpRjX5tseojFnQNZrt5SRRM3h_AALMtjEbKxZJSzatvLTatDO-AQADAgADcwADIQQ","file_unique_id":"AQADzLYxGysWSUt4","file_size":1555,"width":90,"height":60},{"file_id":"AgACAgIAAxkBAAIq3mFpRjX5tseojFnQNZrt5SRRM3h_AALMtjEbKxZJSzatvLTatDO-AQADAgADbQADIQQ","file_unique_id":"AQADzLYxGysWSUty","file_size":15390,"width":320,"height":213},{"file_id":"AgACAgIAAxkBAAIq3mFpRjX5tseojFnQNZrt5SRRM3h_AALMtjEbKxZJSzatvLTatDO-AQADAgADeAADIQQ","file_unique_id":"AQADzLYxGysWSUt9","file_size":55673,"width":800,"height":533},{"file_id":"AgACAgIAAxkBAAIq3mFpRjX5tseojFnQNZrt5SRRM3h_AALMtjEbKxZJSzatvLTatDO-AQADAgADeQADIQQ","file_unique_id":"AQADzLYxGysWSUt-","file_size":88729,"width":1280,"height":853}]}}';
    $a = '{"update_id":391393967,"message":{"message_id":11026,"from":{"id":287956415,"is_bot":false,"first_name":"\ud835\udd71\ud835\udd8e\ud835\udd97\ud835\udd89\ud835\udd86\ud835\udd9b\ud835\udd98\u2079\u2079","username":"UserFS","language_code":"en"},"chat":{"id":287956415,"first_name":"\ud835\udd71\ud835\udd8e\ud835\udd97\ud835\udd89\ud835\udd86\ud835\udd9b\ud835\udd98\u2079\u2079","username":"UserFS","type":"private"},"date":1634317191,"reply_to_message":{"message_id":11025,"from":{"id":1165140130,"is_bot":true,"first_name":"FS Test Bot","username":"fs_ibodullaevBot"},"chat":{"id":287956415,"first_name":"\ud835\udd71\ud835\udd8e\ud835\udd97\ud835\udd89\ud835\udd86\ud835\udd9b\ud835\udd98\u2079\u2079","username":"UserFS","type":"private"},"date":1634301218,"text":"Telefon raqamingizni kiriting"},"contact":{"phone_number":"+998931588585","first_name":"\ud835\udd71\ud835\udd8e\ud835\udd97\ud835\udd89\ud835\udd86\ud835\udd9b\ud835\udd98\u2079\u2079","user_id":287956415}}}';
    $a = json_decode($a, true);
    dd($a);
});
Route::post('telegram-bot-connect', [TelegramController::class, 'index']);
