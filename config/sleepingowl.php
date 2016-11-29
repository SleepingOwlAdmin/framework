<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Backend URL prefix
    |--------------------------------------------------------------------------
    | Название сегмента url, по кторому будет осуществляться доступ в админ
    | панель
    |
    */

    'url_prefix' => 'backend',

    /*
    |--------------------------------------------------------------------------
    | Authentication Guard
    |--------------------------------------------------------------------------
    | Название сегмента url, по кторому будет осуществляться доступ в админ
    | панель
    |
    */

    'guard_provider' => [
        'driver' => 'eloquent',
        'model' => SleepingOwl\Framework\Entities\User::class,
    ],

    /*
    |--------------------------------------------------------------------------
    |  Framework themes
    |--------------------------------------------------------------------------
    | Список доступных тем
    |
    */
    'theme' => [
        'default' => env('SLEEPINGOWL_THEME', 'admin-lte'), // Тема используемая по умолачанию

        'themes' => [
            'admin-lte' => [
                'class' => \SleepingOwl\Framework\Themes\AdminLteTheme::class,
                // 'logo' => '...', // Переопределение логотипа
                // 'logo_small' => '...' // Переопределение компактной версии логотипа
            ]
        ]
    ],
];