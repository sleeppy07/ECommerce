<?php
require 'data/users_data.php';
function check_login($username,$password){
    global $users_list;
    foreach($users_list as $user){
        if(($user['username']==$username) &&$user['password']==$password)
        return true;
    } 
    return false;
}

?>