<?php
include('include/connection.php');

// -------------------- WISHLIST --------------------
if (isset($_POST['add_to_wishlist'])) {
    $user_id = intval($_POST['user_id']);
    $product_id = intval($_POST['product_id']);

    $row = mysqli_query($con, "SELECT * FROM `wishlists` WHERE user_id='$user_id' AND product_id='$product_id'");
    if (mysqli_num_rows($row) > 0) {
        // compute wishlist count
        $cntRes = mysqli_query($con, "SELECT COUNT(*) as c FROM `wishlists` WHERE user_id='$user_id'");
        $cntRow = mysqli_fetch_assoc($cntRes);
        $wishlist_count = intval($cntRow['c'] ?? 0);

        echo json_encode(["status" => "info", "msg" => "Product already exists in wishlist", "wishlist_count" => $wishlist_count]);
    } else {
        $result = mysqli_query($con, "INSERT INTO `wishlists`(`user_id`, `product_id`) VALUES ('$user_id', '$product_id')");

        // compute wishlist count after insert
        $cntRes = mysqli_query($con, "SELECT COUNT(*) as c FROM `wishlists` WHERE user_id='$user_id'");
        $cntRow = mysqli_fetch_assoc($cntRes);
        $wishlist_count = intval($cntRow['c'] ?? 0);

        echo json_encode(["status" => $result ? "success" : "error", "msg" => $result ? "Added to wishlist" : "Try again", "wishlist_count" => $wishlist_count]);
    }
    exit;
}

if (isset($_POST['delete_wishlist_item'])) {
    $user_id = intval($_POST['user_id']);
    $product_id = intval($_POST['product_id']);

    $sql = "DELETE FROM `wishlists` WHERE `user_id`='$user_id' AND `product_id`='$product_id' LIMIT 1";
    $result = mysqli_query($con, $sql);

    // compute wishlist count after delete
    $cntRes = mysqli_query($con, "SELECT COUNT(*) as c FROM `wishlists` WHERE user_id='$user_id'");
    $cntRow = mysqli_fetch_assoc($cntRes);
    $wishlist_count = intval($cntRow['c'] ?? 0);

    echo json_encode(["status" => $result ? "success" : "error", "msg" => $result ? "Removed from wishlist" : "Something went wrong", "wishlist_count" => $wishlist_count]);
    exit;
}

// -------------------- CART --------------------
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_image = $_POST['product_image'];
    $product_price = intval($_POST['product_price']);
    $url = $_POST['url'];
    $product_baseprice = $_POST['product_baseprice'];
    $product_quantity = intval($_POST['product_quantity']);
    $product_size = $_POST['product_size'] ?? "FreeSize";

    // If same product + same size exists → increase quantity
    $key = $product_id;  // Remove size from key


    if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['product_quantity'] += $product_quantity;
        $resultStatus = "success";
        $resultMsg = "Quantity updated successfully";
    } else {
        $_SESSION['cart'][$key] = [
            'url' => $url,
            'product_baseprice' => $product_baseprice,
            'product_id' => $product_id,
            'product_quantity' => $product_quantity,
            'product_price' => $product_price,
            'product_name' => $product_name,
            'product_actual_price' => $product_price,
            'product_image' => $product_image,
            'product_size' => $product_size
        ];

        $resultStatus = "success";
        $resultMsg = "Product added to cart";
    }

    // compute cart count
    $cart_count = 0;
    if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $cart_count += isset($item['product_quantity']) ? intval($item['product_quantity']) : 0;
        }
    }

    echo json_encode(["status" => $resultStatus, "msg" => $resultMsg, "cart_count" => $cart_count]);
    exit;
}

if (isset($_POST['remove_item_from_cart'])) {
    $product_id = $_POST['product_id'];
    $key = $product_id; // Only using product_id now

    error_log("Trying to remove: $key");
    error_log("Cart keys: " . implode(", ", array_keys($_SESSION['cart'])));

    if (isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]);
        $result = true;
    } else {
        $result = false;
    }

    // compute cart count after removal
    $cart_count = 0;
    if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $cart_count += isset($item['product_quantity']) ? intval($item['product_quantity']) : 0;
        }
    }

    echo json_encode(["status" => $result ? "success" : "error", "msg" => $result ? "Product removed from cart" : "Product not found", "cart_count" => $cart_count]);
    exit;
}

