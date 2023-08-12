<?php 
class Users extends Controller{
    
    public $data = [], $model = [];
    public $userModel;
    public function __construct(){
        //construct
        $this->userModel = $this->model('UserModel');
    }
    
    public function UserList($username = null, $email = null, $phoneNumber = null, $startDate = null, $endDate = null, $page = 0, $pageSize = 3){

        $request = $this->userModel->UserList($username, $email, $phoneNumber, $startDate, $endDate, $page, $pageSize);
        $this->data['sub_content']['new_title'] = 'Tin tức 1';
        $this->data['sub_content']['list_users'] = $request;
        $this->data['content'] = 'users/list'; //render view

        $this->render('layouts/client_layout', $this->data);
    }

    public function UserDetail($Id)
    {   
        $request = $this->userModel->UserDetail($Id);
        $this->data['sub_content']['detail_users'] = $request;
        //$this->data['content'] = 'users/list'; //render view

        $this->render('layouts/client_layout', $this->data);
    }

    public function DeleteUser($Id = 3)
    {   
        $request = $this->userModel->DeleteUser($Id);
        $this->data['sub_content']['delete_users'] = $request;
        //$this->data['content'] = 'users/list'; //render view

        $this->render('users/add', $this->data);
    }
}