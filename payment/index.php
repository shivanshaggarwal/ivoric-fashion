// <?php

include('../include/connection.php');
session_start();
if (isset($_GET['o_id'])) {
    $orderId = $_GET['o_id'];
    $sql = "SELECT * FROM `orders` WHERE `order_id` = '$orderId'";
    $res = mysqli_query($con, $sql);
    $res1 = mysqli_fetch_assoc($res);
    $_SESSION['o_id'] = $orderId;

    $name = $res1['fname'] . " " . $res1['lname'];
    $email = $res1['email'];
    // Replace these with your actual PhonePe API credentials

    $merchantId = 'M22EXOXQR7NNZ'; 
    //   $merchantId = 'M2240AKGUJHNB';
    // $apiKey = "ea1e368a-6bc2-4136-94c5-9e26e5965541";
    $apiKey = "ec525605-ae27-4289-aee7-760ad0b88a12";
    $redirectUrl = "https://development.web4vyaparsolutions.in/pplus/payment/payment-success.php?o_id=$orderId";

    // Set transaction details
   $orderId = $_GET['o_id'];
   $name = $res1['fname'] . " " . $res1['lname'];;
   $email = $res1['email'];
    $mobile = $res1['phone'];
    $amount =  $res1['final_price']; // amount in INR
   $description = 'Payment for P-Plus International';


    $paymentData = array(
        'merchantId' => $merchantId,
        'merchantOrderId' => $orderId,
        'merchantTransactionId' => 'MUID' . substr(uniqid(), offset:-6) , // test transactionID
        "merchantUserId" => "MUID123",
        'amount' => $amount * 100,
        'redirectUrl' => $redirectUrl,
        'redirectMode' => "POST",
        'callbackUrl' => $redirectUrl,
        "mobileNumber" => $mobile,
        "message" => $description,
        "email" => $email,
        "shortName" => $name,
        "paymentInstrument" => array(
            "type" => "PAY_PAGE",
        )
    );


   $jsonencode = json_encode($paymentData);
    $payloadMain = base64_encode($jsonencode);
    $salt_index = 2; //key index 1
    $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
    $sha256 = hash("sha256", $payload);
    $final_x_header = $sha256 . '###' . $salt_index;
    $request = json_encode(array('request' => $payloadMain));

   $curl = curl_init();
   curl_setopt_array($curl, [
        // CURLOPT_URL => "https://api-preprod.phonepe.com/apis/hermes/pg/v1/pay",
        CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: " . $final_x_header,
            "accept: application/json"
        ],
    ]);

   echo $response = curl_exec($curl);
   echo $err = curl_error($curl);
    curl_close($curl);

     if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $res = json_decode($response);
        if (isset($res->success) && $res->success) {
            $payUrl = $res->data->instrumentResponse->redirectInfo->url;
            header('Location: ' . $payUrl);
        } else {
            echo "Error processing payment.";
        }
    }
}
