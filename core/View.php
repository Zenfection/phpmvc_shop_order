<?php

namespace Core;
class View{
    static public $dataShare = array();

    static public function share($data){
        self::$dataShare = $data;
    }
}
?>