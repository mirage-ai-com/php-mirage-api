<?php

/*
 * php-mirage-api
 *
 * Copyright 2023, Valerian Saliou
 * Author: Valerian Saliou <valerian@valeriansaliou.name>
 */

require __DIR__."/../vendor/autoload.php";

$client = new Mirage(
  "ui_a311da78-6b89-459c-8028-b331efab20d5",
  "sk_f293d44f-675d-4cb1-9c78-52b8a9af0df2"
);

$data = $client->task->transcribeSpeech([
  "locale" => [
    "to" => "en"
  ],

  "media" => [
    "type" => "audio/webm",
    "url" => "https://files.mirage-ai.com/dash/terminal/samples/transcribe-speech/hey-there.weba"
  ]
]);

var_dump($data);

?>
