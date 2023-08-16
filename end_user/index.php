<?php   
    session_start();
    //Dữ liệu
    require_once 'data/users_data.php';
    require_once 'data/pages.php';
    require_once 'data/product.php';

    //Thư viện hàm
    require_once 'lib/redirect.php';
    require_once 'lib/show_array.php';
    require_once 'lib/users.php';
    require_once 'lib/pages.php';
    require_once 'lib/product.php';
    require_once 'lib/currency_format.php';
    require_once 'lib/cart.php';

    //Du lieu
    require_once 'data/shipping.php';

?>

<?php
$mod=!empty($_GET["mod"])?$_GET["mod"]: 'home';
$act=!empty($_GET["act"])?$_GET["act"]: 'main';
$path_page="./modules/{$mod}/{$act}.php";

//Điều hướng login 
// if((!isset($_SESSION['is_login'])|| $_SESSION['is_login']!==true)&&$mod!='login')
//     redirect('?mod=login&act=login');
if(file_exists($path_page)){
    require_once "$path_page";
} else echo "Sorry,'$path_page' does not exist";
?>
