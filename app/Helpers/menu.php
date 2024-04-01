<?php

if (!function_exists('menuactive')) {

    function menuactive($url): string
    {
        return request()->is($url) ? 'menuitem-active' : '';
    }
}

