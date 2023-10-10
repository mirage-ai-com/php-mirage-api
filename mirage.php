<?php

/*
 * php-mirage-api
 *
 * Copyright 2023, Valerian Saliou
 * Author: Valerian Saliou <valerian@valeriansaliou.name>
 */

require __DIR__."/resources/Task.php";
require __DIR__."/resources/Data.php";

class Mirage {
  private $DEFAULT_REST_HOST = "https://api.mirage-ai.com";
  private $DEFAULT_REST_BASE = "/v1";
  private $DEFAULT_TIMEOUT = 40000;

  public function __construct($identifier, $key) {
    $this->_rest = new RestClient([
      "user_agent"   => "php-mirage-api/1.2.0",
      "base_url"     => $this->DEFAULT_REST_HOST.$this->DEFAULT_REST_BASE,
      "content_type" => "application/json",

      "curl_options" => [
        CURLOPT_CONNECTTIMEOUT => $DEFAULT_TIMEOUT,
        CURLOPT_TIMEOUT => $DEFAULT_TIMEOUT,
        CURLOPT_SSL_VERIFYHOST => 2
      ],

      "headers"      => [
        "Content-Type" => "application/json"
      ]
    ]);

    $this->_rest->set_option("username", $identifier);
    $this->_rest->set_option("password", $key);

    $this->_rest->register_decoder("json", function($data) {
      return json_decode($data, TRUE);
    });

    $this->task = new TaskResource($this);
    $this->data = new DataResource($this);
  }

  public function setRestHost($host) {
    $this->_rest->set_option("base_url", $host);
  }

  public function _post($resource, $data) {
    return $this->_doPost($resource, $data);
  }

  private function _doPost($resource, $data) {
    return $this->_rest->post($resource, json_encode($data))->decode_response();
  }
}

?>
