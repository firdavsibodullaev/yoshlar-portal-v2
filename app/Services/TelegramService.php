<?php

namespace App\Services;

use App\Models\Action;
use App\Models\BotUser;
use App\Modules\Telegram\Telegram;
use App\Modules\Telegram\WebhookUpdates;

/**
 * Class TelegramService
 * @package App\Services
 */
class TelegramService
{
    /**
     * @var Telegram
     */
    protected $telegram;
    /**
     * @var WebhookUpdates
     */
    protected $updates;

    /**
     * @var int
     */
    protected $chat_id;

    /**
     * @var string
     */
    protected $text;
    /**
     * @var BotUser
     */
    protected $bot_user;
    /**
     * @var Action
     */
    protected $action;

    public function __construct(Telegram $telegram, WebhookUpdates $updates)
    {
        $this->telegram = $telegram;
        $this->updates = $updates;
        $this->chat_id = $this->method()->getChatId();
        $this->text = $this->method()->getText();

        $this->action = $this->action();
        $this->bot_user = $this->botUser();
    }

    public function index()
    {
        switch ($this->updates->getMethod()) {
            case 'message':
                (new MessageService($this->telegram, $this->updates, $this->updates->message()))->index();
                break;
        }
    }

    private function method()
    {
        $method = $this->updates->getMethod();
        return $this->updates->$method();
    }


    /**
     * @return Action
     */
    public function action(): Action
    {
        return Action::firstOrCreate(['chat_id' => $this->chat_id], [
            'action' => null,
            'method' => null
        ]);
    }

    /**
     * @return BotUser
     */
    public function botUser(): BotUser
    {
        return BotUser::firstOrCreate(['chat_id' => $this->chat_id]);
    }
}
