<?php
class Home extends Controller{

    public $province, $data;
    public $userModel;
    public $roleModel;
    public $cartModel;
    public $productModel;
    public function __construct(){
        $this->province = $this->model('HomeModel');
        $this->userModel = $this->model('UserModel');
        $this->roleModel = $this->model('RoleModel');
        $this->cartModel = $this->model('CartModel');
        $this->productModel = $this->model('ProductModel');
    }

    public function ListProduct($CategoryId = '', $Name = '', $Page = '', $PageSize='')
    {
        
        $request = $this->productModel->ListProduct($CategoryId, $Name, $Page, $PageSize);
        $this->data['sub_content']['list_products'] = $request;
        $this->data['content'] = 'home/main';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }

    public function Register($Username, $Email, $PhoneNumber, $Password, $Gender, $DOB)
    {
        $this->data['sub_content']['new_title'] = 'Register';
        if($_SERVER['REQUEST_METHOD']=='POST') {
            if($_POST['Register']){
                $Username = $_POST['Username'];
                $Password = $_POST['Password'];
                $confirm_password = $_POST['confirm_password'];
                $Email = $_POST['Email'];
                $PhoneNumber = $_POST['PhoneNumber'];
                $Gender = $_POST['Gender'];
                $DOB = $_POST['DOB'];
                
                // $request = new Request();
                // if ($request->isPost()){
                //     /*Set rules*/
                //     $request->rules([
                //         'Username' => 'required|min:6|unique:users:Username',
                //         'Password' => 'required|min:6',
                //         'PhoneNumber' => 'required|min:9|unique:users:PhoneNumber',
                //         'Email' => 'required|email|min:6|unique:users:Email',
                //         'confirm_password' => 'required|match:Password',
                //         'Gender' => 'required',
                //         'DOB' => 'required'
                //     ]);

                //     //Set message
                //     $request->message([
                //         'Username.required' => 'Username không được để trống',
                //         'Username.min' => 'Username phải lớn hơn 6 ký tự',
                //         'Username.unique' => 'Username đã tồn tại trong hệ thống',
                //         'Email.required' => 'Email không được để trống',
                //         'Email.email' => 'Định dạng Email không hợp lệ',
                //         'Email.min' => 'Email phải lớn hơn 6 ký tự',
                //         'Email.unique' => 'Email đã tồn tại trong hệ thống',
                //         'PhoneNumber.required' => 'Số điện thoại không được để trống',
                //         'PhoneNumber.min' => 'Số điện thoại phải lớn hơn 9 ký tự',
                //         'PhoneNumber.unique' => 'Số điện thoại đã tồn tại trong hệ thống',
                //         'Password.required' => 'Mật khẩu không được để trống',
                //         'Password.min' => 'Mật khẩu phải lớn hơn 6 ký tự',
                //         'confirm_password.required' => 'Nhập lại mật khẩu không được để trống',
                //         'confirm_password.match' => 'Mật khẩu nhập lại không khớp',
                //         'Gender.required' => 'Giới tính không được để trống',
                //         'DOB.required' => 'Ngày tháng năm sinh không được để trống'
                //     ]);

                //     $validate = $request->validate();
                //     if (!$validate){
                //         Session::flash('msg', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
                //     }
                // }
                $user = $this->userModel->UserCreate($Username, $Email, $PhoneNumber, $Password, $Gender, $DOB);
                if($user)
                {
                    $userRole = $this->roleModel->CheckUserRole($user["Id"]);
                    Session::data('Enviroment', 'EndUser');
                    Session::data('UserId', $userRole["UserId"]); 
                    Session::data('RoleId', $userRole["RoleId"]);
                    Session::data('UserCart', 0);
                    $response = new Response();
                    $response->redirect('users/profile');

                } else {
                    $this->data['content'] = 'User/Register';
                    $this->render('layouts/client_layout', $this->data);
                }

            } else {
                $this->data['content'] = 'User/Register';
                $this->render('layouts/client_layout', $this->data);
            }
        } else {
            $this->data['content'] = 'User/Register';
            $this->render('layouts/client_layout', $this->data);
        }
    }

