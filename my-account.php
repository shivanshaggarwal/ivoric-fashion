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
    $totalOrders = $orderData['total_orders'] ?? 0;

    // Pending orders
    $pendingQuery = mysqli_query($con, "SELECT COUNT(*) AS pending_orders FROM `orders` WHERE `u_id` = '$id' AND `order_status` = 'pending'");
    $pendingData = mysqli_fetch_assoc($pendingQuery);
    $pendingOrders = $pendingData['pending_orders'] ?? 0;

    // Wishlist count
    $wishlistQuery = mysqli_query($con, "SELECT COUNT(*) AS wishlist_count FROM `wishlists` WHERE `user_id` = '$id'");
    $wishlistData = mysqli_fetch_assoc($wishlistQuery);
    $wishlistCount = $wishlistData['wishlist_count'] ?? 0;

    $orderLimit = 5; // default limit

    if (isset($_GET['order_limit'])) {
        $limit = intval($_GET['order_limit']);
        if (in_array($limit, [3, 5, 15, 20])) {
            $orderLimit = $limit;
        }
    }

    $ordersQuery = mysqli_query($con, "SELECT * FROM `orders` WHERE `u_id` = '$id' ORDER BY `created_at` DESC LIMIT $orderLimit");
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
                            <button class="nav-link active nav-btn-style mx-auto" id="v-pills-dashboard-tab"
                                data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab"
                                aria-controls="v-pills-dashboard" aria-selected="true">
                                <i class="fas fa-chart-bar" style="font-size: 20px;margin-right: 10px;"></i>
                                Dashboard</button>
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
                        <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel"
                            aria-labelledby="v-pills-dashboard-tab">
                            <div class="dashboard-area">
                                <h6>Hello, <strong><?php echo htmlspecialchars($user['name']); ?>!</strong></h6>

                                <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                                <div class="row g-4 mt-30">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="dashboard-card">
                                            <div class="header">
                                                <h5>Total Order</h5>
                                            </div>
                                            <div class="body">
                                                <div class="counter-item">
                                                    <h2 class="counter"><?php echo $totalOrders; ?></h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa-solid fa-thumbs-up" style="font-size: 50px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="dashboard-card">
                                            <div class="header">
                                                <h5>Pending Orders</h5>
                                            </div>
                                            <div class="body">
                                                <div class="counter-item">
                                                    <h2 class="counter"><?php echo $pendingOrders; ?></h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa-solid fa-clock" style="font-size: 50px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="dashboard-card">
                                            <div class="header">
                                                <h5>Wishlist</h5>
                                            </div>
                                            <div class="body">
                                                <div class="counter-item">
                                                    <h2 class="counter"><?php echo $wishlistCount; ?></h2>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa-solid fa-heart" style="font-size: 50px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
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
                                <form method="GET" id="order-limit-form">
                                    <input type="hidden" name="tab" value="purchase">
                                    <select name="order_limit" onchange="document.getElementById('order-limit-form').submit()">
                                        <option value="5" <?php if ($orderLimit == 5) echo 'selected'; ?>>Show: Last 05 Orders</option>
                                        <option value="3" <?php if ($orderLimit == 3) echo 'selected'; ?>>Show: Last 03 Orders</option>
                                        <option value="15" <?php if ($orderLimit == 15) echo 'selected'; ?>>Show: Last 15 Orders</option>
                                        <option value="20" <?php if ($orderLimit == 20) echo 'selected'; ?>>Show: Last 20 Orders</option>
                                    </select>
                                </form>

                            </div>

                            <!-- table -->
                            <div class="table-wrapper">
                                <table class="eg-table order-table table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
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
                                                    <td data-label="Image">
                                                        <img src="<?php echo htmlspecialchars($order['product_image']); ?>" alt="" style="width: 60px;">
                                                    </td>
                                                    <td data-label="Order ID">#<?php echo htmlspecialchars($order['order_id']); ?></td>
                                                    <td data-label="Product Details"><?php echo htmlspecialchars($order['product_name']); ?></td>
                                                    <td data-label="price">$<?php echo number_format($order['price'], 2); ?></td>
                                                    <td data-label="Status" class="<?php echo strtolower($order['status']) === 'shipped' ? 'text-green' : 'text-red'; ?>">
                                                        <?php echo ucfirst($order['status']); ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No orders found.</td>
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