<?php
// print_r($_POST);
include('../include/connection.php');
if (isset($_POST['code']) && !empty($_POST['code']) && $_POST['code'] == "PAYMENT_SUCCESS") {
    echo "Txn Id : " . $_POST['transactionId'] . " Status : " . $_POST['code'];
    $order_id = $_GET['o_id'];
    $transaction_id = $_POST['transactionId'];

    $sql = "UPDATE `orders` SET `transaction_id`='$transaction_id',`payment_status`='1',`order_status`='1' WHERE `order_id` = '$order_id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $sqlli = "SELECT * FROM `orders` WHERE `order_id` = '$order_id'";
        $ros1 = mysqli_query($con, $sqlli);

        if ($ros1) {
            $res1 = mysqli_fetch_assoc($ros1);
            $name = $res1['fname'] . " " . $res1['lname'];
            $email = $res1['email'];
            $id = $res1['id'];
            $order_id = $res1['order_id'];
            $phone = $res1['phone'];
            $price = $res1['final_price'];
            $note = $res1['note'];
            $pincode = $res1['pincode'];
            $address = $res1['address'];
            $transaction_id = $res1['transaction_id'];
            $product_name = json_decode($res1['product_name']);
            $product_quantity = json_decode($res1['product_quantity']);
            $product_price = json_decode($res1['product_price']);

            // Construct the HTML message
            $htmlMessage = "<html><head><title>New Online Order On P-Plus International</title></head><body><ol>
        <li><b>Invoice No</b> = ONLINE$id</li>
        <li><b>Transaction ID</b> = $transaction_id</li>
        <li><b>Order ID</b> = $order_id</li>
        <li><b>Name</b> = $name</li>
        <li><b>Email</b> = $email</li></br>
        <li><b>Phone</b> = $phone</li></br>
        <li><b>Address</b> = $address</li></br>
        <li><b>Pincode</b> = $pincode</li></br>
        <li><b>Product</b> = <ul>";

            for ($i = 0; $i < count($product_name); $i++) {
                $htmlMessage .= "<li>$product_name[$i] - <b>$product_quantity[$i] X $product_price[$i] = ₹ " . ($product_quantity[$i] * $product_price[$i]) . "</b></li>";
            }
         

            $htmlMessage .= "</ul></li><li><b>Total Price</b> = Rs.$price</li>
                            <li><b>note</b> = $note</li>
                            </ol></body></html>";

            $customerHtmlMessage = "<html><head><title>Your Order on P-Plus International</title></head><body><p>Dear $name,</p><p>Thank you for placing an order with P-Plus International. Here are the details of your order:</p>";

            $customerHtmlMessage .= "<ul>
                    <li><b>Invoice No</b>: ONLINE$id</li>
                    <li><b>Transaction ID</b>: $transaction_id</li>
                    <li><b>Order ID</b>: $order_id</li>
                    <li><b>Name</b>: $name</li>
                    <li><b>Email</b>: $email</li>
                    <li><b>Phone</b>: $phone</li>
                    <li><b>Address</b>: $address</li>
                    <li><b>Pincode</b>: $pincode</li>
                    <li><b>Product</b>: <ul>";

            for ($i = 0; $i < count($product_name); $i++) {
                $customerHtmlMessage .= "<li>$product_name[$i] (Quantity: $product_quantity[$i], Price: Rs.$product_price[$i])</li>";
            }

            $customerHtmlMessage .= "</ul></li>
                            <li><b>Total Price</b>: Rs.$price</li>";


            $customerHtmlMessage .= "<li><b>note</b>: $note</li>
                        </ul></body></html>";




            $to = "pplussweetu@gmail.com";
            $subject = "New ONLINE Order Received on P-Plus International";

            // Set up headers
             $headers = "Cc: cpkankriya2008@gmail.com\r\n"; 
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";
            $headers .= "From: info@pplusinternational.in\r\n";

            // Set up additional headers
            $headers .= "Reply-To: info@pplusinternational.in\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            $customerSubject = "Your Order on P-Plus International - Invoice";
            $customerHeaders = "MIME-Version: 1.0\r\n";
            $customerHeaders .= "Content-Type: text/html; charset=UTF-8\r\n";
            $customerHeaders .= "From: pplussweetu@gmail.com\r\n";

            // Construct the multipart message
            $message = "--boundary\r\n";
            $message .= "Content-Type: text/html; charset=UTF-8\r\n";
            $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
            $message .= $htmlMessage . "\r\n";
            $message .= "--boundary\r\n";
            // $message .= "Content-Type: application/pdf\r\n";
            // $message .= "Content-Disposition: attachment; filename=\"invoice.pdf\"\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
            // $message .= chunk_split(base64_encode($pdfContent));

            // Send email
            $mailSuccess = mail($to, $subject, $message, $headers);
            if ($mailSuccess) {
                if (mail($email, $customerSubject, $customerHtmlMessage, $customerHeaders)) {
                    // Redirect to a thank-you page
                    header("Location: ../thank-you.php");
                } else {
                    echo "<script>alert('Mail to customer not Sent.')</script>";
                }
            } else {
                echo "<script>alert('Mail not Sent.')</script>";
                echo "Error: Unable to send email. Check your server configuration.";
            }
        } else {
            echo "<script>alert('Order Successful. Mail not Sent.')</script>";
        }
    } else {
        echo "NOT EXECUTED";
    }
} else {
    echo "Txn Id : " . $_POST['transactionId'] . " Status : " . $_POST['code'];
}
