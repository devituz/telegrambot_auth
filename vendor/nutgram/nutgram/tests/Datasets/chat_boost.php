<?php

dataset('chat_boost', function () {
    $file = file_get_contents(__DIR__.'/../Fixtures/Updates/chat_boost.json');

    return [json_decode($file)];
});