// -------------------- UPDATE CART QUANTITY --------------------
if (isset($_POST['update_cart_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['quantity']);
    $key = $product_id; // Only using product_id now

    if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['product_quantity'] = $quantity;
        
        // compute cart count
        $cart_count = 0;
        if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $cart_count += isset($item['product_quantity']) ? intval($item['product_quantity']) : 0;
            }
        }
        
        echo json_encode(["status" => "success", "msg" => "Quantity updated", "cart_count" => $cart_count]);
    } else {
        echo json_encode(["status" => "error", "msg" => "Product not found in cart"]);
    }
    exit;
}

// -------------------- BUY NOW --------------------
if (isset($_POST['buy_now'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_image = $_POST['product_image'];
    $product_price = intval($_POST['product_price']);
    $url = $_POST['url'];
    $product_baseprice = $_POST['product_baseprice'];
    $product_quantity = intval($_POST['product_quantity']);
    $product_size = $_POST['product_size'] ?? "FreeSize";

    // Clear existing cart for buy now flow
    $_SESSION['cart'] = [];

    // Add the single product to cart
    $key = $product_id;  // Remove size from key

    $_SESSION['cart'][$key] = [
        'url' => $url,
        'product_baseprice' => $product_baseprice,
        'product_id' => $product_id,
        'product_quantity' => $product_quantity,
        'product_price' => $product_price,
        'product_name' => $product_name,
        'product_actual_price' => $product_price,
        'product_image' => $product_image,
        'product_size' => $product_size
    ];

    // compute cart count
    $cart_count = 0;
    if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $cart_count += isset($item['product_quantity']) ? intval($item['product_quantity']) : 0;
        }
    }

    echo json_encode(["status" => "success", "msg" => "Product added for checkout", "redirect" => "checkout-page.php", "cart_count" => $cart_count]);
    exit;
}

// New: return cart count on demand
if (isset($_POST['get_cart_count'])) {
    $cart_count = 0;
    if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $cart_count += isset($item['product_quantity']) ? intval($item['product_quantity']) : 0;
        }
    }
    echo json_encode(["status" => "success", "cart_count" => $cart_count]);
    exit;
}

// New: return wishlist count on demand
if (isset($_POST['get_wishlist_count'])) {
    $wishlist_count = 0;
    if (!empty($_SESSION['u_id'])) {
        $user_id = intval($_SESSION['u_id']);
        $cntRes = mysqli_query($con, "SELECT COUNT(*) as c FROM `wishlists` WHERE user_id='$user_id'");
        $cntRow = mysqli_fetch_assoc($cntRes);
        $wishlist_count = intval($cntRow['c'] ?? 0);
    }
    echo json_encode(["status" => "success", "wishlist_count" => $wishlist_count]);
    exit;
}

// -------------------- SEARCH --------------------
// if (isset($_POST['search_book'])) {
//     $str = mysqli_real_escape_string($con, $_POST['search_book']);
//     $sql = "SELECT * FROM `product` WHERE `name` LIKE '%$str%'";
//     $res = mysqli_query($con, $sql);

//     $data = [];
//     while ($row = mysqli_fetch_assoc($res)) {
//         $data[] = $row;
//     }
//     echo json_encode($data);
//     exit;
// }

// if (isset($_POST['search_book1'])) {
//     $str = mysqli_real_escape_string($con, $_POST['search_book1']);
//     $sql = "SELECT * FROM `product` WHERE `name` LIKE '%$str%'";
//     $res = mysqli_query($con, $sql);

//     $data = [];
//     while ($row = mysqli_fetch_assoc($res)) {
//         $data[] = $row;
//     }
//     echo json_encode($data);
//     exit;
// }
