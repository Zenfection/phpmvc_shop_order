<?php

namespace App\controllers;

use Core\Controller;

class Contact extends Controller {
    public $data;
    
    public function index(){
        $title = 'Liên Hệ';
        
        $this->data['page_title'] = $title;
        $this->data['content'] = 'contact/index';
        $this->data['sub_content'] = [];
        
        $this->render('layouts/client_layout', $this->data);
    }
}
?>