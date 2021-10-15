<?php

namespace App\Services;

use App\Constants\LanguagesConstant;
use App\Services\Actions\ActionService;
use App\Services\Actions\MethodService;

/**
 * Class RegisterService
 * @package App\Services
 */
class RegisterService extends MessageService
{
    public function index()
    {
        $this->setMainAction();
        $method = $this->action->method;
        $this->$method();
    }

    /**
     * Отправляет кнопки языков
     */
    protected function sendLanguage()
    {
        $this->action->method = MethodService::REGISTER_GET_LANGUAGE;
        $this->action->save();

        $this->telegram->send('sendMessage', [
            'chat_id' => $this->chat_id,
            'text' => __("Tilni tanlang"),
            'reply_markup' => json_encode([
                'keyboard' => KeyboardService::registerLanguagesButton(),
                'resize_keyboard' => true,
                'one_time_keyboard' => true,
            ])
        ]);
    }

    /**
     * Получает языки и отправляет запрос имени
     * @return array|mixed
     */
    public function getLanguage()
    {
        if (!LanguagesConstant::check($this->text)) {
            return $this->telegram->send('sendMessage', [
                'chat_id' => $this->chat_id,
                'text' => __('Iltimos to\'g\'ri tilni tanlang')
            ]);
        }

        $this->bot_user->language = LanguagesConstant::getKey()[$this->text];
        $this->bot_user->save();

        $this->action->method = MethodService::REGISTER_GET_FULL_NAME;
        $this->action->save();

        $this->telegram->send('sendMessage', [
            'chat_id' => $this->chat_id,
            'text' => __("Ism familiyangingizni kiriting")
        ]);
    }

    /**
     * Получает имя и отправляет запрос дня рождения
     */
    public function getFullName()
    {
        if (ValidationService::failFullName($this->text)) {
            $this->telegram->send('sendMessage', [
                'chat_id' => $this->chat_id,
                'text' => __("Ismingizni to'g'ri kiriting")
            ]);
            return;
        }

        $this->separateFullName();

        $this->action->method = MethodService::REGISTER_GET_BIRTHDAY;
        $this->action->save();

        $this->telegram->send('sendMessage', [
            'chat_id' => $this->chat_id,
            'text' => __('Tug\'ilgan sanangizni DD.MM.YYYY formatida kiriting'),
        ]);
    }

    /**
     * Получает день рождения и отправляет запрос номера телефона
     */
    public function getBirthday()
    {
        if (ValidationService::failDate($this->text)) {
            $this->telegram->send('sendMessage', [
                'chat_id' => $this->chat_id,
                'text' => __('Tug\'ilgan sanangizni DD.MM.YYYY formatida kiriting')
            ]);
            return;
        }

        list($day, $month, $year) = explode(".", $this->text);
        $date = "{$year}-{$month}-{$day}";

        $this->bot_user->birthday = $date;
        $this->bot_user->save();

        $this->action->method = MethodService::REGISTER_GET_PHONE;
        $this->action->save();

        $this->telegram->send('sendMessage', [
            'chat_id' => $this->chat_id,
            'text' => __('Telefon raqamingizni kiriting'),
            'reply_markup' => json_encode([
                'keyboard' => KeyboardService::sendContact(),
                'resize_keyboard' => true,
            ])
        ]);
    }

    /**
     * Получает номер телефона и отправляет запрос областей
     */
    public function getPhone()
    {
        $contact = $this->message->getContact();
        if (ValidationService::failPhone($contact, $this->message->isContact())) {
            $this->telegram->send('sendMessage', [
                'chat_id' => $this->chat_id,
                'text' => __("Iltimos to'g'ri raqam kiriting")
            ]);
            return;
        }

        $this->bot_user->phone = $contact;
        $this->bot_user->save();

        $this->action->method = MethodService::REGISTER_GET_REGION;
        $this->action->save();

        $this->telegram->send('sendMessage', [
            'chat_id' => $this->chat_id,
            'text' => __("Viloyatingizni tanlang")
        ]);
    }

    /**
     * Получает область и отправляет запрос районов (туман)
     */
    public function getRegion()
    {
        $this->bot_user->region_uuid = $this->text;
        $this->bot_user->save();

        $this->action->method = MethodService::REGISTER_GET_SUB_REGION;
        $this->action->save();

        $this->telegram->send('sendMessage', [
            'chat_id' => $this->chat_id,
            'text' => __('Tumaningizni tanlang')
        ]);
    }

    /**
     * Получает район (туман) и отправляет запрос адреса
     */
    public function getSubRegion()
    {
        $this->bot_user->sub_region_uuid = $this->text;
        $this->bot_user->save();

        $this->action->method = MethodService::REGISTER_GET_ADDRESS;
        $this->action->save();

        $this->telegram->send('sendMessage', [
            'chat_id' => $this->chat_id,
            'text' => __('Manzilingizni kiriting')
        ]);
    }

    /**
     * Получает адрес и заканчивает регистрацию
     */
    public function getAddress()
    {
        $this->bot_user->address = $this->text;
        $this->bot_user->save();

        $this->setNull();
        $this->sendMainMenu();
    }

    /**
     * Начало регистрации
     */
    private function setMainAction(): void
    {
        if ($this->action->action !== ActionService::REGISTER) {
            $this->action->action = ActionService::REGISTER;
            $this->action->method = MethodService::REGISTER_SEND_LANGUAGE;
            $this->action->save();
        }
    }

    /**
     * Разделяет имя и фамилию и сохраняет в базу
     */
    private function separateFullName()
    {
        list($temp_name, $temp_surname) = explode(' ', $this->text);

        if ($this->pregMatch($temp_name)) {
            $surname = $temp_name;
            $name = $temp_surname;
        } elseif ($this->pregMatch($temp_surname)) {
            $surname = $temp_surname;
            $name = $temp_name;
        } else {
            $surname = $temp_name;
            $name = $temp_surname;
        }

        $this->bot_user->first_name = $name;
        $this->bot_user->last_name = $surname;
        $this->bot_user->save();
    }

    /**
     * Проверяет окончания фамилий
     * @param $text
     * @return false|int
     */
    private function pregMatch($text)
    {
        return preg_match("/eva$|ev$|ев$|ева|ov$|ova$|ов$|ова$/", $text);
    }
}
