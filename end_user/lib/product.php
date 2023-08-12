<?php
//Hàm lấy dữ liệu cate product qua id
function get_product_cat_by_id($id_cat){
    global $list_product_cat;
    if(array_key_exists($id_cat,$list_product_cat))
        return $list_product_cat[$id_cat];
}

//Hàm lấy dữ liệu product qua id_cat
function get_product_by_id($id_cat){
    global $list_product;
    $list_item=array();
    foreach($list_product as $item){
        if($item['id_cat']==$id_cat){
            $item['url']="?mod=product&act=detail&&id=".$item['id'];
            $list_item[]=$item;
        }
    }
    return $list_item;
}

//Hàm lấy chi tiết sản phẩm qua id
function get_product_detail($id){
    global $list_product;
    if(array_key_exists($id,$list_product))
        return $list_product[$id];
    return false;
}

?>

