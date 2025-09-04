<!DOCTYPE html>
<html lang="en">


<head>
    <?php
    include('include/head.php');
    ?>

    <?php

    // Get category ID safely
    $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : 0;

    // Sorting
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

    // Pagination
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 9;
    $offset = ($page - 1) * $limit;

    // Base query
    $sql = "SELECT * FROM product WHERE 1";

    // Filter by category
    if ($categoryId > 0) {
        $sql .= " AND category = $categoryId";
    }

    // Sorting
    if ($sort == "latest") {
        $sql .= " ORDER BY id DESC";
    } elseif ($sort == "low-high") {
        $sql .= " ORDER BY discounted_price ASC";
    } elseif ($sort == "high-low") {
        $sql .= " ORDER BY discounted_price DESC";
    } else {
        $sql .= " ORDER BY id DESC";
    }

    // Limit
    $sql .= " LIMIT $limit OFFSET $offset";

    // Run query
    $result = mysqli_query($con, $sql);

    // Count total products (for pagination)
    $countSql = "SELECT COUNT(*) as total FROM product WHERE 1";
    if ($categoryId > 0) {
        $countSql .= " AND category = $categoryId";
    }
    $countResult = mysqli_query($con, $countSql);
    $totalProducts = mysqli_fetch_assoc($countResult)['total'];
    ?>
</head>

<body>

    <?php include('include/header.php'); ?>


    <!-- breadcrumb section strats here -->
    <div class="breadcrumb-section mb-100" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(assets/image/inner-page/breadcrumbs-image2.jpg);">

    </div>
    <!-- breadcrumb section ends here -->
    <!-- product-card section strats here -->
    <div class="product-card-section mb-100">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-12 order-lg-2 order-1">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-12 mb-50">
                                <div class="auction-card-top-area">
                                    <div class="left-content">
                                        <h6>
                                            Showing
                                            <span><?= min($totalProducts, $offset + $limit) ?></span>
                                            of
                                            <span><?= $totalProducts ?></span>
                                            results
                                        </h6>
                                    </div>
                                    <div class="right-content">
                                        <div class="category-area">
                                            <form method="get" id="sortForm">
                                                <input type="hidden" name="category" value="<?= htmlspecialchars($categoryId) ?>">
                                                <select name="sort" onchange="document.getElementById('sortForm').submit()">
                                                    <option value="default" <?= $sort == 'default' ? 'selected' : '' ?>>Sort By</option>
                                                    <option value="latest" <?= $sort == 'latest' ? 'selected' : '' ?>>Latest</option>
                                                    <option value="low-high" <?= $sort == 'low-high' ? 'selected' : '' ?>>Price Low to High</option>
                                                    <option value="high-low" <?= $sort == 'high-low' ? 'selected' : '' ?>>Price High to Low</option>
                                                </select>
                                            </form>
                                        </div>
                                        <ul class="size-icon grid-view d-lg-flex d-none">
                                            <!-- your icons same as before -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Grid -->
                        <div class="list-grid-product-wrap">
                            <div class="row gy-4">
                                <?php if (mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <?php
                                        $images = json_decode($row['image']);
                                        $firstImage = isset($images[0]) ? $images[0] : 'assets/image/home1/product-image.jpg';

                                        // discount %
                                        $discount = (!empty($row['discounted_price']) && $row['base_price'] > 0)
                                            ? round((($row['base_price'] - $row['discounted_price']) / $row['base_price']) * 100)
                                            : 0;
                                        ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 item wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                                            <div class="product-card">
                                                <div class="product-card-img">
                                                    <a href="product-details.php?url=<?= $row['url'] ?>">
                                                        <img src="media/product/<?= $firstImage ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                                                        <div class="batch">
                                                            <?php if ($discount > 0): ?>
                                                                <span class="new"><?= $discount ?>% off</span>
                                                            <?php endif; ?>
                                                            <span>Hot deal</span>
                                                        </div>
                                                    </a>
                                                    <div class="overlay">
                                                        <div class="cart-area">
                                                            <a class="add-cart-btn" href="#" onclick="addtocart('<?= $row['id'] ?>','<?= $row['name'] ?>','<?= $firstImage ?>','<?= $row['discounted_price'] ?>','<?= $row['url'] ?>','<?= $row['base_price'] ?>')">
                                                                <i class="bi bi-bag-check"></i> Add To Cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-card-content">
                                                    <div class="rating">
                                                        <ul>
                                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                    <h6><a class="hover-underline" href="product-details.php?url=<?= $row['url'] ?>"><?= $row['name'] ?></a></h6>
                                                    <p class="price">
                                                        <?php if ($row['discounted_price'] > 0): ?>
                                                            <del>₹<?= $row['base_price'] ?></del> ₹<?= $row['discounted_price'] ?>
                                                        <?php else: ?>
                                                            ₹<?= $row['base_price'] ?>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p>No products found.</p>
                                <?php endif; ?>
                            </div>
                        </div>


                        <!-- Pagination -->
                        <?php if ($totalProducts > $limit): ?>
                            <ul class="pagination">
                                <?php
                                $totalPages = ceil($totalProducts / $limit);
                                for ($i = 1; $i <= $totalPages; $i++):
                                    $active = ($i == $page) ? 'active' : '';
                                ?>
                                    <li class="<?= $active ?>">
                                        <a href="?category=<?= $category ?>&sort=<?= $sort ?>&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product-card section ends here -->

    <?php
    include('include/footer.php');
    ?>
    </script>



</body>


</html>