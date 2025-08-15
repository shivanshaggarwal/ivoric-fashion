 <div class="row g-lg-4 gy-5">
                <div class="col-xl-7 col-lg-8">
                    <div class="enquery-section">
                        <div class="checkout-form-title">
                            <h4>Billing Information</h4>
                        </div>
                        <div class="enquery-form-wrapper style-3">
                            <form action="payment.php" method="post">
                                <input type="hidden" name="u_id" value="<?php echo $user['id']; ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>full name</label>
                                            <input type="text" name="fname" placeholder="First Name" value="<?php if (isset($user['fname'])) {
                                                                                                                echo $user['fname'];
                                                                                                            } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>last name</label>
                                            <input type="text" name="lname" placeholder="Last Name" value="<?php if (isset($user['lname'])) {
                                                                                                                echo $user['lname'];
                                                                                                            } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>email address</label>
                                            <input type="email" name="email" placeholder="Email Address" value="<?php if (isset($user['email'])) {
                                                                                                                    echo $user['email'];
                                                                                                                } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>phone number</label>
                                            <input type="text" name="phone" placeholder="Phone Number" value="<?php if (isset($user['phone'])) {
                                                                                                                    echo $user['phone'];
                                                                                                                } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-30">
                                        <div class="form-inner">
                                            <label>street address<span>*</span></label>
                                            <input type="text" name="address" placeholder="Street Address" value="<?php if (isset($user['address'])) {
                                                                                                                        echo $user['address'];
                                                                                                                    } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>your location <span>*</span></label>
                                            <input type="text" name="city" placeholder="Town/City" value="<?php if (isset($user['city'])) {
                                                                                                                echo $user['city'];
                                                                                                            } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>state<span>*</span></label>
                                            <input type="text" name="state" placeholder="State" value="<?php if (isset($user['state'])) {
                                                                                                            echo $user['state'];
                                                                                                        } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-30">
                                        <div class="form-inner">
                                            <label>postal code <span>*</span></label>
                                            <input type="text" name="pincode" placeholder="Postcode/Zip" value="<?php if (isset($user['pincode'])) {
                                                                                                                    echo $user['pincode'];
                                                                                                                } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-15">
                                        <div class="form-inner">
                                            <label>short notes</label>
                                            <textarea name="note" placeholder="Notes about your order, e.g. special notes for delivery."><?php if (isset($_POST['note'])) {
                                                                                                                                                echo $_POST['note'];
                                                                                                                                            } ?></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-4">
                    <div class="checkout-form-wrapper">
                        <div class="checkout-form-title">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="order-sum-area">
                            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
                                <div class="cart-menu">
                                    <div class="cart-body">
                                        <ul>
                                            <?php
                                            global $total_price;
                                            $total_price = 0;
                                            foreach ($_SESSION['cart'] as $item) {
                                                foreach ($item as $data) {
                                                    $object = json_decode(json_encode($item), FALSE);
                                                    $total_price += $object->product_price;
                                            ?>
                                                    <li class="single-item">
                                                        <div class="item-area">
                                                            <div class="main-item">
                                                                <div class="item-img">
                                                                    <a href="product-details.html"><img src="media/product/<?php echo $object->product_image; ?>" alt=""></a>
                                                                    <div class="close-btn">
                                                                        <i class="bi bi-x"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="content-and-quantity">
                                                                    <div class="content">
                                                                        <h6><a href="product-details.html"><?php echo $object->product_name; ?></a></h6>
                                                                        <span><?php echo $object->product_quantity; ?> X ₹ <?php echo $object->product_actual_price; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="quantity-area">
                                                                <div class="quantity">
                                                                    <a class="quantity__minus"><span><i class="bi bi-dash"></i></span></a>
                                                                    <input name="quantity" type="text" class="quantity__input" value="<?php echo $object->product_quantity; ?>">
                                                                    <a class="quantity__plus"><span><i class="bi bi-plus"></i></span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <input type="hidden" name="product_name[]" value="<?php echo $object->product_name; ?>">
                                                    <input type="hidden" name="product_quantity[]" value="<?php echo $object->product_quantity; ?>">
                                                    <input type="hidden" name="product_price[]" value="<?php echo $object->product_actual_price; ?>">
                                                <?php break;
                                                } ?>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="cart-footer">
                                        <div class="pricing-area mb-40">
                                            <ul>
                                                <li>
                                                    <strong>Sub Total</strong>
                                                    <strong class="price">₹ <?php echo $total_price; ?></strong>
                                                    <input type="hidden" name="subtotal" value="<?php echo $total_price; ?>">
                                                    <input type="hidden" name="final_price" value="<?php echo $total_price; ?>">
                                                </li>
                                                <li>
                                                    <strong>Shipping</strong>
                                                    <div class="order-info">
                                                        <p>Select shipping method</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <strong>Total</strong>
                                                    <strong class="price">₹ <?php echo $total_price; ?></strong>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="payment-method-area">
                                            <h6>Select Payment Method</h6>
                                            <ul class="payment-list">
                                                <li class="cash-delivery active">
                                                    <div class="payment-check">
                                                        <h6>Cash On Delivery</h6>
                                                        <input type="radio" name="shipping_method" id="option_1" checked="" value="cod">
                                                    </div>
                                                    <div class="checked"></div>
                                                </li>
                                                <li class="stripe">
                                                    <div class="payment-check">
                                                        <h6>Direct bank transfer</h6>
                                                        <input type="radio" name="shipping_method" id="option_2" value="online">
                                                    </div>
                                                    <div class="checked"></div>
                                                </li>
                                            </ul>
                                        </div>
                                        <button type="submit" name="place_order" class="primary-btn">
                                            Place Your Order
                                        </button>
                                    </div>
                                </div>
                            <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>