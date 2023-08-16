<?php
function add_cart($id){
    global $list_product;
    $item=get_product_detail($id);
   //show_array($item);
    $quantity=1;
   if(isset($_SESSION['cart']['buy'])&&array_key_exists($id,$_SESSION['cart']['buy'])){
        $quantity=$_SESSION['cart']['buy'][$id]['quantity']+1;
   }
   $_SESSION['cart']['buy'][$id]= array(
        'id'=>$item['id'],
        'product_name'=>$item['product_name'],
        'url'=> "?mod=product&act=detail&id=$id",
        'code'=>$item['code'],
        'price'=>$item['price'],
        'product_thumb'=>$item['product_thumb'],
        'quantity'=>$quantity,
        'subtotal'=>$item['price']*$quantity,
        'url_delete'=>"?mod=cart&act=delete_item&id=$id",
    );
    //cập nhật thông tin giỏ hàng
    update_cart();
}

function update_cart(){
    $num_order=0;
    $total=0;
    foreach($_SESSION['cart']['buy'] as $item){
        $num_order+=$item['quantity'];
        $total+=$item['subtotal'];
    };
    
   $_SESSION['cart']['info'] = array(
        'num_orders'=> $num_order,
        'total'=> $total
   );
}

function delete_item_cart($id){
    if(isset($_SESSION['cart'])){
        if(isset($id)){
            unset($_SESSION['cart']['buy'][$id]);
            update_cart();
        } 
        else {
            unset($_SESSION['cart']);

        }
    }     

}
function delete_all_cart(){
    if(isset($_SESSION['cart'])){    
            unset($_SESSION['cart']);
        }
}     
?>