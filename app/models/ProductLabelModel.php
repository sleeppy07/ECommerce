<?php
class ProductLabelModel extends Model{
    
    function tableFill(){
        return 'productlabels';
    }
 
     function fieldFill(){
        return '*';
     }
 
     function primaryKey(){
         return 'Id';
     }

     public function CreateProductLabel($ProductId, $Type)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->Where('Type', '=', $Type)->Where('ProductId', '=', $ProductId)->first();
        if($check != null)
        {
            echo "Product has this label";
            return; 
        }
        $data = [
            'ProductId' => $ProductId,
            'Type' => $Type
        ];
        $this->db->table($tableName)->insert($data);
        return $this->db->lastId();
     }
     public function UpdateProductLabel($ProductId, $Type)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('ProductId' , '=' , $ProductId)->get();
        if(count($check) == 2){
            echo "Product had this label";
            return; 
        }
        
        $data = [
            'ProductId' => $ProductId ? $ProductId : $check->ProductId,
            'Type' => $Type ? $Type : $check->Type
        ];
        $this->db->table($tableName)->where('ProductId' , '=' , $ProductId)->update($data);
        return $check;
     }
     public function DeleteProductLabel($ProductId, $Type)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('ProductId', '=', $ProductId)->first();
        if($check == null)
        {
            echo "Product hasn't this label";
            return;
        }
        $result = $this->db->table($tableName)->where('ProductId', '=', $ProductId)->where('Type', '=', $Type)->delete();
        
        if($result) echo 'Delete Successful.';
        else echo 'Delete Fail.';
     }
     public function ListProductLabel($Name, $Type, $Page, $PageSize)
     {
        $tableProduct = 'products';
        $tableProductLabel = 'productlabels';
        $relationshipProductAndProductLabel = $tableProduct . '.Id' . ' = ' . $tableProductLabel . '.ProductId';
        $data = $this->db->select($tableProduct.'.Id, '.$tableProduct.'.Name')
        ->table($tableProduct)
        ->join($tableProductLabel, $relationshipProductAndProductLabel)
        ->where($tableProductLabel.'.Type', ' = ', $Type);
        if (!empty($Name)){
            $data = $data->whereLike('Name','=' ,$Name);
        }
        $data = $data->limit($Page, $PageSize);
        return $data->get();
    }
}