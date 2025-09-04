<!DOCTYPE html>
<html lang="en">


<head>
    <?php
    include('include/head.php');
    ?>
</head>

<body>

    <?php
    include('include/header.php');

    isLogin();

    // Fetch user data
    $id = $_SESSION['u_id'];
    $userQuery = mysqli_query($con, "SELECT * FROM `user` WHERE `id` = '$id'");
    $user = mysqli_fetch_assoc($userQuery);

    // Update account details
    if (isset($_POST['update_detail'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];

        $sql = "UPDATE `user` SET `name`='$name', `phone`='$phone', `email`='$email', `address`='$address', `city`='$city', `state`='$state', `pincode`='$pincode' WHERE `id` = '$id'";
        $sqli = mysqli_query($con, $sql);
        if ($sqli) {
            header('Location: my-account.php');
            exit;
        }
    }

    // Reset password
    if (isset($_POST['reset_pwd'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $new_pwd = $_POST['new_pwd'];
        $confirm_pwd = $_POST['confirm_pwd'];

        $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            if ($new_pwd === $confirm_pwd) {
                $hashedPassword = password_hash($new_pwd, PASSWORD_DEFAULT);
                $sql1 = "UPDATE `user` SET `password`='$hashedPassword' WHERE `email` = '$email'";
                if (mysqli_query($con, $sql1)) {
                    echo "<script>alert('Password Changed Successfully.')</script>";
                } else {
                    echo "<script>alert('Failed to Change Password.')</script>";
                }
            } else {
                echo "<script>alert('New Password Doesn\'t Match.')</script>";
            }
        } else {
            echo "<script>alert('Email doesn\'t exist.')</script>";
        }
    }

    $id = $_SESSION['u_id']; // make sure this exists and is numeric

    // Optional: Validate ID
    if (!is_numeric($id)) {
        die("Invalid user ID.");
    }

    // Total orders
    $orderQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM `orders` WHERE `u_id` = $id");
    $orderData = mysqli_fetch_assoc($orderQuery);
    $totalOrders = $orderData['total'] ?? 0;


    // Pending orders
    $pendingQuery = mysqli_query($con, "SELECT COUNT(*) AS pending_orders FROM `orders` WHERE `u_id` = '$id' AND `order_status` = 'pending'");
    $pendingData = mysqli_fetch_assoc($pendingQuery);
    $pendingOrders = $pendingData['pending_orders'] ?? 0;

    // Wishlist count
    $wishlistQuery = mysqli_query($con, "SELECT COUNT(*) AS wishlist_count FROM `wishlists` WHERE `user_id` = '$id'");
    $wishlistData = mysqli_fetch_assoc($wishlistQuery);
    $wishlistCount = $wishlistData['wishlist_count'] ?? 0;




    // Replace this with however you're setting the user ID
    $id = $_SESSION['u_id']; // or however your login system works

    // Fetch all orders for this user
    $ordersQuery = mysqli_query($con, "
    SELECT order_id, product_name, final_price, delivery
    FROM orders
    WHERE u_id = '$id'
    ORDER BY created_at DESC
");

    // Store results
    $orders = [];
    if ($ordersQuery && mysqli_num_rows($ordersQuery) > 0) {
        while ($row = mysqli_fetch_assoc($ordersQuery)) {
            $orders[] = $row;
        }
    }
    ?>



    <!-- breadcrumb section strats here -->
    <div class="breadcrumb-section mb-100"
        style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(assets/image/inner-page/breadcrumbs-image5.jpg);">

    </div>
    <!-- breadcrumb section ends here -->

    <!-- My Account Dashboard section strats here -->
    <div class="dashboard-section mb-100">
        <div class="container">
            <div class="row g-lg-4 gy-5">
                <div class="col-lg-3">
                    <div class="dashboard-left">
                        <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link nav-btn-style mx-auto" id="v-pills-profile-tab"
                                data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab"
                                aria-controls="v-pills-profile" aria-selected="true"><i class="fa-solid fa-user" style="font-size: 20px;margin-right: 10px;"></i>
                                My Profile</button>

                            <button class="nav-link nav-btn-style mx-auto" id="v-pills-purchase-tab"
                                data-bs-toggle="pill" data-bs-target="#v-pills-purchase" type="button" role="tab"
                                aria-controls="v-pills-purchase" aria-selected="true">
                                <i class="fa-solid fa-box" style="font-size: 20px;margin-right: 10px;"></i>
                                Order</button>
                            <button class="nav-link nav-btn-style mx-auto" type="button" role="tab"><i class="fas fa-sign-out" style="font-size: 20px;margin-right: 10px;"></i>
                                <a href="logout.php" style="color: black;">Logout</a></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content" id="v-pills-tabContent">
                       

                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <div class="dashboard-profile">
                                <div class="table-title-area">
                                    <h3>Edit Your Profile</h3>
                                    <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                                </div>
                                <div class="form-wrapper">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <input type="text" name="name" placeholder="Enter your name*" value="<?php echo $user['name']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <input type="text" name="phone" placeholder="Enter your contact number" value="<?php echo $user['phone']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-30">
                                                <div class="form-inner">
                                                    <input type="email" name="email" placeholder="Enter your email address*" value="<?php echo $user['email']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-30">
                                                <div class="form-inner">
                                                    <input type="text" name="address" placeholder="Enter your present address" value="<?php echo $user['address']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-30">
                                                <div class="form-inner">
                                                    <input type="text" name="city" placeholder="Enter your city" value="<?php echo $user['city']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <input type="text" name="state" placeholder="Enter your state" value="<?php echo $user['state']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-30">
                                                <div class="form-inner">
                                                    <input type="text" name="pincode" placeholder="Zip Code" value="<?php echo $user['pincode']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-30">
                                                <div class="form-inner">
                                                    <input type="password" name="new_pwd" placeholder="Enter new password (leave blank to keep current)">
                                                    <i class="bi bi-eye-slash" id="togglePassword4"></i>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-30">
                                                <div class="form-inner">
                                                    <input type="password" name="confirm_pwd" placeholder="Confirm new password">
                                                    <i class="bi bi-eye-slash" id="togglePassword5"></i>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="button-group">
                                                    <button type="submit" name="update_detail" class="primary-btn">Update Profile</button>
                                                    <button type="submit" name="reset_pwd" class="primary-btn black-bg">Change Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-purchase" role="tabpanel"
                            aria-labelledby="v-pills-purchase-tab">
                            <!-- table title-->
                            <div class="table-title-area">
                                <h3>My Order</h3>
                            </div>

                            <!-- table -->
                            <div class="table-wrapper">
                                <table class="eg-table order-table table mb-0">
                                    <thead>
                                        <tr>
                                            <!-- <th>Image</th> -->
                                            <th>Order ID</th>
                                            <th>Product Details</th>
                                            <th>price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($orders)): ?>
                                            <?php foreach ($orders as $order): ?>
                                                <tr>
                                                    <td data-label="Order ID">#<?php echo htmlspecialchars($order['order_id']); ?></td>
                                                    <td data-label="Product Details">
                                                        <?php
                                                        $productName = $order['product_name'];

                                                        // Try to decode JSON string to array
                                                        $decoded = json_decode($productName, true);

                                                        // If it's a valid array after decoding, use it
                                                        if (is_array($decoded)) {
                                                            echo htmlspecialchars(implode(', ', $decoded));
                                                        } else {
                                                            echo htmlspecialchars($productName);
                                                        }
                                                        ?>
                                                    </td>


                                                    <td data-label="Price"><?php echo number_format((float)$order['final_price'], 2); ?></td>
                                                    <td data-label="Status" class="<?php echo strtolower($order['delivery']) === 'shipped' ? 'text-green' : 'text-red'; ?>">
                                                        <?php echo ucfirst($order['delivery']); ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No orders found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>



                                </table>
                            </div>

                            <!-- pagination area -->
                            <!-- <div class="table-pagination">
                                <p>Showing 10 to 20 of 1 entries</p>
                                <nav class="shop-pagination">
                                    <ul class="pagination-list">
                                        <li>
                                            <a href="#" class="shop-pagi-btn"><i class="bi bi-chevron-left"></i></a>
                                        </li>
                                        <li>
                                            <a href="#">1</a>
                                        </li>
                                        <li>
                                            <a href="#" class="active">2</a>
                                        </li>
                                        <li>
                                            <a href="#">3</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="bi bi-three-dots"></i></a>
                                        </li>
                                        <li>
                                            <a href="#">6</a>
                                        </li>
                                        <li>
                                            <a href="#" class="shop-pagi-btn"><i class="bi bi-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Account Dashboard section ends here -->


    <?php
    include('include/footer.php');
    ?>
</body>

</html>