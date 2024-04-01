<?php


if (!function_exists('isNullObject')) {
    function isNullObject($object): bool
    {
        if (empty($object) || is_null($object) || $object == null || $object == '')
            return true;

        return false;
    }
}

if (!function_exists('isFalse')) {
    function isFalse(bool $object): bool
    {
        return $object === false;
    }
}

