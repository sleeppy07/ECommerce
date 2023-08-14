<?php
class Carts extends Controller {

    public $data = [], $model = [];

    public $CartModel;
    public function __construct(){
        //construct
        $this->CartModel = $this->model('CartModel');
    }
    public function  CreateCart($ProductId, $UserId, $Quantity)
    {
        $request = $this->CartModel->CreateCart($ProductId, $UserId, $Quantity);
        $this->data['sub_content']['create_Carts'] = $request;
        //$this->data['content'] = 'Carts/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);

    }
    public function UpdateCart($ProductId, $UserId, $Quantity)
    {
        $request = $this->CartModel->UpdateCart($ProductId, $UserId, $Quantity);
        $this->data['sub_content']['update_Carts'] = $request;
        //$this->data['content'] = 'Carts/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    public function DeleteCart($ProductId, $UserId)
    {
        $request = $this->CartModel->DeleteCart($ProductId, $UserId);
        $this->data['sub_content']['delete_Carts'] = $request;
        //$this->data['content'] = 'Carts/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    public function ListCart($Page = 0, $PageSize = 2, $UserId = 2)
    {
        $request = $this->CartModel->ListCart($Page, $PageSize, $UserId);
        $this->data['sub_content']['list_carts'] = $request;
        $this->data['content'] = 'carts/view'; //render view

        $this->render('layouts/client_layout', $this->data);
    }
}