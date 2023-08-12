<?php
class CartModel extends Model{
    
    function tableFill(){
        return 'carts';
    }
 
     function fieldFill(){
        return '*';
     }
 
     function primaryKey(){
         return 'Id';
     }
     public function CreateCart($ProductId, $UserId, $Quantity)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->Where('ProductId', '=', $ProductId)->Where('UserId', '=', $UserId)->first();
        if($check != null)
        {
            $data = [
                'Quantity' => $Quantity + $check->Quantity
            ];
            $this->db->table($tableName)->update($data)->where('ProductId', '=', $ProductId)->Where('UserId', '=', $UserId);
            return $this->db->lastId();
        }
        $data = [
            'ProductId' => $ProductId,
            'UserId'=> $UserId,
            'Quantity' => $Quantity
        ];
        $this->db->table($tableName)->insert($data);
        return $this->db->lastId();
    }
    public function DeleteCart($ProductId, $UserId)
    {
       $tableName = $this->tableFill();
       $check = $this->db->table($tableName)->where('ProductId', '=', $ProductId)->Where('UserId', '=', $UserId)->first();
       if($check == null)
       {
           echo "Product hasn't existed in cart";
           return;
       }
       $result = $this->db->table($tableName)->where('ProductId', '=', $ProductId)->Where('UserId', '=', $UserId)->delete();
       
       if($result) echo 'Delete product successful.';
       else echo 'Delete product fail. Please try again!';
    }
    public function UpdateCart($ProductId, $UserId, $Quantity)
    {
       $tableName = $this->tableFill();
       $check = $this->db->table($tableName)->where('ProductId', '=', $ProductId)->Where('UserId', '=', $UserId)->first();
       if($check == null){
        echo "Product hasn't existed in cart";
        return; 
    } 
    $data = [
        'Quantity' => $Quantity ? $Quantity : $check->Quantity,
    ];
    $this->db->table($tableName)->where('ProductId' , '=' , $ProductId)->update($data);
    return $check;
 }
 public function ListCart($Page, $PageSize)
 {
    $tableProductImage = 'productimages';
    $tableProduct = 'products';
    $tableCart = 'Carts';
    $relationshipCartAndProduct = $tableCart . '.ProductId' . ' = ' . $tableProduct . '.Id';
    $relationProductImageAndProduct = $tableProductImage . '.ProductId' . ' = ' . $tableProduct . '.Id';
    $data = $this->db->select($tableProductImage.'.ProductId, '.$tableProduct.'.Name, '.$tableProduct.'.Price, '.$tableProduct.'.Discount, '.$tableCart.'.Quantity, '.$tableProduct.'.Discount*'.$tableCart.'.Quantity AS Total')
                        ->table($tableCart)
                        ->join($tableProduct, $relationshipCartAndProduct)
                        ->join($tableProductImage, $relationProductImageAndProduct)
                        ->groupBy($tableProduct.'.Id, '.$tableProduct.'.Name, '.$tableProduct.'.Price, '.$tableProduct.'.Discount');
                      
        $data = $data->limit($Page, $PageSize);
        return $data->get();
     }




    }