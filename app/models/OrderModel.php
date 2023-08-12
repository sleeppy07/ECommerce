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

    //public function CreateOrder()

}