    public function Login()
    {
        $this->data['sub_content']['new_title'] = 'Login';
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $Username = $_POST['username'];
            $Password = $_POST['password'];

            // $request = new Request();
            // if ($request->isPost()){
            //     /*Set rules*/
            //     $request->rules([
            //         'username' => 'required|username|min:6|unique:users:Username',
            //         'password' => 'required|min:6'
            //     ]);

            //     //Set message
            //     $request->message([
            //         'username.required' => 'Email không được để trống',
            //         'username.min' => 'Email phải lớn hơn 6 ký tự',
            //         'username.unique' => 'Email đã tồn tại trong hệ thống',
            //         'password.required' => 'Mật khẩu không được để trống',
            //         'password.min' => 'Mật khẩu phải lớn hơn 6 ký tự'
            //     ]);

            //     $validate = $request->validate();
            //     if (!$validate){
            //         Session::flash('msg', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
            //     }
            // }
            $user = $this->userModel->UserCheck($Username, $Password);
            if($user){
                $cartItems = 0;
                //var_dump($user["Id"]);
                $userRole = $this->roleModel->CheckUserRole($user["Id"]);
                $userCart = $this->cartModel->ListCart($user["Id"]);
                if($userCart){
                    foreach ($userCart as $cart) {
                        $cartItems = $cartItems +  $cart->Quantity;
                    }
                }
                Session::data('Enviroment', 'EndUser');
                Session::data('UserId', $userRole["UserId"]); 
                Session::data('RoleId', $userRole["RoleId"]);
                Session::data('UserCart', $cartItems);
                // $response = new Response();
                // $response->redirect('Home/main');
            } else {
                $this->data['content'] = 'users/Login';
                $this->render('layouts/client_layout', $this->data);
            }
        }
        else {
            $this->data['content'] = 'users/Login';
            $this->render('layouts/client_layout', $this->data);
        }
    }

    public function Logout()
    {
        Session::delete('UserId');
        Session::delete('RoleId');
        Session::delete('UserCart');
        Session::delete('Enviroment');
        $response = new Response();
        $response->redirect('Home/login');
    }

    
    





    public function index(){

        $data = [
            'email' => 'hoangan.web@gmail.com',
            'password' => md5('123456'),
            'phone' => '01234567',
            'fullname' => 'Hoàng An',
            'create_at' => date('Y-m-d H:i:s')
        ];
    }

    public function get_user(){
        $this->data['msg'] = Session::flash('msg');
        $this->render('users/add', $this->data);
    }

    public function post_user(){
        $userId = 20;
        $request = new Request();
        if ($request->isPost()){
            /*Set rules*/
            $request->rules([
                'fullname' => 'required|min:5|max:30',
                'email' => 'required|email|min:6|unique:users:email',
                'password' => 'required|min:3',
                'confirm_password' => 'required|match:password',
                'age' => 'required|callback_check_age'
            ]);

            //Set message
            $request->message([
                'fullname.required' => 'Họ tên không được để trống',
                'fullname.min' => 'Họ tên phải lớn hơn 5 ký tự',
                'fullname.max' => 'Họ tên phải nhỏ hơn 30 ký tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Định dạng email không hợp lệ',
                'email.min' => 'Email phải lớn hơn 6 ký tự',
                'email.unique' => 'Email đã tồn tại trong hệ thống',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu phải lớn hơn 3 ký tự',
                'confirm_password.required' => 'Nhập lại mật khẩu không được để trống',
                'confirm_password.match' => 'Mật khẩu nhập lại không khớp',
                'age.required' => 'Tuổi không được để trống',
                'age.callback_check_age' => 'Tuổi không được nhỏ hơn 20'
            ]);

            $validate = $request->validate();
            if (!$validate){
                Session::flash('msg', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại');
            }

        }

        $response = new Response();
        $response->redirect('home/get_user');
    }

    public function check_age($age){

        if ($age>=20) return true;
        return false;
    }
}