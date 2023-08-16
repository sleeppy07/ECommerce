<?PHP
require_once 'inc/sidebar.php'
?>
<?php

$id = $_GET['id'];
if (isset($_POST['btn_update'])) {
    $alert=array();
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $brand = $_POST['brand'];
    // $image=$_POST['product_thumb'];
    $desc = $_POST['description'];

    $sql = "UPDATE `products` SET `Name` = '$name', `Price` = '$price', `Quantity` = '$quantity', `Brand` = '$brand', `Description` = '$desc' WHERE `ID` = '$id'";

    if (mysqli_query($conn, $sql)) {
        $alert['update']='Update successfully!';
    } else {
        echo 'Fail' . $sql . "<br>" . mysqli_error($conn);
    }
}


$sql = "SELECT * FROM `products` WHERE `ID` = '$id'";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
//show_array($product);
?>

<div style="margin: auto ;" class="col-sm-12 col-xl-6">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Update product</h6>
        <p style="color: #198754;" > <?php if(isset($alert['update'])) echo $alert['update'] ?></p>
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
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['Name'] ?>">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $product['Quantity'] ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name='price' value="<?php echo $product['Price'] ?>">
            </div>
            <div class="mb-3">
                <label for="price_discount" class="form-label">Discount</label>
                <input type="number" class="form-control" id="price_discount" name='price_discount' value="<?php echo $product['Discount'] ?>">
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $product['Brand'] ?>">
            </div>
            <!-- <div class="mb-3">
                <label for="product_thumb" class="form-label">Product image</label>
                <input type="file" class="form-control" id="product_thumb" name="product_thumb">
            </div> -->
            <div>
                <label for="editor" class="form-label">Product description</label>
                <textarea name="description" id="editor" cols="30" rows="10" value="<?php echo $product['Description'] ?>"></textarea> <br>
                <!-- <input name="submit" type="submit" value="Submit"> -->
            </div>
            <div>
                <button type="submit" class="btn btn-success m-2" name="btn_update">Update </button>
                <button type="submit" class="btn btn-warning m-2" name="btn_cancel">Cancel</button>
            </div>

        </form>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    </div>