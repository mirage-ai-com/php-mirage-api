# php-mirage-api

[![Build and Release](https://github.com/mirage-ai-com/php-mirage-api/workflows/Build%20and%20Release/badge.svg)](https://github.com/mirage-ai-com/php-mirage-api/actions?query=workflow%3A%22Build+and+Release%22) [![Version](https://img.shields.io/packagist/v/mirage-ai/php-mirage-api.svg)](https://packagist.org/packages/mirage-ai/php-mirage-api) [![Downloads](https://img.shields.io/packagist/dt/mirage-ai/php-mirage-api.svg)](https://packagist.org/packages/mirage-ai/php-mirage-api)

The Mirage API NodeJS wrapper. Access AI inference services.

Copyright 2023 Crisp IM SAS. See LICENSE for copying information.

* **📝 Implements**: [API Reference (V1)](https://docs.mirage-ai.com/references/api/v1/) at revision: 14/05/2023
* **😘 Maintainer**: [@valeriansaliou](https://github.com/valeriansaliou)

## Usage

Install the library:

```bash
composer require mirage-ai/php-mirage-api
```

Then, import it:

```php
require __DIR__."/vendor/autoload.php";
```

Construct a new authenticated Mirage client with your `user_id` and `secret_key` tokens.

```php
$client = new Mirage("ui_xxxxxx", "sk_xxxxxx");
```

Then, consume the client eg. to transcribe a audio file containing speech to text:

```php
$data = $client->task->transcribeSpeech([
  "locale" => [
    "to" => "en"
  ],

  "media" => [
    "type" => "audio/mp3",
    "url" => "https://storage.crisp.chat/users/upload/session/5acfdb5400c15c00/audio1681224631050_9elgef.mp3"
  ]
]);
```

## Authentication

To authenticate against the API, get your tokens (`user_id` and `secret_key`).

Then, pass those tokens **once** when you instanciate the Mirage client as following:

```php
# Make sure to replace 'user_id' and 'secret_key' with your tokens
$client = new Mirage("user_id", "secret_key");
```

## Resource Methods

This library implements all methods the Mirage API provides. See the [API docs](https://docs.mirage-ai.com/references/api/v1/) for a reference of available methods, as well as how returned data is formatted.

### Task API

#### ➡️ Transcribe Speech

* **Method:** `$client->task->transcribeSpeech(data)`
* **Reference:** [Transcribe Speech](https://docs.mirage-ai.com/references/api/v1/#transcribe-speech)

* **Request:**

```php
$client->task->transcribeSpeech([
  "locale" => [
    "to" => "en"
  ],

  "media" => [
    "type" => "audio/mp3",
    "url" => "https://storage.crisp.chat/users/upload/session/5acfdb5400c15c00/audio1681224631050_9elgef.mp3"
  ]
]);
```

* **Response:**

```json
{
  "reason": "processed",

  "data": {
    "locale": "en",

    "parts": [
      {
        "start": 5.0,
        "end": 9.0,
        "text": " I'm just speaking some seconds to see if the translation is correct"
      }
    ]
  }
}
```

#### ➡️ Answer Question

* **Method:** `$client->task->answerQuestion(data)`
* **Reference:** [Answer Question](https://docs.mirage-ai.com/references/api/v1/#answer-question)

* **Request:**

```php
$client->task->answerQuestion([
  "question" => "Should I pay more for that?",

  "answer" => [
    "start" => "Sure,"
  ],

  "context" => [
    "team" => [
      "id" => "cf4ccdb5-df44-4668-a9e7-3ab31bebf89b",
      "name" => "Crisp"
    ],

    "transcripts" => [
      "conversation" => [
        "messages" => [
          [
            "from" => "customer",
            "text" => "Hey there!"
          ],

          [
            "from" => "agent",
            "text" => "Hi. How can I help?"
          ],

          [
            "from" => "customer",
            "text" => "I want to add more sub-domains to my website."
          ]
        ]
      ],

      "related" => [
        [
          "messages" => [
            [
              "from" => "customer",
              "text" => "Hi, does the \"per website\" pricing include sub-domains?"
            ],

            [
              "from" => "agent",
              "text" => "Hi, yes, it includes sub-domains"
            ],

            [
              "from" => "customer",
              "text" => "Perfect thanks!"
            ]
          ]
        ]
      ]
    ]
  ]
]);
```

* **Response:**

```json
{
  "reason": "processed",

  "data": {
    "answer": "You can add the Crisp chatbox to your website by following this guide: https://help.crisp.chat/en/article/how-to-add-crisp-chatbox-to-your-website-dkrg1d/ :)"
  }
}
```

#### ➡️ Summarize Paragraphs

* **Method:** `$client->task->summarizeParagraphs(data)`
* **Reference:** [Summarize Paragraphs](https://docs.mirage-ai.com/references/api/v1/#summarize-paragraphs)

* **Request:**

```javascript
$client->task->summarizeParagraphs([
  "paragraphs" => [
    [
      "text" => "GPT-4 is getting worse over time, not better."
    ],

    [
      "text" => "Many people have reported noticing a significant degradation in the quality of the model responses, but so far, it was all anecdotal."
    ]
  ]
]);
```

* **Response:**

```json
{
  "reason": "processed",

  "data": {
    "summary": "GPT-4 is getting worse over time, not better. We have a new version of GPT-4 that is not improving, but it is regressing."
  }
}
```

#### ➡️ Summarize Conversation

* **Method:** `$client->task->summarizeConversation(data)`
* **Reference:** [Summarize Conversation](https://docs.mirage-ai.com/references/api/v1/#summarize-conversation)

* **Request:**

```php
$client->task->summarizeConversation([
  "transcript" => [
    [
      "name" => "Valerian",
      "text" => "Hello! I have a question about the Crisp chatbot, I am trying to setup a week-end auto-responder, how can I do that?"
    ],

    [
      "name" => "Baptiste",
      "text" => "Hi. Baptiste here. I can provide you an example bot scenario that does just that if you'd like?"
    ]
  ]
]);
```

* **Response:**

```json
{
  "reason": "processed",

  "data": {
    "summary": "Valerian wants to set up a week-end auto-responder on Crisp chatbot. Baptiste can give him an example."
  }
}
```

#### ➡️ Categorize Conversation

* **Method:** `$client->task->categorizeConversation(data)`
* **Reference:** [Categorize Conversation](https://docs.mirage-ai.com/references/api/v1/#categorize-conversation)

* **Request:**

```php
$client->task->categorizeConversation([
  "transcript" => [
    [
      "from" => "customer",
      "text" => "Hello! I have a question about the Crisp chatbot, I am trying to setup a week-end auto-responder, how can I do that?"
    ],

    [
      "from" => "agent",
      "text" => "Hi. Baptiste here. I can provide you an example bot scenario that does just that if you'd like?"
    ]
  ]
]);
```

* **Response:**

```json
{
  "reason": "processed",

  "data": {
    "category": "Chatbot Configuration Issue"
  }
}
```

#### ➡️ Translate Text

* **Method:** `$client->task->translateText(data)`
* **Reference:** [Translate Text](https://docs.mirage-ai.com/references/api/v1/#translate-text)

* **Request:**

```php
$client->task->translateText([
  "locale" => [
    "from" => "fr",
    "to" => "en"
  ],

  "type" => "html",
  "text" => "Bonjour, comment puis-je vous aider <span translate=\"no\">Mr Saliou</span> ?"
]);
```

* **Response:**

```json
{
  "reason": "processed",

  "data": {
    "translation": "Hi, how can I help you Mr Saliou?"
  }
}
```

### Data API

#### ➡️ Context Ingest

* **Method:** `$client->data->contextIngest(data)`
* **Reference:** [Ingest Context Data](https://docs.mirage-ai.com/references/api/v1/#ingest-context-data)

* **Request:**

```php
$client->data->contextIngest([
  "items" => [
    [
      "primary_id" => "pri_cf44dd72-4ba9-4754-8fb3-83c4261243c4",
      "secondary_id" => "sec_6693a4a2-e33f-4cce-ba90-b7b5b0922c46",
      "tertiary_id" => "ter_de2bd6e7-74e1-440d-9a23-01964cd4b7da",

      "text" => "Text to index here...",
      "source" => "chat",
      "timestamp" => 1682002198552,

      "metadata" => [
        "custom_key" => "custom_value",
        "another_key" => "another_value"
      ]
    ]
  ]
]);
```

* **Response:**

```json
{
  "reason": "processed",

  "data": {
    "imported": true
  }
}
```
