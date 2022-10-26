<?php

class Request {
    private $__rules = array();
    private $__message = array();
    private $__errors = array();
    public $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function isPost(){
        return $this->getMethod() == 'post';
    }
    public function isGet(){
        return $this->getMethod() == 'get';
    }

    public function getField(){
        $data = array();
        if($this->isPost()){
            if(!empty($_POST)){
                foreach($_POST as $key => $value){
                    if(is_array($value)){
                        $data[$key] = $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        if($this->isGet()){
            if(!empty($_GET)){
                foreach($_GET as $key => $value){
                    if(is_array($value)){
                        $data[$key] = $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        return $data;
    }

    public function rules($rules = []){
        $this->__rules = $rules;
    }
    public function message($message = []){
        $this->__message = $message;
    }
    public function setError($fieldName, $ruleName){
        $this->__errors[$fieldName][$ruleName] = $this->__message[$fieldName. '.' . $ruleName];
    }

    public function validate(){
        $checkValidate = true;
        $this->__rules = array_filter($this->__rules);
        if(!empty($this->__rules)){
            $dataField = $this->getField();

            foreach($this->__rules as $fieldName => $ruleItem){
                $ruleItemArr = explode('|', $ruleItem);

                foreach($ruleItemArr as $rule){
                    $ruleName = null;
                    $ruleValue = null;

                    $ruleArr = explode(':', $rule);
                    $ruleName = reset($ruleArr);
                    
                    if(count($ruleArr) > 1){
                        $ruleValue = end($ruleArr);
                    } 
                    if($ruleName == 'required'){
                        if(empty(trim($dataField[$fieldName]))){
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if($ruleName == 'min'){
                        if(strlen(trim($dataField[$fieldName])) < $ruleValue){
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if($ruleName == 'max'){
                        if(strlen(trim($dataField[$fieldName])) > $ruleValue){
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if($ruleName == 'email'){
                        if(!filter_var($dataField[$fieldName], FILTER_VALIDATE_EMAIL)){
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if($ruleName == 'match'){
                        if(trim($dataField[$fieldName]) != trim($dataField[$ruleValue])){
                            $this->setError($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    if($ruleName == 'unique'){
                        $tableName = null;
                        $fieldUnique = null;
                        if(!empty($ruleArr[1])) $tableName = $ruleArr[1];
                        if(!empty($ruleArr[2])) $fieldUnique = $ruleArr[2];
                        if(!empty($tableName) && !empty($fieldName)){
                            $checkExist = $this->db->table($tableName)->where($fieldName, '=', $dataField[$fieldName])->count();
                            if(!empty($checkExist)){
                                $this->setError($fieldName, $ruleName);
                                $checkValidate = false;
                            }
                        }
                    }

                    // callback_validate
                    if(preg_match('~^callback_(.+)~is', $ruleName, $callbackArr)){
                        if(!empty($callbackArr[1])){
                            $callbackName = $callbackArr[1];
                            $controller = App::$app->getCurrentController();
                            if(method_exists($controller, $callbackName)){
                                $checkCallBack = call_user_func_array([$controller, $callbackName], [trim($dataField[$fieldName])]);
                                if(!$checkCallBack){
                                    $this->setError($fieldName, $ruleName);
                                    $checkValidate = false;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $sessionKey = Session::isValid();
        Session::flash($sessionKey . '_errors', $this->errors());
        Session::flash($sessionKey . '_old', $this->getField());

        return $checkValidate;
    }
    
    public function errors($fieldName = ''){
        if(!empty($this->__errors)){
            if(empty($fieldName)){
                $errorArr = array();
                foreach($this->__errors as $key => $value){
                    $errorArr[$key] = reset($value); 
                }
                return $errorArr;
            } 
            return reset($this->__errors[$fieldName]);
        }
        return false;
    }
}
