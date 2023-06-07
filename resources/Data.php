<?php

/*
 * php-mirage-api
 *
 * Copyright 2023, Valerian Saliou
 * Author: Valerian Saliou <valerian@valeriansaliou.name>
 */

class DataResource {
  public function __construct($parent) {
    $this->parent = $parent;
  }

  public function contextIngest($data) {
    return $this->parent->_post("/data/context/ingest", $data);
  }
}

?>
