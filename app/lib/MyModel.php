<?php
namespace todoapp;

abstract class MyModel {
    protected $db = NULL;
    
    public function __construct($_db) {
        $this->db = $_db;
    }
}
