<?php
unset($_SESSION['is_login']);
unset($_SESSION['user_login']);
redirect('?mod=login&act=login');
?>