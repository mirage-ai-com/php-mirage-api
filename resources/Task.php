<?php

/*
 * php-mirage-api
 *
 * Copyright 2023, Valerian Saliou
 * Author: Valerian Saliou <valerian@valeriansaliou.name>
 */

class TaskResource {
  public function __construct($parent) {
    $this->parent = $parent;
  }

  public function transcribeSpeech($data) {
    return $this->parent->_post("/task/transcribe/speech", $data);
  }

  public function answerQuestion($data) {
    return $this->parent->_post("/task/answer/question", $data);
  }

  public function summarizeParagraphs($data) {
    return $this->parent->_post("/task/summarize/paragraphs", $data);
  }

  public function summarizeConversation($data) {
    return $this->parent->_post("/task/summarize/conversation", $data);
  }

  public function categorizeConversation($data) {
    return $this->parent->_post("/task/categorize/conversation", $data);
  }

  public function rankQuestion($data) {
    return $this->parent->_post("/task/rank/question", $data);
  }

  public function translateText($data) {
    return $this->parent->_post("/task/translate/text", $data);
  }
}

?>
