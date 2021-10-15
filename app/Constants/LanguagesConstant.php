<?php


namespace App\Constants;


class LanguagesConstant
{
    const UZ = 'uz';

    const RU = 'ru';

    const OZ = 'oz';

    const KAA = 'kaa';

    public static function list(): array
    {
        return [
            self::UZ,
            self::OZ,
            self::RU,
            self::KAA,
        ];
    }

    public static function getKey(): array
    {
        return [
            __(self::UZ) => self::UZ,
            __(self::OZ) => self::OZ,
            __(self::RU) => self::RU,
            __(self::KAA) => self::KAA,
        ];
    }

    /**
     * @param string $lang
     * @return bool
     */
    public static function check(string $lang): bool
    {
        return in_array($lang, self::getKey());
    }

}
