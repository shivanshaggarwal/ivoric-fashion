<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('include/head.php'); ?>
</head>
<body>
<?php include('include/header.php'); ?>

<!-- breadcrumb section -->
<div class="breadcrumb-section mb-100"
    style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(assets/image/inner-page/breadcrumbs-image5.jpg);">
</div>

<!-- Cart Content -->
<div class="cart-page mb-100">
    <div class="container-lg container-fluid">

        <?php if (!isset($_SESSION['u_id'])): ?>
            <!-- Not logged in -->
            <div class="empty-cart text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png"
                    alt="Empty Cart" style="max-width:150px; margin-bottom:20px;">
                <h4>Your shopping cart is empty.</h4>
                <p>Please log in to view your cart.</p>
                <div class="mt-4 d-flex justify-content-center gap-3">
                    <a href="index.php" class="btn btn-outline-dark px-4 py-2 fw-semibold"
                       style="border-width:2px; border-radius:8px;">
                        <i class="bi bi-arrow-left me-2"></i> Continue Shopping
                    </a>
                    <a href="login.php" class="btn btn-dark px-4 py-2 fw-semibold"
                       style="border-radius:8px;">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Logged in user cart details -->
            <?php
            // Your original cart HTML starts here
            // Shopping Cart Table
            ?>
            <div class="row g-lg-4 gy-5">
                <div class="col-xl-8 col-lg-7">
                    <div class="cart-shopping-wrapper">
                        <div class="cart-widget-title">
                            <h4>My Shopping</h4>
                        </div>
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product Info</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                    $total_price = 0;
                                    foreach ($_SESSION['cart'] as $item) {
                                        foreach ($item as $data) {
                                            $object = json_decode(json_encode($item), FALSE);
                                            $final_price = $object->product_actual_price * $object->product_quantity;
                                            $total_price += $final_price;
                                            ?>
                                            <tr>
                                                <td data-label="Product Info">
                                                    <div class="product-info-wrapper">
                                                        <div class="product-info-img">
                                                            <img src="media/product/<?php echo $object->product_image; ?>" alt="">
                                                        </div>
                                                        <div class="product-info-content">
                                                            <h6><?php echo $object->product_name; ?></h6>
                                                            <p><span>Sku: </span><?php echo $object->product_id; ?></p>
                                                            <div class="quantity-area">
                                                                <div class="quantity">
                                                                    <a class="quantity__minus" onclick="update_quantity('<?php echo $object->product_id; ?>','minus')"><span><i class="bi bi-dash"></i></span></a>
                                                                    <input name="quantity" type="text" class="quantity__input" value="<?php echo $object->product_quantity; ?>">
                                                                    <a class="quantity__plus" onclick="update_quantity('<?php echo $object->product_id; ?>','plus')"><span><i class="bi bi-plus"></i></span></a>
                                                                </div>
                                                            </div>
                                                            <ul>
                                                                <li onclick="remove_item_from_cart('<?php echo $object->product_id; ?>')">remove</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-label="Price"><span>₹<?php echo $object->product_actual_price; ?></span></td>
                                                <td data-label="Total">₹<?php echo $final_price; ?></td>
                                            </tr>
                                            <?php
                                            break;
                                        }
                                    }
                                } else {
                                    echo '<tr><td colspan="3" class="text-center">Your cart is empty</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <a href="index.php" class="details-button">
                            Continue Shopping
                            <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.33624 2.84003L1.17627 10L0 8.82373L7.15914 1.66376H0.849347V0H10V9.15065H8.33624V2.84003Z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="cart-order-sum-area">
                        <div class="cart-widget-title">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="order-summary-wrap">
                            <ul class="order-summary-list">
                                <li>
                                    <strong>Sub Total</strong>
                                    ₹<?php echo isset($total_price) ? $total_price : 0; ?>
                                </li>
                                <li>
                                    <strong>Shipping</strong>
                                    <div class="order-info">
                                        <p>Shipping Free*</p>
                                        <span>Pickup fee ₹10.00</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="coupon-area">
                                        <strong>Coupon Code</strong>
                                        <form>
                                            <div class="form-inner">
                                                <input type="text" placeholder="Your code">
                                                <button type="submit" class="apply-btn">Apply</button>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <strong>Total</strong>
                                    ₹<?php echo isset($total_price) ? $total_price + 10 : 10; ?>
                                </li>
                            </ul>
                            <form action="checkout-page.php" method="post">
                                <input type="hidden" name="price" value="<?php echo isset($total_price) ? $total_price + 10 : 10; ?>">
                                <button type="submit" class="primary-btn mt-40" name="checkout">
                                    PROCESSED CHECKOUT
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include('include/footer.php'); ?>
</body>
</html>