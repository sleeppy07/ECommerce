<?php

 require_once 'inc/sidebar.php';

?>
<?php
$sql="SELECT*FROM `products`";
$result=mysqli_query($conn,$sql);
$product_list=array();
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)) {
        $product_list[]=$row;
    }
}
foreach($product_list as &$product){
    $product['url_update']="?mod=product&act=update&id={$product['ID']}";
    $product['url_delete']="?mod=product&act=delete&id={$product['ID']}";
}
//show_array($product_list);

?>
<!-- table -->
<div style="margin-left: 250px;" class="col-10">
    <a href="?mod=product&act=add">
        <button type="button" class="btn btn-primary m-2">Add product</button>
    </a>

    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Product List ( <?php echo mysqli_num_rows($result) ?> products )</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <!-- <th scope="col">No</th> -->
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(isset($product_list)){
                            foreach($product_list as $product){
       
                    ?>
                    <tr>
                        <!-- <th scope="row">1</th> -->
                        <!-- <td>John</td> -->
                        <td><?php echo $product['ID'] ?></td>
                        <td><?php echo $product['Image'] ?></td>
                        <td><?php echo $product['Name'] ?></td>
                        <td><?php echo $product['Price'] ?></td>
                        <td><?php echo $product['Discount'] ?></td>
                        <td><?php echo $product['Quantity'] ?></td>
                        <td><?php echo $product['Brand'] ?></td>
                        <td><?php echo $product['Description'] ?></td>
                        <td> <a href="<?php echo $product['url_update'] ?>">Update</a> | <a href="<?php echo $product['url_delete'] ?>"> Delete</a></td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>