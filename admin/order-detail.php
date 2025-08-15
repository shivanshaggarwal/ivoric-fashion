<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <?php include('include/head_admin.php');
    $o_id = $_GET['o_id'];

    if (isset($_POST['update_order'])) {
        $o_id = isset($_GET['o_id']) ? $_GET['o_id'] : null;
        $payment_status = isset($_POST['payment_status']) ? 1 : 0;

        $order_status = isset($_POST['order_status']) ? 1 : 0;
        $delivery = isset($_POST['delivery']) ? 1 : 0;

        $update_status_sql = "UPDATE `orders` SET `payment_status`='$payment_status', `order_status`='$order_status', `delivery`='$delivery' WHERE `order_id`='$o_id'";
        mysqli_query($con, $update_status_sql);

        header('location:all-orders.php');
        exit();
    }

    $o_id = isset($_GET['o_id']) ? $_GET['o_id'] : null;
    $sql = "SELECT * FROM `orders` WHERE `order_id` = '$o_id' ";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    ?>
</head>

<body>
    <!-- tap on top start -->
    <div class="tap-top">
        <i data-feather="chevrons-up"></i>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <?php include('include/header_admin.php'); ?>
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php include('include/sidebar_admin.php'); ?>
            <!-- Page Sidebar Ends-->

            <!-- tracking section start -->
            <div class="page-body">
                <!-- tracking table start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header title-header-block package-card">
                                        <div>
                                            <h5>Order #<?php echo $row['order_id']; ?></h5>
                                        </div>
                                        <div class="card-order-section">
                                            <ul>
                                                <li><?php echo $row['date']; ?></li>
                                                <!-- <li>6 items</li> -->
                                                <li>Total ₹ <?php echo $row['final_price'] ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bg-inner cart-section order-details-table">
                                        <div class="row g-4">
                                            <div class="col-xl-8">
                                                <div class="table-responsive table-details">
                                                    <table class="table cart-table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">Items</th>
                                                                <!-- <th class="text-end" colspan="2">
                                                                    <a href="javascript:void(0)" class="theme-color">Edit
                                                                        Items</a>
                                                                </th> -->
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                            $product_name = json_decode($row['product_name']);
                                                            $product_quantity = json_decode($row['product_quantity']);
                                                            $product_price = json_decode($row['product_price']);

                                                            for ($i = 0; $i < count($product_name); $i++) {
                                                            ?>
                                                                <tr class="table-order">
                                                                    <!-- <td>
                                                                        <a href="javascript:void(0)">
                                                                            <img src="assets/images/profile/1.jpg" class="img-fluid blur-up lazyload" alt="">
                                                                        </a>
                                                                    </td> -->
                                                                    <td>
                                                                        <p>Product Name</p>
                                                                        <h5><?= $product_name[$i] ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <p>Quantity</p>
                                                                        <h5><?= $product_quantity[$i] ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <p>Price</p>
                                                                        <h5>₹ <?= $product_price[$i] ?></h5>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>

                                                        <tfoot>
                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h5>Subtotal :</h5>
                                                                </td>
                                                                <td>
                                                                    <h4>₹ <?php echo $row['subtotal'] ?></h4>
                                                                </td>
                                                            </tr>

                                                            <!-- <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h5>Shipping :</h5>
                                                                </td>
                                                                <td>
                                                                    <h4>$12.00</h4>
                                                                </td>
                                                            </tr> -->

                                                            <!-- <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h5>Tax(GST) :</h5>
                                                                </td>
                                                                <td>
                                                                    <h4>$10.00</h4>
                                                                </td>
                                                            </tr> -->

                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h4 class="theme-color fw-bold">Total Price :</h4>
                                                                </td>
                                                                <td>
                                                                    <h4 class="theme-color fw-bold">₹ <?php echo $row['final_price'] ?></h4>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <form method="post">
                                                    <div class="row align-items-center">
                                                        <label class="col-sm-3 col-form-label form-label-title">Payment Paid</label>
                                                        <div class="col-sm-9">
                                                            <label class="switch">
                                                                <input type="checkbox" name="payment_status" value="<?php if ($row['payment_status'] == '1') {
                                                                                                                        echo '1';
                                                                                                                    } else {
                                                                                                                        echo '0';
                                                                                                                    } ?>" <?php if ($row['payment_status'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            } else {
                                                                                                                                echo '';
                                                                                                                            } ?>><span class="switch-state"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <label class="col-sm-3 col-form-label form-label-title">Order Complete</label>
                                                        <div class="col-sm-9">
                                                            <label class="switch">
                                                                <input type="checkbox" name="order_status" value="<?php if ($row['order_status'] == '1') {
                                                                                                                        echo '1';
                                                                                                                    } else {
                                                                                                                        echo '0';
                                                                                                                    } ?>" <?php if ($row['order_status'] == '1') {
                                                                                                                                echo 'checked';
                                                                                                                            } else {
                                                                                                                                echo '';
                                                                                                                            } ?>><span class="switch-state"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <label class="col-sm-3 col-form-label form-label-title"> <label for="delivery"> Delivery</label><br>
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <label class="switch">
                                                                <input type="checkbox" name="delivery" value="<?php if ($row['delivery'] == '1') {
                                                                                                                    echo '1';
                                                                                                                } else {
                                                                                                                    echo '0';
                                                                                                                } ?>" <?php if ($row['delivery'] == '1') {
                                                                                                                            echo 'checked';
                                                                                                                        } else {
                                                                                                                            echo '';
                                                                                                                        } ?>><span class="switch-state"></span>
                                                            </label>
                                                        </div>
                                                    </div>



                                                    <button class="btn btn-solid" name="update_order" type="submit">Update</button>
                                                    <a href="orders-all.php" class="waves-effect waves-light btn-large">Back</a>
                                                </form>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="order-success">
                                                    <div class="row g-4">
                                                        <h4>Personal Details</h4>
                                                        <ul class="order-details">
                                                            <li>Name: <?php echo $row['fname'] . " " . $row['lname'] ?></li>
                                                            <li>Email: <?php echo $row['email'] ?></li>
                                                            <li>Mobile No.: <?php echo $row['phone'] ?></li>
                                                        </ul>
                                                        <h4>summery</h4>
                                                        <ul class="order-details">
                                                            <li>Order ID: <?php echo $row['order_id']; ?></li>
                                                            <li>Order Date: <?php echo $row['date']; ?></li>
                                                            <li>Order Total: ₹ <?php echo $row['final_price'] ?></li>
                                                        </ul>

                                                        <h4>shipping address</h4>
                                                        <ul class="order-details">
                                                            <li><?php echo $row['address'] . ", " . $row['city'] ?></li>
                                                            <li><?php echo $row['state']  ?></li>
                                                            <li><?php echo $row['pincode'] ?></li>
                                                        </ul>

                                                        <div class="payment-mode">
                                                            <h4>Shipping method</h4>
                                                            <p><?php echo $row['shipping_method'] ?></p>
                                                        </div>

                                                        <!-- <div class="delivery-sec">
                                                            <h3>expected date of delivery: <span>october 22, 2018</span>
                                                            </h3>
                                                            <a href="order-tracking.html">track order</a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- section end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tracking table end -->

                <?php include('include/footer_admin.php'); ?>
            </div>
            <!-- tracking section End -->
        </div>
    </div>
    <!-- page-wrapper End -->



    <?php include('include/foot_admin.php'); ?>
</body>


<!-- Mirrored from themes.pixelstrap.com/fastkart/back-end/order-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Apr 2024 05:07:06 GMT -->

</html>