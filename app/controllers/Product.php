<?php
class Product extends Controller {

    public $data = [], $model = [];

    public $productModel;
    public function __construct(){
        //construct
        $this->productModel = $this->model('ProductModel');
    }

    public function CreateProduct($CategoryId, $Name, $Description, $Price, $Discount)
    {
        $request = $this->productModel->CreateProduct($CategoryId, $Name, $Description, $Price, $Discount);
        $this->data['sub_content']['create_products'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);

    }
    public function UpdateProduct($Id, $CategoryId, $Name, $Description, $Price, $Discount, $Rank)
    {
        $request = $this->productModel->UpdateProduct($Id, $CategoryId, $Name, $Description, $Price, $Discount, $Rank);
        $this->data['sub_content']['update_products'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    public function DeleteProduct($Id)
    {
        $request = $this->productModel->DeleteProduct($Id);
        $this->data['sub_content']['delete_products'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
}