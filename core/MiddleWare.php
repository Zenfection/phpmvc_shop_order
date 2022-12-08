<?php

namespace Core;

abstract class MiddleWare {
    public $db; 
    
    abstract function handle();
}
?>