<?php
require_once 'inc/sidebar.php';
?>
<?php
$alert=array();
if(isset($_POST['btn_save'])){
$name=$_POST['product_name'];
$price=$_POST['price'];
$quantity=$_POST['quantity'];
$brand=$_POST['brand'];
// $image=$_POST['product_thumb'];
$desc=$_POST['description'];

$sql= "INSERT INTO `products` (`Name`,	`Quantity`, `Price`,	`Brand`,	`Description`)"
        ." VALUES ('$name','$quantity','$price','$brand','$desc')";

if(mysqli_query($conn,$sql)){
    $alert['add']= 'Add product successfully';
} else{
    echo 'Fail'.$sql."<br>".mysqli_error($conn);
}}
?>
<div style="margin: auto ;" class="col-sm-12 col-xl-6">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Add product</h6>
        <p style="color: #198754" > <?php if(isset($alert['add'])) echo $alert['add'] ?></p>
        <form enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="category" class="form-label">Select category</label>
                <select class="form-control" name="category" id="category">
                    <option value="Iphone">Mobile</option>
                    <option value="Samsung">Laptop</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="product_name" class="form-label">Product name</label>
                <input type="text" class="form-control" id="product_name" name="product_name">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name='price'>
            </div>
            <div class="mb-3">
                <label for="price_discount" class="form-label">Discount</label>
                <input type="number" class="form-control" id="price_discount" name='price_discount'>
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand">
            </div>
            <!-- <div class="mb-3">
                <label for="product_thumb" class="form-label">Product image</label>
                <input type="file" class="form-control" id="product_thumb" name="product_thumb">
            </div> -->
            <div>
                <label for="editor" class="form-label">Product description</label>
                <textarea name="description" id="editor" cols="30" rows="10"></textarea> <br>
                <!-- <input name="submit" type="submit" value="Submit"> -->
            </div>
            <div>
            <button type="submit" class="btn btn-success m-2" name="btn_save">Save </button>
            <button type="submit" class="btn btn-warning m-2" name="btn_cancel" >Cancel</button>
            </div>
            
        </form>
        <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    </div>