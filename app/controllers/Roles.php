<?php 
class Roles extends Controller{
    
    public $data = [], $model = [];
    public $roleModel;
    public function __construct(){
        //construct
        $this->roleModel = $this->model('RoleModel');
    }

    public function ListRole()
    {
        $request = $this->roleModel->ListRole();
        $this->data['sub_content']['list_roles'] = $request;
        //$this->data['content'] = 'roles/check'; //render view

        $this->render('layouts/client_layout', $this->data);
    }
    
    public function CheckUserRole($UserId, $RoleId){

        $request = $this->roleModel->CheckUserRole($UserId, $RoleId);
        $this->data['sub_content']['check_UserRoles'] = $request;
        //$this->data['content'] = 'roles/check'; //render view

        $this->render('layouts/client_layout', $this->data);
    }

    public function AddUserRole($UserId, $RoleId)
    {
        $request = $this->roleModel->AddUserRole($UserId, $RoleId);
        $this->data['sub_content']['add_UserRoles'] = $request;
        //$this->data['content'] = 'roles/check'; //render view

        $this->render('layouts/client_layout', $this->data);
    }

    public function DeleteUserRole($UserId, $RoleId)
    {
        $request = $this->roleModel->DeleteUserRole($UserId, $RoleId);
        $this->data['sub_content']['delete_UserRoles'] = $request;
        //$this->data['content'] = 'roles/check'; //render view

        $this->render('layouts/client_layout', $this->data);
    }

    public function ListUserRole($Username, $Fullname, $Email, $PhoneNumber, $Role, $Page, $PageSize)
    {
        $request = $this->roleModel->ListUserRole($Username, $Fullname, $Email, $PhoneNumber, $Role, $Page, $PageSize);
        $this->data['sub_content']['list_UserRoles'] = $request;
        //$this->data['content'] = 'roles/check'; //render view

        $this->render('layouts/client_layout', $this->data);
    }
}