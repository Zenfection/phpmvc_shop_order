<?php

namespace Core;

abstract class  ServiceProvider{
    public $db = null;
    abstract public function boot();
}
?>