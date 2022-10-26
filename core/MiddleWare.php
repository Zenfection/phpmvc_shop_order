<?php

abstract class MiddleWare {
    public $db; 
    
    abstract function handle();
}
?>