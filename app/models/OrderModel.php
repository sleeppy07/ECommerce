<?php
class OrderModel extends Model{
    
    function tableFill(){
        return 'orders';
    }
 
     function fieldFill(){
        return '*';
     }
 
     function primaryKey(){
         return 'Id';
     }

    public function CreateOrder($UserId, $Fullname, $Address, $PhoneNumber, $ShippingFee)
    {
        $result = $this->db->BindParams($UserId.','.$Fullname.','.$Address.','.$PhoneNumber.','.$ShippingFee)->executeProcedure('CreateOrder', $UserId.','.$Fullname.','.$Address.','.$PhoneNumber.','.$ShippingFee);
        if($result) echo 'Create Successful.';
        else echo 'Create Fail.';
    }

    public function DeleteOrder($Id)
    {
        $result = $this->db->BindParams($Id)->executeProcedure('DeleteOrder', $Id);
        if($result) echo 'Detele Successful.';
        else echo 'Delete Fail.';
    }

    public function UpdateOrder($Id, $Status)
    {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('Id', '=', $Id)->first();
        if($check == NULL){
            echo "This Order not existed";
            return; 
        } 
        $data = [
            'Status' => $Status
        ];
        $result = $this->db->table($tableName)->where('Id' , '=' , $Id)->update($data);
        return $check;
    }

    public function DetailOrder($Id)
    {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('Id', '=', $Id)->first();
        if($check == NULL){
            echo "This Order not existed";
            return; 
        } 
        return $check;
    }

    public function ListOrder($UserId, $Status, $StartDate, $EndDate, $Page, $PageSize)
    {
        $tableName = $this->tableFill();
        $data = $this->db->table($tableName);
        if (!empty($UserId)){
            $data = $data->where('UserId', ' = ',$UserId);
        }
        if (!empty($Status)){
            $data = $data->where('Status', ' = ',$Status);
        }
        if (!empty($StartDate) && !empty($EndDate)){
            $data = $data->where('CreatedDate','>', $StartDate)->where('CreatedDate','<',$EndDate);
        }
        $data = $data->limit($Page, $PageSize);
        return $data->get();
    }



}