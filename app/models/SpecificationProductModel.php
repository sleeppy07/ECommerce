<?php
class SpecificationProductModel extends Model{
    
    function tableFill(){
        return 'specificationproducts';
    }
 
     function fieldFill(){
        return '*';
     }
 
     function primaryKey(){
         return 'Id';
     }
     public function CreateSpecificationProduct($ProductId, $SpecificationId, $Value)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->Where('ProductId', '=', $ProductId)->Where('SpecificationId', '=', $SpecificationId)->first();
        if($check != null)
        {
            echo "Specification Product existed";
            return; 
        }
        $data = [
            'ProductId' => $ProductId,
            'SpecificationId' => $SpecificationId,
            'Value' => $Value
        ];
        $this->db->table($tableName)->insert($data);
        return $this->db->lastId();
     }
     public function DeleteSpecificationProduct($Id)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->Where('Id', '=', $Id)->first();
        if($check == null)
        {
            echo "Specification Product hasn't exist";
            return;
        }
        $result = $this->db->table($tableName)->Where('Id', '=', $Id)->delete();
        
        if($result) echo 'Delete Specification Product Successful.';
        else echo 'Delete Specification Product Fail.';
     }
     public function UpdateSpecificationProduct($Id, $Value)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('Id', '=', $Id)->first();
        if($check == null){
         echo "Specification product hasn't existed";
         return; 
        }        
        $data = [
            'Value' => $Value ? $Value : $check->Value
        ];
        $this->db->table($tableName)->where('Id' , '=' , $Id)->update($data);
        return $check;
    }
    public function ListSpecificationProduct($ProductId)
    {
        $tableSpecification = 'specifications';
        $tableSpecificationProduct = 'specificationproducts';
        $relationshipSpecificationAndSpecificationProduct = $tableSpecification . '.Id' . ' = ' . $tableSpecificationProduct . '.SpecificationId';
        $data = $this->db->select( $tableSpecification . '.Id, '.$tableSpecification.'.Title, '.$tableSpecificationProduct.'.Value')
        ->table($tableSpecification)
        ->join($tableSpecificationProduct, $relationshipSpecificationAndSpecificationProduct)
        ->where($tableSpecificationProduct.'.ProductId', ' = ', $ProductId)->orderby($tableSpecification . '.Id', 'ASC');
        return $data->get();
    }
    }