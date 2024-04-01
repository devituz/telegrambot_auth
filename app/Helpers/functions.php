<?php

require 'vardump.php';

require 'loging.php';

require 'i18n.php';

require 'check.php';

require 'menu.php';

if (!function_exists('randNum')) {

    function randNum(): int
    {
        return rand(1, 1000000);
    }
}


if (!function_exists('countDigit')) {

    /**
     * @param $number
     * @return integer
     */
    function countDigit($number): int
    {
        return strlen((string)$number);
    }
}

if (!function_exists('clearPhone')) {
    /**
     * @param $phone
     * @return bool|string
     */
    function clearPhone($phone): bool|string             // 91 123 45 67 => 911234567
    {
        $number = preg_replace('/\D/', '', $phone);
        if (strlen($number) < 9)
            return false;
        return substr($number, -9);
    }
}


if (!function_exists('getPhoneWithoutCode')) {
    /**
     * @param $phone
     * @return bool|string
     */
    function getPhoneWithoutCode($phone)
    {
        $number = preg_replace('/\D/', '', $phone);
        if (strlen($number) > 9)
            return substr($number, -9);
        else
            return $number;
    }
}


if (!function_exists('clearPhoneFull')) {
    /**
     * @param $phone
     * @return bool|string
     */
    function clearPhoneFull($phone)
    {
        $number = preg_replace('/\D/', '', $phone);
        if ($number && ctype_digit($number) && strlen($number) === 9) {
            $number = '998' . substr($number, -9);
        }
        return $number;
    }
}


if (!function_exists('addPhoneMask')) {
    /**
     * @param $phone
     * @return bool|string
     */
    function addPhoneMask($phone)           // 901234567 to  +998 90 123 45 67
    {
        $data = clearPhoneFull($phone);
        if (preg_match('/(\d{3})(\d{2})(\d{3})(\d{2})(\d{2})/', $data, $matches)) {
            $result = '+' . $matches[1] . ' ' . $matches[2] . ' ' . $matches[3] . ' ' . $matches[4] . ' ' . $matches[5];
            return $result;
        }
    }
}

if (!function_exists('addPhoneMaskWithoutCountry')) {
    /**
     * @param $phone
     * @return bool|string
     */
    function addPhoneMaskWithoutCountry($phone)           // 901234567 to  90 123 45 67
    {
        return $phone[0] . $phone[1] . ' ' . $phone[2] . $phone[3] . $phone[4]
            . ' ' . $phone[5] . $phone[6] . ' ' . $phone[7] . $phone[8];
    }
}


if (!function_exists('isEmailAddress')) {

    /**
     * @param $email
     * @return bool
     */
    function isEmailAddress($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return true;

        return false;
    }
}


if (!function_exists('clearCard')) {
    /**
     * @param $cardNumber
     * @return bool|string
     */
    function clearCard($cardNumber)
    {
        $number = preg_replace('/\D/', '', $cardNumber);
        if (strlen($number) < 16)
            return false;
        return substr($number, -16);
    }
}

if (!function_exists('clearCardExpire')) {
    /**
     * @return bool|string
     */
    function clearCardExpire($cardExpire)
    {
        $card_expire = preg_replace('/\D/', '', $cardExpire);
        if (strlen($card_expire) < 4)
            return false;
        return substr($card_expire, -4);
    }
}

if (!function_exists('numberFormat')) {
    /**
     * @return string
     */
    function numberFormat($price): string
    {
        return  number_format((float)$price, 0, '.', ' ');
    }
}

if (!function_exists('generateErrors')) {

    function generateErrors($errors = []): array
    {
        $flash_errors = null;
        $index = 0;
        if (is_array($errors)) {
            foreach ($errors as $model_error) {
                if (is_array($model_error)) {
                    foreach ($model_error as $error) {
                        $flash_errors[$index++] = $error;
                    }
                } else {
                    $flash_errors[$index++] = $model_error;
                }
            }
        } else {
            $flash_errors = [$errors];
        }

        return $flash_errors;
    }
}


if (!function_exists('className')) {        // get class name without namespace

    function className($class)
    {
        $path = explode('\\', $class);
        return array_pop($path);
    }
}

if (!function_exists('getClassMethodName')) {        // get class and method name without namespace

    function getClassMethodName($classMethod): array
    {
        $resArr = explode('\\', $classMethod);
        $classMethodName = array_pop($resArr);

        $res = explode('::', $classMethodName);
        $className = $res[0];
        $methodName = $res[1];
        return [
            'className' => $className,
            'methodName' => $methodName,
        ];
    }
}


















