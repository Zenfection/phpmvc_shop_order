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
     * ! CONTENT:
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
        $contentView = file_get_contents(_DIR_ROOT . '/app/views/about/index.php');
        eval('?>' . $contentView . '<?php');
    }
}
?>