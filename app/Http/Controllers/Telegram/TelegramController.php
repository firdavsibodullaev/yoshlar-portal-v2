<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Modules\Telegram\Telegram;
use App\Services\TelegramService;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    /**
     * @var Telegram
     */
    private $telegram;
    /**
     * @var \App\Modules\Telegram\WebhookUpdates
     */
    private $updates;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
        $this->updates = $this->telegram->getWebhookUpdates();
    }

    public function index()
    {
        (new TelegramService($this->telegram, $this->updates))->index();
    }
}
