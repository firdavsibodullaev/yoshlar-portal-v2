<?php


namespace App\Modules\Telegram\Updates;

/**
 * Class Message
 * @package App\Modules\Telegram\Updates
 */
class Message
{
    /**
     * @var string[]
     */
    private $file_types = [
        'audio',
        'document',
        'photo',
        'video',
        'sticker',
        'voice',
        'animation',
    ];

    /**
     * @var array
     */
    private $message;

    /**
     * Message constructor.
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getChatId(): int
    {
        return $this->message['chat']['id'];
    }

    public function getFromId(): int
    {
        return $this->message['from']['id'];
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->message['text'] ?? ($this->message['caption'] ?? "");
    }

    /**
     * @return bool
     */
    public function isContact(): bool
    {
        return isset($this->message['contact']);
    }

    /**
     * @return string
     */
    public function getContact(): string
    {
        return $this->isContact()
            ? preg_replace('/\+/', '', $this->message['contact']['phone_number'])
            : preg_replace('/\+|\s|\(|\)|-/', '', $this->getText());
    }

    /**
     * @return bool
     */
    public function isFile(): bool
    {
        foreach ($this->file_types as $file_type) {
            if ($set = isset($this->message[$file_type])) {
                return $set;
            }
        }
        return false;
    }
}
