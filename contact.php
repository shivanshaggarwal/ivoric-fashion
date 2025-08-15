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
?>
    <!-- breadcrumb section strats here -->
    <div class="breadcrumb-section mb-100"
        style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(assets/image/inner-page/breadcrumbs-image.jpg);">
       
    </div>
    <!-- breadcrumb section ends here -->

   

    <!-- Enquiry section Start here -->
    <div class="enquery-section mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="enquery-form-wrapper style-2">
                        <form action="form.php" method="post" >
                            <div class="form-title">
                                <h4>reach us anytime</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-30">
                                    <div class="form-inner">
                                        <label>first name <span>*</span></label>
                                        <input type="text" placeholder="Mr. Daniel">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-30">
                                    <div class="form-inner">
                                        <label>last name</label>
                                        <input type="text" placeholder="Scoot">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-30">
                                    <div class="form-inner">
                                        <label for="number">phone number</label>
                                        <input type="tel" name="phone" placeholder="+99 (0) *** ** ***">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-30">
                                    <div class="form-inner">
                                        <label for="email">email address <span>*</span></label>
                                        <input type="email" name="email" placeholder="info@example.com">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-15">
                                    <div class="form-inner">
                                        <label for="message">message</label>
                                        <textarea name="message" placeholder="Write your enquiry..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <button class="primary-btn" type="submit" name="contact">
                                            SUBMIT here
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Enquiry section ends here -->

    <!-- Contact Map Section Start -->
    <div class="contact-map-section">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.5647631857846!2d90.36311167605992!3d23.83407118555764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c14c8682a473%3A0xa6c74743d52adb88!2sEgens%20Lab!5e0!3m2!1sen!2sbd!4v1700138349574!5m2!1sen!2sbd" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Contact Map Section End -->

   
<?php
include('include/footer.php');
?>
</body>


</html>