<?php 

namespace Core;

class Memcached {
    private $__conn;

    public function __construct(){
        global $mcconfig;
        $this->__conn = ConnectMem::getInstance($mcconfig);
    }

    function set($key, $value, $time = 0){
        return $this->__conn->set($key, $value, $time);
    }

    function get($key){
        return $this->__conn->get($key);
    }

    function delete($key){
        return $this->__conn->delete($key);
    }

    function flush(){
        return $this->__conn->flush();
    }
}
?>