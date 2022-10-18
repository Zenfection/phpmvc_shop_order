<?php

$routes['default_controller'] = 'home';
/**
 * Đường dẫn ảo => Đường dẫn thật
 * 
*/
$routes['san-pham'] = 'product/detail';
$routes['trang-chu'] = 'home';
$routes['gioi-thieu'] = 'about';
$routes['lien-he'] = 'contact';
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';
?>