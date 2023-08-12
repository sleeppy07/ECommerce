<?php
//Hàm lấy lấy dữ liệu page theo tham số id
//Trả về thông tin page tương ứng
function get_page_by_id($id){
    global $list_page;
    if(array_key_exists($id,$list_page))
        return $list_page[$id];
    else return false;
}
?>