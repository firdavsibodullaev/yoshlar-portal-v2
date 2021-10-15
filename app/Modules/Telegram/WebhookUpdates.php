<?php


namespace App\Modules\Telegram;


use App\Modules\Telegram\Updates\Message;

class WebhookUpdates
{

    /**
     * @var mixed
     */
    private $updates;

    private $update_methods = [
        'message',
        'edited_message',
        'channel_post',
        'edited_channel_post',
        'inline_query',
        'callback_query',
        'shipping_query',
        'my_chat_member',
        'chat_member',
    ];

    /**
     * WebhookUpdates constructor.
     * @param string $updates
     */
    public function __construct(string $updates)
    {
        $this->updates = json_decode($updates, true);
    }

    public function json()
    {
        return $this->updates;
    }

    public function body()
    {
        return json_encode($this->updates);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        foreach ($this->update_methods as $method) {
            if (isset($this->json()[$method])) {
                return $method;
            }
        }
        return false;
    }

    /**
     * @return Message|false
     */
    public function message()
    {
        if (!in_array('message', $this->update_methods)) {
            return false;
        }
        return new Message($this->updates['message']);
    }

    public function editedMessage()
    {
        if (!in_array('edited_message', $this->update_methods)) {
            return false;
        }
        return new Message($this->updates['edited_message']);
    }
}
