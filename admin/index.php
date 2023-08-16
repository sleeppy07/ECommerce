<?php
// Data
require_once 'db/connect.php';
//Hàm
require_once 'lib/show_array.php';
?>
<?php
$mod = !empty($_GET['mod'])? $_GET['mod'] :"home";
$act = !empty($_GET['act'])?$_GET['act']:'main';
$path_page = "./modules/{$mod}/{$act}.php";
if (file_exists($path_page))
    require_once $path_page;
else echo "Sorry, {$path_page} does not exist";
?>