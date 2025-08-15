<?php
include('include/connection.php');

if (isset($_POST['place_order'])) {
    // Function to generate order ID
    function generate_order_id($length = 8)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $order_id = '';
        for ($i = 0; $i < $length; $i++) {
            $order_id .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $order_id;
    }

    // Generate order ID
    $order_id = generate_order_id();
    $u_id = $_POST['u_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $note = $_POST['note'];
    $subtotal = $_POST['subtotal'];
    $final_price = $_POST['final_price'];
    $shipping_method = $_POST['shipping_method'];
    $product_names = $_POST['product_name'];
    $product_quantities = $_POST['product_quantity'];
    $product_prices = $_POST['product_price'];

    $sql = "INSERT INTO `orders` (`order_id`, `u_id`, `name`, `address`, `city`, `state`, `pincode`, `email`, `phone`, `note`, `subtotal`, `shipping_method`, `final_price`, `product_name`, `product_quantity`, `product_price`) VALUES ";
    $valueSets = array();
    $productNamesArray = array();
    $productQuantitiesArray = array();
    $productPricesArray = array();

    for ($i = 0; $i < count($product_names); $i++) {
        $product_name = $con->real_escape_string($product_names[$i]);
        $product_quantity = $con->real_escape_string($product_quantities[$i]);
        $product_price = $con->real_escape_string($product_prices[$i]);

        $productNamesArray[] = $product_name;
        $productQuantitiesArray[] = $product_quantity;
        $productPricesArray[] = $product_price;
    }

    $productNamesJson = json_encode($productNamesArray);
    $productQuantitiesJson = json_encode($productQuantitiesArray);
    $productPricesJson = json_encode($productPricesArray);

    $valueSets[] = "('$order_id','$u_id', '$name', '$address', '$city', '$state', '$pincode', '$email', '$phone', '$note', '$subtotal', '$shipping_method', '$final_price', '$productNamesJson', '$productQuantitiesJson', '$productPricesJson')";

    $values = implode(",", $valueSets);

    $sql .= $values;
    echo $sql;
    $result = mysqli_query($con, $sql);
    if ($result) {

        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        echo $shipping_method;
        switch ($shipping_method) {
            case "cod":
                header("Location: thank-you.php");

                //        require_once __DIR__ . '/vendor/autoload.php';

                //         $sqlli = "SELECT * FROM `orders` WHERE `order_id` = '$order_id'";
                //         $ros1 = mysqli_query($con, $sqlli);

                //         if ($ros1) {
                //             $res1 = mysqli_fetch_assoc($ros1);
                //             $name = $res1['fname'] . " " . $res1['lname'];
                //             $email = $res1['email'];
                //             $id = $res1['id'];
                //             $order_id = $res1['order_id'];
                //             $phone = $res1['phone'];
                //             $price = $res1['final_price'];
                //             $note = $res1['note'];
                //             $pincode = $res1['pincode'];
                //             $address = $res1['address'];
                //             $product_name = json_decode($res1['product_name']);
                //             $product_quantity = json_decode($res1['product_quantity']);
                //             $product_price = json_decode($res1['product_price']);

                //             $htmlMessage = "<html><head><title>New COD Order On CP Jwell Real Diamonds</title></head><body><ol>
                // <li><b>Invoice No</b> = COD$id</li>
                // <li><b>Order ID</b> = $order_id</li>
                // <li><b>Name</b> = $name</li>
                // <li><b>Email</b> = $email</li></br>
                // <li><b>Phone</b> = $phone</li></br>
                // <li><b>Address</b> = $address</li></br>
                // <li><b>Pincode</b> = $pincode</li></br>
                // <li><b>Product</b> = <ul>";

                //             for ($i = 0; $i < count($product_name); $i++) {
                //                 $htmlMessage .= "<li>$product_name[$i]</li>";
                //             }

                //             $htmlMessage .= "</ul></li><br>
                // <li><b>Product Quantity</b> = <ul>";

                //             for ($i = 0; $i < count($product_quantity); $i++) {
                //                 $htmlMessage .= "<li>$product_quantity[$i]</li>";
                //             }

                //             $htmlMessage .= "</ul></li><br>
                // <li><b>Product Price</b> = <ul>";

                //             for ($i = 0; $i < count($product_price); $i++) {
                //                 $htmlMessage .= "<li>Rs.$product_price[$i]</li>";
                //             }

                //             $htmlMessage .= "<li><b>Total Price</b> = Rs.$price</li>
                //                     <li><b>note</b> = $note</li>
                //                     </ol></body></html>";

                //             $customerHtmlMessage = "<html><head><title>Your Order on CP Jwell Real Diamonds</title></head><body><p>Dear $name,</p><p>Thank you for placing an order with CP Jwell Real Diamonds. Here are the details of your order:</p>";

                //             $customerHtmlMessage .= "<ul>
                //             <li><b>Invoice No</b>: COD$id</li>
                //             <li><b>Order ID</b>: $order_id</li>
                //             <li><b>Name</b>: $name</li>
                //             <li><b>Email</b>: $email</li>
                //             <li><b>Phone</b>: $phone</li>
                //             <li><b>Address</b>: $address</li>
                //             <li><b>Pincode</b>: $pincode</li>
                //             <li><b>Product</b>: <ul>";

                //             for ($i = 0; $i < count($product_name); $i++) {
                //                 $customerHtmlMessage .= "<li>$product_name[$i] (Quantity: $product_quantity[$i], Price: Rs.$product_price[$i])</li>";
                //             }

                //             $customerHtmlMessage .= "</ul></li>
                //                     <li><b>Total Price</b>: Rs.$price</li>";


                //             $customerHtmlMessage .= "<li><b>note</b>: $note</li>
                //                 </ul></body></html>";




                //             $to = "info@radianbooks.in";
                //             $subject = "New COD Order Received on CP Jwell Real Diamonds";

                //             $headers = "MIME-Version: 1.0\r\n";
                //             $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";
                //             $headers .= "From: info@radianbooks.com\r\n";

                //             $headers .= "Reply-To: info@radianbooks.com\r\n";
                //             $headers .= "X-Mailer: PHP/" . phpversion();

                //             $customerSubject = "Your Order on Radian - Invoice";
                //             $customerHeaders = "MIME-Version: 1.0\r\n";
                //             $customerHeaders .= "Content-Type: text/html; charset=UTF-8\r\n";
                //             $customerHeaders .= "From: info@radianbooks.com\r\n";

                //             $message = "--boundary\r\n";
                //             $message .= "Content-Type: text/html; charset=UTF-8\r\n";
                //             $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
                //             $message .= $htmlMessage . "\r\n";
                //             $message .= "--boundary\r\n";
                //             $message .= "Content-Transfer-Encoding: base64\r\n\r\n";

                //             $mailSuccess = mail($to, $subject, $message, $headers);
                //             if ($mailSuccess) {
                //                 if (mail($email, $customerSubject, $customerHtmlMessage, $customerHeaders)) {
                //                     header("Location: thankyou.php?id=$order_id");
                //                 } else {
                //                     echo "<script>alert('Mail to customer not Sent.')</script>";
                //                 }
                //             } else {
                //                 echo "<script>alert('Mail not Sent.')</script>";
                //                 echo "Error: Unable to send email. Check your server configuration.";
                //             }
                //         } else {
                //             echo "<script>alert('Order Successful. Mail not Sent.')</script>";
                //         }

                break;
            case "online":
                // header("Location: razorpay/index.php?o_id=$order_id");
                header("Location: payment/index.php?o_id=$order_id");
                break;
            default:
                header("Location: index.php");
        }
    } else {
        echo "Invalid request.";
    }
}
