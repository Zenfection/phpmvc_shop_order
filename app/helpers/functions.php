<?php
    function toSlug($str){
        return $str;
    }
    function number_price($number) {
        return number_format($number, 0, ',', '.') . 'đ';
    }
?>