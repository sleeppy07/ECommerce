<?php
class ProductLabels extends Controller {

    public $data = [], $model = [];

    public $ProductLabelModel;
    public function __construct(){
        //construct
        $this->ProductLabelModel = $this->model('ProductLabelModel');
    }
    public function  CreateProductLabel($ProductId, $Type)
    {
        $request = $this->ProductLabelModel->CreateProductLabel($ProductId, $Type);
        $this->data['sub_content']['create_productlabels'] = $request;
        //$this->data['content'] = 'productlabels/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);

    }
    public function UpdateProductLabel($ProductId, $Type)
    {
        $request = $this->ProductLabelModel->UpdateProductLabel($ProductId, $Type);
        $this->data['sub_content']['update_productlabels'] = $request;
        //$this->data['content'] = 'productlabels/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    public function DeleteProductLabel($ProductId, $Type)
    {
        $request = $this->ProductLabelModel->DeleteProductLabel($ProductId, $Type);
        $this->data['sub_content']['delete_productlabels'] = $request;
        //$this->data['content'] = 'productlabels/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    public function ListProductLabel()
    {
        $request = $this->ProductLabelModel->ListProductLabel();
        $this->data['sub_content']['list_productlabels'] = $request;
        //$this->data['content'] = 'productlabels/check'; //render view

        $this->render('layouts/client_layout', $this->data);
    }
}