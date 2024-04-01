<?php


if (!function_exists('logError')) {
    function logError(\Exception $e): void
    {
        \Log::error("\n\n\n"
            . "\nMsg: " . $e->getMessage()
            . "\nFile: " . $e->getFile()
            . "\nLine: " . $e->getLine()
            . "\n\n\n");
    }
}

if (!function_exists('logDebug')) {
    function logDebug(string $message): void
    {
        \Log::debug($message);
    }
}

if (!function_exists('logInfo')) {
    function logInfo(string $message): void
    {
        \Log::info($message);
    }
}


