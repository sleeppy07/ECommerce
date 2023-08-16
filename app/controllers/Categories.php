<?php 
class Categories extends Controller{
    
    public $data = [], $model = [];

    public $categoryModel;
    public function __construct(){
        //construct
        $this->categoryModel = $this->model('CategoryModel');
    }

    public function CreateCategory($Name, $Description, $ParentCategoryId)
    {
        $request = $this->categoryModel->CreateCategory($Name, $Description, $ParentCategoryId);
        $this->data['sub_content']['create_categories'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);

    }
    public function UpdateCategory($Id, $Name, $Description, $ParentCategoryId)
    {
        $request = $this->categoryModel->UpdateCategory($Id, $Name, $Description, $ParentCategoryId);
        $this->data['sub_content']['update_categories'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    public function DeleteCategory($Id)
    {
        $request = $this->categoryModel->DeleteCategory($Id);
        $this->data['sub_content']['delete_categories'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('layouts/client_layout', $this->data);
    }
    
    public function ListCategory()
    {
        $request = $this->categoryModel->ListCategory(null, 1);
        //var_dump($request);
        $this->data['sub_content']['list_categories'] = $request;
        //$this->data['content'] = 'users/list';

        //Render view
        //$this->render('blocks/header', $this->data);
    }

    public function DetailCategory($CategoryId)
    {
        $request = $this->categoryModel->DetailCategory($CategoryId);
        $this->data['sub_content']['detail_categories'] = $request;
        //$this->data['content'] = 'products/list';

        //Render view
        $this->render('blocks/header', $this->data);
    }

}