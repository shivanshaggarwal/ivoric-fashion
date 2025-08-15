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
            $update_status_sql = "update info_co set status='$status' where id='$id'";
            mysqli_query($con, $update_status_sql);
        }

       
    }

    $sql = "select * from info_co ";
    $res = mysqli_query($con, $sql);
    ?>
</head>

<body>
    <!-- tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <?php include('include/header_admin.php'); ?>
        <!-- Page Header Ends-->

        <!-- Page Body Start -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <?php include('include/sidebar_admin.php'); ?>
            <!-- Page Sidebar Ends-->

            <!-- Container-fluid starts-->
            <div class="page-body">
                <!-- All User Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>Contact</h5>
                                        
                                    </div>

                                    <div class="table-responsive category-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                                        <tr>
                                                            <td><?php echo $row['email'] ?></td>
                                                            <td><?php echo $row['phone'] ?></td>

                                                            <td>
                                                                <ul>

                                                                    <li>
                                                                        <a href="add-contact.php?id=<?php echo $row['id']; ?>">
                                                                            <i class="ri-pencil-line"></i>
                                                                        </a>
                                                                    </li>
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
                <!-- All User Table Ends-->

                <?php include('include/footer_admin.php'); ?>
            </div>
            <!-- Container-fluid end -->
        </div>
        <!-- Page Body End -->

    </div>

    <?php include('include/foot_admin.php'); ?>
</body>



</html>