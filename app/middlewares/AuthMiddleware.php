<?php
class AuthMiddleware extends Middlewares {
    public function handle(){

        if (Session::data('admin_login')==null){
            $response = new Response();
            //$response->redirect('trang-chu');
        }
    }
    public static function AdminAuthorized(){
        if(Session::data('UserId') != null && Session::data('RoleId') != null && Session::data('RoleId') != 3){
            return true;
        }else {
            Session::showErrors('Unauthorized');
            //$response = new Response();
            //$response->redirect('admin/login');
        }
    }

    public static function UserAuthorized(){
        if(Session::data('UserId') != null && Session::data('RoleId') != null){
            return true;
        }else {
            Session::showErrors('Unauthorized');
            //$response = new Response();
            //$response->redirect('identity/login');
        }
    }


    public static function UserGuest(){
        if(Session::data('UserId') == null){
            return true;
        }else {
            Session::showErrors('Already Signed');
            //$response = new Response();
            //$response->redirect('user/profile');
        }
    }


    public static function AdminGuest(){
        if(Session::data('UserId') == null && (Session::data('RoleId')  == null || Session::data('RoleId') == 3)){
            return true;
        }else {
            Session::showErrors('Already Signed');
            //$response = new Response();
            //$response->redirect('admin/dashboard');
        }
    }
}