<?php
require 'inc/header.php';
?>
<?php
$page_id = (int) $_GET['id'];
// echo $page_id;
$item = get_page_by_id($page_id);
// show_array($item)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style="margin: 0px 180px">
        <h1> <?php echo $item['page_title'] ?></h1>
        <h10><?php echo $item['created_time'] ?> </h10>
        <h6><?php echo $item['content'] ?></h6>
    </div>
</body>

</html>