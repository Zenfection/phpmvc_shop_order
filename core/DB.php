<?php

namespace Core;

class DB{
    public $db;

    function __construct(){
        $this->db = new Database();
    }
}
?>