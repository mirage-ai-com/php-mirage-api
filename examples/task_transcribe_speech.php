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
    "type" => "audio/mp3",
    "url" => "https://storage.crisp.chat/users/upload/session/5acfdb5400c15c00/audio1681224631050_9elgef.mp3"
  ]
]);

var_dump($data);

?>
