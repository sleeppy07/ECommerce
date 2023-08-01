<?php
if(isset($_POST['btn-login'])){
    $error=array();
    $data=array(
        'username'=>'admin_01',
        'password'=>'@Admin123'
    );
    //Xử lý để trống usename
    if(empty($_POST['username'])){
        $error['username']='Please enter the username';
    } else{
         $username= $_POST['username'];
    }
    //Xử lý để trống
    if(empty($_POST['password'])){
        $error['password']='Please enter the password';
    } else{
        $password=$_POST['password'];
    }

    if(empty($error)){
        if(check_login($username,$password)){
            $_SESSION['is_login']=true;
            $_SESSION['user_login']=$username;
            header('Location:?page=dashboard');
        } else {
            $error['login']='Username or password incorrect';
        } 
   
}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="wp-login" >
        <form action="" method="post">
            <h1 class="login-title" >Login</h1>
            <div class="error-login" > <?php if(!empty($error['login'])) echo $error['login'] ?> </div > <br>
            <input class="input-login" type="text" name="username" placeholder="Username"> <br>
            <div class="error-login" > <?php if(!empty($error['username'])) echo $error['username'] ?> </div > <br>
            <input class="input-login"  type="password" name="password" placeholder="Password">  <br>
            <div class="error-login" > <?php if(!empty($error['password'])) echo $error['password']?> </div > <br>
            <input style="width: 310px;" class="input-login btn-info" type="submit" value="Login" name="btn-login"  > <br>
            <a class="none-text-decoration" href="">Forgot password?</a>
        </form>
    </div>
</body>
</html>