<?php

class Database{
    private $__conn;

    use QueryBuilder;

    function __construct(){
        global $dbconfig;
        $this->__conn = Connection::getInstance($dbconfig);
    }

    function insertData($table, $data){
        if(!empty($data)){
            $fieldStr = '';
            $valueStr = '';
            foreach($data as $key => $value){
                $fieldStr .= $key . ',';
                $valueStr .= ':' . $key . ',';
                $this->dataVar[$key] = $value;
            }
            $fieldStr = rtrim($fieldStr, ',');
            $valueStr = rtrim($valueStr, ',');

            $sql = "INSERT INTO $table ($fieldStr) VALUES ($valueStr)";
            $status = $this->query($sql, $this->dataVar);
            if($status){
                return true;
            }
        }
        return false;
    }

    function updateData($table, $data, $condition = ''){ 
        if(!empty($data)){
            $updateStr = '';
            foreach($data as $key => $value){
                $updateStr .= $key . '= :' . $key . ',';
                $this->dataVar[$key] = $value;
            }
            
            $updateStr = rtrim($updateStr, ',');

            if(!empty($condition)){
                $sql = "UPDATE $table SET $updateStr WHERE $condition";
            } else {
                $sql = "UPDATE $table SET $updateStr";
            } 
            $sql = trim($sql);
            $status = $this->query($sql, $this->dataVar);
            if($status){
                return true;
            }
        }
        return false;
    }

    function deleteData($table, $condition = ''){
        if(!empty($condition)){
            $sql = "DELETE FROM $table WHERE $condition";
        } else {
            $sql = "DELETE FROM $table";
        }
        $status = $this->query($sql, $this->dataVar);
        if($status){
            return true;
        }
        return false;
    }

    function query($sql, $data = []){
        try {
            $stmt = $this->__conn->prepare($sql);
            if(!empty($data)){
                foreach($data as $key => $value){
                    $stmt->bindValue(':'.$key, $value);
                }
            }
            $stmt->execute();
            $this->resetQuery();
            return $stmt;
        } catch (Exception $e) {
            $data = array(
                'status' => 'error',
                'message' => $e->getMessage()
            );
            App::$app->loadError('database', $data);
            die();
        }
    }
    function count(){
        $sql = "SELECT COUNT(*) FROM $this->tableName $this->innerJoin $this->where";
        $sql = trim($sql);
        $data = $this->query($sql, $this->dataVar)->fetchColumn();
        return $data;
    }
    function lastInsertId(){
        return $this->__conn->lastInsertId();
    }
}
?>