<?php 

class Api extends Controller{
    public function login($username, $password){
        //Post data
        // $username = $_POST['username'];
        // $password = $_POST['password'];
        $password = md5($password);
        //Check data
        $db = new Database();
        $data = $db->table('tb_user')->where('username', '=', $username)->where('password', '=', $password)->get();

        if($data){
            $response = new Response();
            $response->json($data);
        } else {
            $response = new Response();
            $response->json(['error' => 'Username or password is incorrect']);
        }
    }
}
?>