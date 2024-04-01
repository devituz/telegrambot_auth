<?php


if (!function_exists('localeStr')) {
    function localeStr(): string
    {
        if (app()->getLocale() === 'uz')
            return "O'zbek";
        if (app()->getLocale() === 'ru')
            return 'Русский';
        if (app()->getLocale() === 'en')
            return 'English';

        return app()->getLocale();
    }
}
