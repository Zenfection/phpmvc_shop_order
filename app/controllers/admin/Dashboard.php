<?php

class Dashboard extends Controller {
    public function index() {
        
        $this->data['page_title'] = 'Dashboard';
        $this->data['content'] = 'admin/dashboard/index';
        $this->data['sub_content'] = [];

        $this->render('layouts/admin_layout', $this->data);
    }
}
?>