<?php

namespace Core;

use Core\Session;

$sessionKey = Session::isValid();
$errors = Session::flash($sessionKey . '_errors');
$old = Session::flash($sessionKey . '_old');

if(!function_exists('form_error')){
    function form_error($fieldName, $before = '', $after = ''){
        global $errors;
        if(!empty($errors) && array_key_exists($fieldName, $errors)){
            return $before . $errors[$fieldName] . $after;
        } 
        return false;
    }
}

if(!function_exists('oldValue')){
    function oldValue($fieldName, $default = ''){
        global $old;
        if(!empty($old[$fieldName])){
            return $old[$fieldName];
        }
        return $default;
    }
}
?>