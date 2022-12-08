<?php 
namespace App\controllers\admin;

use Core\Controller;
use Core\Session;
class Login extends Controller {
    /**
     * @param TRANG_ĐĂNG_NHẬP_ADMIN
     * ! PAGE
     * * 1. index()                         => Trang đăng nhập admin
    */

    //! PAGE ------------------------------
    public function index(){
        $this->data['page_title'] = 'Đăng nhập Admin';
        $this->data['content'] = 'admin/login/index';

        $this->data['sub_content']['msg'] = Session::flash('msg');

        $this->data['sub_content']['load_only'] = true;

        $this->render('layouts/admin_layout', $this->data);
    }
}
?>