<?php

include('include/connection.php');

if (isset($_POST['add_to_wishlist'])) {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $row = mysqli_query($con, "SELECT * FROM `wishlists` where user_id = $user_id and product_id = $product_id" );
    if(mysqli_num_rows($row) > 0){
        
         echo "Product Already Exists.";
    }
    else{
        
   
    $result = mysqli_query($con, "INSERT INTO `wishlists`(`user_id`, `product_id`) VALUES ('$user_id', '$product_id')");
    if ($result) {
        echo "Added To Wishlist";
    } else {
        echo "Try again";
    }
    }
}
if (isset($_POST['delete_wishlist_item'])) {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $sql = "DELETE FROM `wishlists` WHERE `user_id`='$user_id' AND `product_id`='$product_id' limit 1";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "Product deleted successfully";
    } else {
        echo "Somethin went wrong ! Try Again Please";
    }
}

if (isset($_POST['add_to_cart'])) {
    // session_start();

    $cart = $_SESSION['cart'][] = array();
    $product_name = $_POST['product_name'];
    $url = $_POST['url'];
    $product_baseprice = $_POST['product_baseprice'];
    $product_image = $_POST['product_image'];
    $product_price = intval($_POST['product_price']);
    $product_id = $_POST['product_id'];
    $product_quantity = intval($_POST['product_quantity']);

    // Check if the item is already in the cart
    if (isset($_SESSION['cart'][$product_id])  && count($_SESSION['cart'][$product_id]) > 0) {
        // If it is, increment the quantity
        $_SESSION['cart'][$product_id]['product_quantity'] += $product_quantity;
        $_SESSION['cart'][$product_id]['product_price'] = $_SESSION['cart'][$product_id]['product_price'] + $product_price * $product_quantity;
        print_r("Product Value Increase Successfully");
    } else {
        // If it isn't, add it to the cart with a quantity of 1
        $_SESSION['cart'][$product_id] = array(
            'url' => $url,
            'product_baseprice' => $product_baseprice,
            'product_id' => $product_id,
            'product_quantity' => $product_quantity,
            'product_price' => $product_price * $product_quantity,
            'product_name' => $product_name,
            'product_actual_price' => $product_price,
            'product_image' => $product_image,
        );
        print_r("Product Added To cart Successfully");
    }
    
}

if (isset($_POST['remove_item_from_cart'])) {
    session_start();

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    // print_r(count($_SESSION['cart']));
    // Check if the item is in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // If it is, remove it from the cart
        unset($_SESSION['cart'][$product_id]);
    }
}

if(isset($_POST['search_book'])) {
    $str = mysqli_real_escape_string($con,$_POST['search_book']);
    $sql = "SELECT * FROM `product` where `name` like '%$str%' ";
    $res = mysqli_query($con, $sql);
    $data2 = array();
    $htmldiv = '';


    while($row = mysqli_fetch_assoc($res)){
        array_push($data2, $row);
    }
    echo json_encode($data2);
   
}
if(isset($_POST['search_book1'])) {
    $str = mysqli_real_escape_string($con,$_POST['search_book1']);
    $sql = "SELECT * FROM `product` where `name` like '%$str%' ";
    $res = mysqli_query($con, $sql);
    $data2 = array();
    $htmldiv = '';


    while($row = mysqli_fetch_assoc($res)){
        array_push($data2, $row);
    }
    echo json_encode($data2);
   
}