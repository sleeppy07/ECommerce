<?php 
class Identity extends Controller{
    
    public $data = [], $model = [];

    public $userModel;
    public $roleModel;
    public function __construct(){
        //construct
        $this->userModel = $this->model('UserModel');
        $this->roleModel = $this->model('RoleModel');
    }
    public function Register($Username, $Email, $PhoneNumber, $Password, $Gender, $DOB)
    {
        $request = $this->userModel->UserCreate($Username, $Email, $PhoneNumber, $Password, $Gender, $DOB);
        $this->data['sub_content']['identity_register'] = $request;
        // $this->data['content'] = 'home/index';
        // Session::flash('msg', 'Thêm dữ liệu thành công');
        // $msg = Session::flash('msg');
        //$this->render('users/add', $this->data);
        //echo $msg;
        //Render view
        $this->render('layouts/client_layout', $this->data);
        //$this->render('users/add', $this->data);
    }

    public function Login($Login, $Password, $RoleId)
    {
        $request = $this->userModel->UserCheck($Login, $Password);
        if($request == null) return;
        $requestRole = $this->roleModel->CheckUserRole($request->Id, $RoleId);
        $this->data['sub_content']['identity_login'] = $requestRole;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }



}