<?php

namespace App\Services;

use App\Constants\LanguagesConstant;

/**
 * Class ValidationService
 * @package App\Services
 */
class ValidationService
{
    /**
     * @param string $name
     * @return bool
     */
    public static function failFullName(string $name): bool
    {
        return !(
            preg_match("/^[A-ZА-ЯЁ][a-zа-яё']{2,} [A-ZА-ЯЁ][a-zа-яё']{2,}$/u", $name)
            && strlen($name) <= 255
            && !LanguagesConstant::check($name)
        );
    }

    /**
     * @param string $phone
     * @param bool $is_contact
     * @return bool
     */
    public static function failPhone(string $phone, bool $is_contact = true): bool
    {
        return !(preg_match("/^998\d{9}$/", $phone) && $is_contact);
    }

    /**
     * @param string $date
     * @return bool
     */
    public static function failDate(string $date): bool
    {
        if (preg_match('/^\d{2}.\d{2}.\d{4}$/', $date)) {
            list($day, $month, $year) = explode(".", $date);
            $month_31 = [1, 3, 5, 7, 8, 10, 12];
            return (
                $month > 12
                || $year > date("Y", time())
                || $year < 1900
                || $day > 31
                || (($month == 2 && $year % 4 != 0 && $day > 28) || $month == 2 && $day >= 30)
                || (!in_array($month, $month_31) && $day >= 31));
        }
        return true;
    }
}
