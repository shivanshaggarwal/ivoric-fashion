<!DOCTYPE html>
<html lang="en" dir="ltr">




<head>
    <?php include('include/head_admin.php');

    if (isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($con, $_GET['type']);
        if ($type == 'status') {
            $operation = get_safe_value($con, $_GET['operation']);
            $id = get_safe_value($con, $_GET['id']);
            if ($operation == 'active') {
                $status = '1';
            } else {
                $status = '0';
            }
            $update_status_sql = "update orders set status='$status' where id='$id'";
            mysqli_query($con, $update_status_sql);
        }

        // if ($type == 'delete') {
        //     $id = get_safe_value($con, $_GET['id']);
        //     $select_sql = "SELECT image FROM product WHERE id='$id'";
        //     $result = mysqli_query($con, $select_sql);

        //     if ($result) {
        //         $row = mysqli_fetch_assoc($result);
        //         $filename = $row['image'];

        //         // Step 2: Delete record from the database
        //         $delete_sql = "DELETE FROM product WHERE id='$id'";
        //         mysqli_query($con, $delete_sql);

        //         // Step 3: Unlink the image file from the storage
        //         $uploadsDirectory = '../media/product/';
        //         $filePath = $uploadsDirectory . $filename;

        //         // Check if the file exists before attempting to delete it
        //         if (file_exists($filePath)) {
        //             unlink($filePath); // Delete the file
        //             echo "product and image file deleted successfully";
        //         } else {
        //             echo "Image file not found in the storage";
        //         }
        //     }
        // }
    }

    $sql = "SELECT * FROM `orders` ORDER BY `id` DESC";
    $res = mysqli_query($con, $sql);
    ?>
</head>

<body>
    <!-- tap on top start-->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <?php include('include/header_admin.php'); ?>
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php include('include/sidebar_admin.php'); ?>
            <!-- Page Sidebar Ends-->

            <!-- Order section Start -->
            <div class="page-body">
                <!-- Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>Order List</h5>
                                        <!-- <a href="#" class="btn btn-solid">Download all orders</a> -->
                                    </div>
                                    <div>
                                        <div class="table-responsive">
                                            <table class="table all-package order-table theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <!-- <th>Shipping</th> -->
                                                        <th>Date</th>
                                                        <th>Order ID</th>
                                                        <th>Name</th>
                                                        <th>Product Name</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order Status</th>
                                                        <th>Payment Status</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $ii = 1;
                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                                        <tr  href="#order-details">
                                                            <td><?php echo $ii++ ?></td>
                                                            <!-- <td><a href="manage_shipping.php?o_id=<?php echo $row['order_id']; ?>" class="sb2-2-1-edit"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                            </td> -->
                                                            <td><b><?php echo $row['date'] ?></b></td>
                                                            <td><b><?php echo $row['order_id'] ?></b></td>
                                                            <td><?php echo $row['fname'] . " " . $row['lname'] ?></td>
                                                            <td><?php
                                                                $product_name = json_decode($row['product_name']);
                                                                for ($i = 0; $i < count($product_name); $i++) {
                                                                    echo  "<li>$product_name[$i]</li>";
                                                                } ?></td>
                                                            <td><b>₹ <?php echo $row['final_price'] ?></b></td>
                                                            <td><b><?php echo $row['shipping_method'] ?></b></td>
                                                            <td><?php
                                                                if ($row['order_status'] == 0) {
                                                                    echo "Processing..";
                                                                } else {
                                                                    echo "Complete";
                                                                }
                                                                ?></td>

                                                            <td><?php
                                                                if ($row['transaction_id'] != '') {
                                                                    echo "Paid";
                                                                } else {
                                                                    echo "---";
                                                                }
                                                                ?></td>



                                                            <td>
                                                                <ul>
                                                                    <li>
                                                                        <a href="order-detail.php?o_id=<?php echo $row['order_id']; ?>">
                                                                            <i class="ri-eye-line"></i>
                                                                        </a>
                                                                    </li>

                                                                    <!-- <li>
                                                                    <a href="javascript:void(0)">
                                                                        <i class="ri-pencil-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </a>
                                                                </li> -->
                                                                    <!-- <li>
                                                                        <a class="btn btn-sm btn-solid text-white" href="order-tracking.html">
                                                                            Tracking
                                                                        </a>
                                                                    </li> -->
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table End -->

                <!-- footer start-->
                <?php include('include/footer_admin.php'); ?>
            </div>
            <!-- Order section End -->
        </div>
        <!-- Page Body End-->
    </div>
    <!-- page-wrapper End -->

    <!-- Offcanvas Box Start -->
    <div class="offcanvas offcanvas-end order-offcanvas" tabindex="-1" id="order-details" aria-labelledby="offcanvasExampleLabel" aria-expanded="false">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasExampleLabel">#573-685572</h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <div class="order-date">
                <h6>September 17, 2022 <span class="ms-3">8:12 PM</span></h6>
                <a href="javascript:void(0)" class="d-block mt-1">Cancel Order</a>
            </div>

            <div class="accordion accordion-flush custome-accordion" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Status
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul class="status-list">
                                <li>
                                    <a href="javascript:void(0)">Shipped</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Pending</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion
                            body. Let's imagine this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                            body. Nothing more exciting happening here in terms of content, but just filling up the
                            space to make it look, at least at first glance, a bit more representative of how this would
                            look in a real-world application.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offcanvas Box End -->

    <?php include('include/foot_admin.php'); ?>
</body>


<!-- Mirrored from themes.pixelstrap.com/fastkart/back-end/order-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Apr 2024 05:07:00 GMT -->

</html>