<?php
function currency($price){
    return number_format($price, '0', ',', '.') . ' Đ';
}
?>