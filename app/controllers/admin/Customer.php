<?php

class Customer extends Controller {
    public function edit(){
        $this->data['page_title'] = 'Sửa thông tin khách hàng';
        $this->data['content'] = 'admin/customer/edit';

        $this->data['sub_content']['msg'] = Session::flash('msg');

        

        $this->render('layouts/admin_layout', $this->data);
    }
}
?>