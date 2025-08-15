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
            $update_status_sql = "update subcategory set status='$status' where id='$id'";
            mysqli_query($con, $update_status_sql);
        }

        if ($type == 'delete') {
            $id = get_safe_value($con, $_GET['id']);

             $delete_sql = "DELETE FROM subcategory WHERE id='$id'";
              $result=  mysqli_query($con, $delete_sql);

            if ($result) {
                header('location:all-subcategory.php');
            }

            // $delete_sql = "delete from category where id='$id'";
            // mysqli_query($con, $delete_sql);
        }
    }

    $sql = "select * from `subcategory` ";
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
                                        <h5>All Sub Category</h5>
                                        <form class="d-inline-flex">
                                            <a href="add-subcategory.php" class="align-items-center btn btn-theme d-flex">
                                                <i data-feather="plus-square"></i>Add New
                                            </a>
                                        </form>
                                    </div>

                                    <div class="table-responsive category-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>S. No.</th>
                                                        <th>Category</th>
                                                        <th>Subcategory</th>
                                                        <th>Slug</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                                        <tr>
                                                            <td><?php echo $i++ ?></td>
                                                            <?php
                                                            $category = $row['category'];
                                                            $sql1 = "SELECT * FROM `category` WHERE `status` = '1' AND `id` = '$category'";
                                                            $res1 = mysqli_query($con, $sql1);
                                                            $row1 = mysqli_fetch_assoc($res1);
                                                            ?>
                                                            <td><?php echo $row1['name'] ?></td>

                                                            <td><?php echo $row['name']; ?></td>

                                                            <!-- <td>26-12-2021</td> -->

                                                            <!-- <td>
                                                                <div class="table-image">
                                                                    <?php
                                                                    echo "<a target='_blank' href='" . "../media/category/" . $row['image'] . "'><img width='50px' src='" . "../media/category/" . $row['image'] . "'/></a>";
                                                                    ?>
                                                                </div>
                                                            </td> -->


                                                            <td><?php echo $row['url'] ?></td>

                                                            <td>
                                                                <ul>
                                                                  

                                                                    <li>
                                                                        <a href="add-subcategory.php?id=<?php echo $row['id']; ?>">
                                                                            <i class="ri-pencil-line"></i>
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <a href="?type=delete&id=<?php echo $row['id']; ?>">
                                                                            <i class="ri-delete-bin-line"></i>
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