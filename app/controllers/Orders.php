<?php
class Orders extends Controller {

    public $data = [], $model = [];

    public $productModel;
    public function __construct(){
        //construct
        $this->orderModel = $this->model('OrderModel');
    }

    public function CreateOrder($UserId, $Fullname, $Address, $PhoneNumber, $ShippingFee)
    {
        
        $request = $this->orderModel->CreateOrder($UserId, $Fullname, $Address, $PhoneNumber, $ShippingFee);
        $this->data['sub_content']['create_products'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);

    }
    public function DeleteOrder($Id)
    {
        $request = $this->orderModel->DeleteOrder($Id);
        $this->data['sub_content']['delete_orders'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);

    }
    public function  UpdateOrder($Id, $Status)
    {
        $request = $this->orderModel-> UpdateOrder($Id, $Status);
        $this->data['sub_content']['update_orders'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);

    }
    public function DetailOrder($Id)
    {
        $request = $this->orderModel->DetailOrder($Id);
        $this->data['sub_content']['detail_orders'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);

    }
    public function ListOrder($UserId, $Status, $StartDate, $EndDate, $Page, $PageSize)
    {
        $request = $this->orderModel->ListOrder($UserId, $Status, $StartDate, $EndDate, $Page, $PageSize);
        $this->data['sub_content']['list_orders'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);

    }


}