<?php

namespace App\Services;

use App\Constants\LanguagesConstant;

/**
 * Class KeyboardService
 * @package App\Services
 */
class KeyboardService
{
    /**
     * @return string[][][]
     */
    public static function mainMenu(): array
    {
        return [
            [
                [
                    'text' => __('Hodisalar')
                ],
                [
                    'text' => __('Murojaatlar')
                ],

            ],
            [
                [
                    'text' => __('G\'oyalar')
                ],
                [
                    'text' => __('NPA')
                ],
                [
                    'text' => __("Yoshlar daftari")
                ],
            ],
            [
                [
                    'text' => __('Sozlamalar'),
                ],
                [
                    'text' => __('Mening kabinetim'),
                ],
            ],
            [
                [
                    'text' => __("Yuridik klinika")
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public static function registerLanguagesButton(): array
    {
        return [
            [
                ['text' => __(LanguagesConstant::UZ)],
                ['text' => __(LanguagesConstant::RU)],
            ],
            [
                ['text' => __(LanguagesConstant::OZ)],
                ['text' => __(LanguagesConstant::KAA)],
            ]
        ];
    }

    public static function sendContact()
    {
        return [
            [
                [
                    'text' => __("Raqamni ulashish"),
                    'request_contact' => true,
                ]
            ]
        ];
    }
}
