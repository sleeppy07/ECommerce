<?php
class ProductModel extends Model{
    
    function tableFill(){
        return 'products';
    }
 
     function fieldFill(){
        return '*';
     }
 
     function primaryKey(){
         return 'Id';
     }
     public function CreateProduct($CategoryId, $Name, $Description, $Price, $Discount)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->orWhere('Name', '=', $Name)->first();
        if($check != null)
        {
            echo "Product existed";
            return; 
        }
        $data = [
            'CategoryId' => $CategoryId,
            'Name' => $Name,
            'Description' => $Description,
            'Price' => $Price,
            'Discount' => $Discount,
            'Rank' => 0
        ];
        $this->db->table($tableName)->insert($data);
        return $this->db->lastId();
     }
     public function UpdateProduct($Id, $CategoryId, $Name, $Description, $Price, $Discount, $Rank)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('Id' , '=' , $Id)->first();
        if($check == NULL){
            echo "Product not existed";
            return; 
        } 
        $data = [
            'CategoryId' => $CategoryId ? $CategoryId : $check->CategoryId,
            'Name' => $Name ? $Name : $check->Name,
            'Description' => $Description ? $Description : $check->Description,
            'Price' => $Price ? $Price : $check->Price,
            'Rank' => $Rank ? $Rank : $check->Rank,
            'Discount' => $Discount ? $Discount : $check->Discount
        ];
        $this->db->table($tableName)->where('Id' , '=' , $Id)->update($data);
        return $check;
     }
     public function DeleteProduct($Id)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('Id', '=', $Id)->first();
        if($check == null)
        {
            echo "Product not existed";
            return;
        }
        $result = $this->db->table($tableName)->where('Id', '=', $Id)->delete();
        
        if($result) echo 'Detele Successful.';
        else echo 'Delete Fail.';
     }
     public function ListProduct()
     {
        
     }
     public function DetailProduct($Id)
     {
        $tableName = $this->tableFill();
        $data = $this->db->table($tableName)->where('Id', '=', $Id)->first();
         return $data;
     }
}