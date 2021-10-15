<?php

namespace App\Services;

use App\Constants\ButtonsConstant;
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
                    'text' => __(ButtonsConstant::EVENTS)
                ],
                [
                    'text' => __(ButtonsConstant::APPEALS)
                ],

            ],
            [
                [
                    'text' => __(ButtonsConstant::IDEAS)
                ],
                [
                    'text' => __(ButtonsConstant::NPA)
                ],
                [
                    'text' => __(ButtonsConstant::YOUTH_BOOK)
                ],
            ],
            [
                [
                    'text' => __(ButtonsConstant::SETTINGS),
                ],
                [
                    'text' => __(ButtonsConstant::MY_CABINET),
                ],
            ],
            [
                [
                    'text' => __(ButtonsConstant::LEGAL_CLINIC)
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

    /**
     * @return \array[][]
     */
    public static function sendContact(): array
    {
        return [
            [
                [
                    'text' => __(ButtonsConstant::SEND_CONTACT),
                    'request_contact' => true,
                ]
            ]
        ];
    }

    /**
     * @return \array[][]
     */
    public static function settingsButton(): array
    {
        return [
            [
                [
                    'text' => __(ButtonsConstant::CHANGE_LANGUAGE[0]),
                    'callback_data' => ButtonsConstant::CHANGE_LANGUAGE[1]
                ],
                [
                    'text' => __(ButtonsConstant::DELETE_ACCOUNT[0]),
                    'callback_data' => ButtonsConstant::DELETE_ACCOUNT[1]
                ]
            ],
            [
                [
                    'text' => __(ButtonsConstant::SETTINGS_EXIT[0]),
                    'callback_data' => ButtonsConstant::SETTINGS_EXIT[1]
                ]
            ],
        ];
    }
}
