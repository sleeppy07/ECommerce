<?php
$dele= (int) $_GET['id'];
delete_item_cart($dele);
redirect('?mod=cart&act=view')
?>