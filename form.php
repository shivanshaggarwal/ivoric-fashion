<?php
include('include/connection.php');

if (isset($_POST['newsletter'])) {
    $email = $_POST['email'];

    $sql = "INSERT INTO `newsletter`(`email`) VALUES ('$email')";
    $res = mysqli_query($con, $sql);
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

if (isset($_POST['contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject1 = $_POST['subject'];
    $message1 = $_POST['message'];

    $sql = "INSERT INTO `contact`(`name`, `email`, `phone`, `subject`, `message`) VALUES ('$name', '$email', '$phone', '$subject1', '$message1')";
    $res = mysqli_query($con, $sql);

    //     $to = "chetanprakashjewels@gmail.com";
    //     $subject = "New Query On CP Real Diamonds Nagpur";

    //     $message = "
    // <html>
    // <head>
    // <title>Enquiry</title>
    // </head>
    // <body>
    // <p>New Query On CP Real Diamonds Nagpur</p>
    // <table>
    // <tr>
    //     <th>Name</th>
    //     <th>Email</th>
    //     <th>Phone</th>
    //     <th>Subject</th>
    //     <th>Message</th>
    // </tr>
    // <tr>
    //     <td>$name</td>
    //     <td>$email</td>
    //     <td>$phone</td>
    //     <td>$subject1</td>
    //     <td>$message</td>
    //     <td>Doe</td>
    // </tr>
    // </table>
    // </body>
    // </html>
    // ";

    // Always set content-type when sending HTML email
    // $headers = "MIME-Version: 1.0" . "\r\n";
    // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    // $headers .= 'From: info@cprealdiamonds.com' . "\r\n";
    // $headers .= 'Cc: myboss@example.com' . "\r\n";

    // $mail = mail($to, $subject, $message, $headers);
    // if ($mail) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    // }
}



// LOGIN
if (isset($_POST['login'])) {
    $contact_info = mysqli_real_escape_string($con, $_POST['contact_info']);
    $password = $_POST['password'];

    // Check if email or phone
    if (filter_var($contact_info, FILTER_VALIDATE_EMAIL)) {
        $where = "`email` = '$contact_info'";
    } else {
        $where = "`phone` = '$contact_info'";
    }

    $sql = "SELECT * FROM `user` WHERE $where LIMIT 1";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['u_id'] = $row['id'];
            $_SESSION['u_email'] = $row['email'];
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid email/phone or password.";
        }
    } else {
        $_SESSION['error'] = "Invalid email/phone or password.";
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}




// REGISTER
if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $tnc = $_POST['tnc'] ?? '';

    $check = mysqli_query($con, "SELECT * FROM `user` WHERE email = '$email' OR phone = '$phone'");
    if (mysqli_num_rows($check) > 0) {
        $_SESSION['error'] = "Email or Mobile No. already registered.";
    } else {
        if ($password1 === $password2) {
            if ($tnc === 'accept') {
                $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                mysqli_query($con, "INSERT INTO `user` (name, phone, email, password, address, tnc, city, state, pincode, status) 
                VALUES ('$name', '$phone', '$email', '$hashedPassword', '$address', 1, '$city', '$state', '$pincode', 1)");
                $_SESSION['success'] = "Registration successful! Please login.";
            } else {
                $_SESSION['error'] = "Please accept the Terms & Conditions.";
            }
        } else {
            $_SESSION['error'] = "Passwords do not match.";
        }
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}
