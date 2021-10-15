<?php

namespace App\Services;

use App\Modules\Telegram\Telegram;
use App\Modules\Telegram\Updates\Message;
use App\Modules\Telegram\WebhookUpdates;

/**
 * Class MessageService
 * @package App\Services
 */
class MessageService extends TelegramService
{
    protected $message;

    public function __construct(Telegram $telegram, WebhookUpdates $updates, Message $message)
    {
        parent::__construct($telegram, $updates);
        $this->message = $message;
    }

    public function index()
    {
        if ($this->text === '/start') {
            $this->start();
        }

        $this->checkStatus();

    }

    public function start()
    {
        $this->setNull();

        $this->checkStatus();

        $this->telegram->send('sendMessage', [
            'chat_id' => $this->chat_id,
            'text' => __("Assalomu alaykum hurmatli foydalanuvchi")
        ]);
        $this->sendMainMenu();
    }

    /**
     *  Set action null
     */
    public function setNull()
    {
        $this->action->action = null;
        $this->action->method = null;
        $this->action->save();
    }

    public function sendMainMenu()
    {
        $this->telegram->send('sendMessage', [
            'chat_id' => $this->chat_id,
            'text' => __('Menyuni tanlang'),
            'reply_markup' => json_encode([
                'keyboard' => KeyboardService::mainMenu(),
                'resize_keyboard' => true,
            ])
        ]);
    }

    private function checkStatus()
    {
        if (!$this->bot_user->status) {
            (new RegisterService($this->telegram, $this->updates, $this->message))->index();
            die();
        }
    }
}
