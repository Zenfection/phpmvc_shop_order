<?php

namespace Core;

/* Base Model */
abstract class Model extends Database{
    protected $db;
    protected $mc;

    function __construct(){
        $this->db = new Database();
        $this->mc = new Memcached();
    }

    abstract function tableFill();
    abstract function fieldFill();

    public function get(){
        $tableName = $this->tableFill();
        $field = $this->fieldFill();
        if(empty($tableName) || empty($field)){
            return false;
        }
        $sql = "SELECT $field FROM $tableName";
        $data = $this->db->query($sql);
        if(!empty($data)){
            return $data;
        }
        return false;
    }

    public function count(){
        $tableName = $this->tableFill();
        if(empty($tableName)){
            return false;
        }
        $sql = "SELECT COUNT(*) FROM $tableName";
        $data = $this->db->query($sql);
        if(!empty($data)){
            return $data;
        }
        return false;
    }
}
?>