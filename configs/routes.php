<?php

$routes['default_controller'] = 'home';
/**
 * Đường dẫn ảo => Đường dẫn thật
 * 
*/

// $routes['shop/shortby/(:any)/'] = 'shop/shortby/$1';
$routes['shop/shortby/(.+)/all/(.+)'] = 'shop/shortby/$1/$2';
$routes['san-pham'] = 'shop/page/1';
?>

