<?php
    function toSlug($str){
        return $str;
    }
    function number_price($number) {
        return number_format($number, 0, ',', '.') . 'đ';
    }
    function rating($ranking, $starClass, $halfStarClass, $noStarClass){
        for ($i = 0; $i < 5; $i++) {
            if ($ranking > 2) {
                echo "<i class='$starClass'></i>";
                $ranking -= 2;
            } else if ($ranking > 0) {
                echo "<i class='$halfStarClass'></i>";
                $ranking = 0;
            } else {
                echo "<i class='$noStarClass'></i>";
            }
        }
    }
?>