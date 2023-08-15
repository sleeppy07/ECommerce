<?php
class SpecificationProducts extends Controller {

    public $data = [], $model = [];

    public $SpecificationProductModel;
    public function __construct(){
        //construct
        $this->SpecificationProductModel = $this->model('SpecificationProductModel');
    }

    public function CreateSpecificationProduct($ProductId, $SpecificationId, $Value)
    {
        $request = $this->SpecificationProductModel->CreateSpecificationProduct($ProductId, $SpecificationId, $Value);
        $this->data['sub_content']['create_specificationproducts'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    public function UpdateSpecificationProduct($Id, $Value)
    {
        $request = $this->SpecificationProductModel->UpdateSpecificationProduct($Id, $Value);
        $this->data['sub_content']['update_specificationproducts'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    public function DeleteSpecificationProduct($Id)
    {
        $request = $this->SpecificationProductModel->DeleteSpecificationProduct($Id);
        $this->data['sub_content']['delete_specificationproducts'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    
    public function ListSpecificationProduct($ProductId)
    {
        $request = $this->SpecificationProductModel->ListSpecificationProduct($ProductId);
        $this->data['sub_content']['list_specificationproducts'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
}