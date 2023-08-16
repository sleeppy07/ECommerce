<?php
class AuthMiddleware extends Middlewares {
    public function handle(){

        if (Session::data('Page') == 'EndUser'){
            if(Session::data('UserId') == null)
            {
                Session::showErrors('Unauthorized');
                $response = new Response();
                $response->redirect('Home/Login');
                exit;
            } else {
                $response = new Response();
                $response->redirect('User/Profile');
                exit;
            }
        } else {
            if(Session::data('UserId') == null)
            {
                Session::showErrors('Unauthorized');
                $response = new Response();
                $response->redirect('Admin/Login');
                exit;
            }
            if (Session::data('UserId') != null && Session::data('RoleId') == 3)
            {
                Session::showErrors('Forbidden');
                $response = new Response();
                $response->redirect('Admin/Login');
                exit;
            }
            if (Session::data('UserId') != null && Session::data('RoleId') != 3)
            {

                $response = new Response();
                $response->redirect('Admin/Dashboard');
                exit;
            }
        }
    }
}