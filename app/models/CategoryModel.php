<?php
class CategoryModel extends Model{
    
    function tableFill(){
        return 'categories';
    }
 
     function fieldFill(){
        return '*';
     }
 
     function primaryKey(){
         return 'Id';
     }

     public function CreateCategory($Name, $Description, $ParentCategoryId)
     {
        $tableName = $this->tableFill();
        $Node = 1;
        $check = $this->db->table($tableName)->where('Name', '=', $Name)->first();
        if($check != null)
        {
            echo "Category existed";
            return; 
        }
        if(!empty($ParentCategoryId))
        {
            $checkParent = $this->db->table($tableName)->where('Id', '=', $ParentCategoryId)->first();
            if($checkParent->Node == 3)
            {
                echo "Parent Category had maximum is 3";
                return;
            }
            $Node = $Node + $checkParent->Node;
        }
        $data = [
            'Name' => $Name,
            'Description' => $Description,
            'ParentCategoryId' => $ParentCategoryId,
            'Node' => $Node
        ];
        $this->db->table($tableName)->insert($data);
        return $this->db->lastId();
     }
     public function UpdateCategory($Id, $Name, $Description, $ParentCategoryId)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('Id' , '=' , $Id)->first();
        $Node = $check->Node;
        if($check == NULL){
            echo "Category not existed";
            return; 
        }
        if(!empty($ParentCategoryId))
        {
            $checkParent = $this->db->table($tableName)->where('Id', '=', $ParentCategoryId)->first();
            if($checkParent->Node == 3)
            {
                echo "Parent Category had maximum is 3";
                return;
            }
            $Node = $checkParent->Node + 1;
        }
        $data = [
            'ParentCategoryId' => $ParentCategoryId ? $ParentCategoryId : $check->ParentCategoryId,
            'Name' => $Name ? $Name : $check->Name,
            'Description' => $Description ? $Description : $check->Description,
            'Node' => $Node ? $Node : $check->Node
        ];
        $this->db->table($tableName)->where('Id' , '=' , $Id)->update($data);
        return $check;

     }
     public function DeleteCategory($Id)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('Id', '=', $Id)->first();
        if($check == null)
        {
            echo "Category not existed";
            return;
        }
        if($check->Node != 3)
        {
            echo "Category not child node";
            return;
        }
        if($check->Node == 3)
        {
            $checkProduct = $this->db->table('products')->where('CategoryId', '=', $Id)->first();
            if($checkProduct != null)
            {
                echo "Product existed in Category";
                return;
            }
        }
        $result = $this->db->table($tableName)->where('Id', '=', $Id)->delete();

        if($result) echo 'Detele Successful.';
        else echo 'Delete Fail.';
     }
     public function ListCategory($CategoryId='', $Node='')
     {
        $tableName = $this->tableFill();
        $data = $this->db->table($tableName);
        //Get all Category Node = 1
        if(empty($CategoryId) && empty($Node))
        {
            
            return $data->where('Node', '=', 1)->get();
        }
        return $data->where('ParentCategoryId', '=', $CategoryId)->where('Node', '=', $Node)->get();
     }
     public function DetailCategory($CategoryId)
     {
        $tableName = $this->tableFill();
        $data = $this->db->table($tableName)->where('ParentCategoryId', '=', $CategoryId);
        return $data->get();
     }


}