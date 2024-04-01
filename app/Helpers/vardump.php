<?php


use JetBrains\PhpStorm\NoReturn;

if (!function_exists('ddie')) {
    #[NoReturn] function ddie($vars): void
    {
        foreach ($vars as $var) {
            d($var);
        }
        die();
    }
}

if (!function_exists('d')) {
    function d($var, $caller = null): void
    {
        if (!isset($caller)) {
            $array = debug_backtrace(1);
            $caller = array_shift($array);
        }
        echo '<div style="background-color: black; color: white; padding: 10px; margin: 10px; border-radius: 5px;">';
        echo '<code>File: ' . $caller['file'] . ' / Line: ' . $caller['line'] . '</code>';
        echo '<pre>';
        var_dump($var);
        //var_dump($var, 10, true);
        echo '</pre>';
        echo '</div>';
    }
}
