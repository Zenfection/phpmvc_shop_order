<?php

namespace App\controllers;

use Core\Controller;
use Core\Session;

class About extends Controller{
    /**
     * @param TRANG_GIỚI_THIỆU_WEB
     * 
     * ! PAGE: 
     *   * index()                          => Trang giới thiệu web
     *    
    */

    //! PAGE ------------------------------
    public function index(){
        $title = 'Giới Thiệu';

        $this->data['page_title'] = $title;
        $this->data['content'] = 'about/index';
        $this->data['sub_content'] = [];

        $this->render('layouts/client_layout', $this->data);
    }

    public function content(){
        $page_tittle = 'Giới thiệu';

        $contentView = file_get_contents(_WEB_ROOT . '/app/views/' . 'about' . '.php');
        echo $contentView;
    }
}
?>