<?php   
    session_start();
    require 'data/users_data.php';
    require 'lib/users.php';
?>

<?php
$mod=!empty($_GET["mod"])?$_GET["mod"]: 'home';
$act=!empty($_GET["act"])?$_GET["act"]: 'main';
$path_page="./modules/{$mod}/{$act}.php";

//Điều hướng login 
// if((!isset($_SESSION['is_login'])|| $_SESSION['is_login']!==true)&&$mod!='login')
//     header('location:?mod=login&act=login');
if(file_exists($path_page)){
    require "$path_page";
} else echo "Sorry,'$path_page' does not exist";
?>
