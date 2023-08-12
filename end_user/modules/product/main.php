<?php
    require 'inc/header.php';
?>
<?php
//lấy id
$cat_id= (int) $_GET["cat_id"];
// gọi hàm 
$cate=get_product_cat_by_id($cat_id);
//gọi hàm ư
$list_item=get_product_by_id($cat_id);
//show_array($list_item);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body style="margin: 0 150px">

    <h2> <?php echo $cate['cat_title'] ?></h2>
    <p> Có <?php echo count($list_item) ?> sản phẩm </p>
    <div class="section_detail">
        <ul style="display: flex; flex-wrap:wrap"  class='item_list' >
        <?php foreach ($list_item as $item){
            ?>
            <li style="width:200px; margin-right:30px" class="item" >
                <a href="<?php echo $item['url'] ?>">
                    <img style="height: 200px;" src="<?php echo $item['product_thumb'] ?>" alt="">
                </a>
                <a href="<?php echo $item['url'] ?>"> <?php echo $item['product_name'] ?></a>
                <p> <?php echo number_format($item['price'],'0',',','.').' Đ' ?></p>
            </li>
        <?php } ?>
        </ul>
    </div>
</body>
</html>
