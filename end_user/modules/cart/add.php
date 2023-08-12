<?php
   $id= $_GET["id"];
   add_cart($id);
   redirect('?mod=cart&act=view')
   //show_array($_SESSION['cart']);
?>