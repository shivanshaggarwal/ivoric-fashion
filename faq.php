<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Swiper css link -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- Fancybox css link -->
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <!-- Animation css link -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="assets/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Boxicon css link -->
    <link rel="stylesheet" href="assets/css/boxicons.min.css">
    <!-- My css link -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Ivoric Lifestyle Private Limited</title>
    <link rel="icon" href="assets/image/thumbnail.svg" type="image/gif" sizes="20x20">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter&display=swap"
        rel="stylesheet">
    <style>
        body {
            background-color: #F6F4F2;
            font-family: 'Inter', sans-serif;
            color: #0F0F0F;
        }

        .faq-section {
            padding: 60px 20px;
            max-width: 960px;
            margin: auto;
        }

        .faq-heading {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            text-transform: uppercase;
            text-align: center;
        }

        .faq-subtext {
            text-align: center;
            color: #6E6259;
            margin-bottom: 40px;
            font-size: 1.1rem;
        }

        .faq-category {
            font-size: 1.2rem;
            font-weight: 600;
            color: #CBB275;
            margin-top: 40px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .faq-category i {
            font-size: 1.3rem;
        }

        .accordion-item {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #D5C7B2;
        }

        .accordion-button {
            background-color: transparent;
            font-weight: 500;
            font-size: 1.05rem;
            color: #0F0F0F;
            box-shadow: none !important;
        }

        .accordion-body {
            color: #6E6259;
            line-height: 1.6;
        }

        .contact-help {
            text-align: center;
            margin-top: 60px;
            color: #6E6259;
            font-size: 1rem;
        }

        .contact-help a {
            color: #0F0F0F;
            text-decoration: underline;
            font-weight: 500;
        }
    </style>
</head>

<body>

<?php
include('include/header.php');
?>
    <!-- breadcrumb section strats here -->
    <div class="breadcrumb-section mb-100"
        style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(assets/image/inner-page/faq-breadcrumb.jpg);">
       
    </div>
    <!-- breadcrumb section ends here -->

    <section class="faq-section">
        <h2 class="faq-heading">Frequently Asked Questions</h2>
        <p class="faq-subtext">Below are answers to the most common questions. If you need further assistance, feel free
            to contact us.</p>

        <!-- Orders & Payments -->
        <div class="faq-category"><i class="bi bi-bag-check"></i> Orders & Payments</div>
        <div class="accordion" id="faqAccordion1">
            <div class="accordion-item">
                <h2 class="accordion-header" id="q1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a1">
                        How do I place an order?
                    </button>
                </h2>
                <div id="a1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
                    <div class="accordion-body">
                        Simply browse our collection, select your size, and click Add to Cart. Proceed to checkout and
                        follow the instructions to complete your purchase securely.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a2">
                        What payment methods do you accept?
                    </button>
                </h2>
                <div id="a2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
                    <div class="accordion-body">
                        We accept:<br>
                        • UPI, Debit/Credit Cards, Net Banking<br>
                        • Wallets (Paytm, PhonePe, etc.)<br>
                        • Cash on Delivery (COD) in select locations<br><br>
                        All payments are securely processed via Razorpay.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a3">
                        Can I cancel my order after placing it?
                    </button>
                </h2>
                <div id="a3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
                    <div class="accordion-body">
                        Yes, orders can be cancelled before they are shipped. Please contact us immediately for
                        assistance.
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping & Delivery -->
        <div class="faq-category"><i class="bi bi-truck"></i> Shipping & Delivery</div>
        <div class="accordion" id="faqAccordion2">
            <div class="accordion-item">
                <h2 class="accordion-header" id="q4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a4">
                        Do you offer Open Box Delivery?
                    </button>
                </h2>
                <div id="a4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
                    <div class="accordion-body">
                        Yes. Most Ivoric orders are delivered with Open Box Delivery, allowing you to inspect the
                        product at delivery for any damage or issues.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a5">
                        What are your shipping charges?
                    </button>
                </h2>
                <div id="a5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
                    <div class="accordion-body">
                        We offer free shipping on all prepaid orders above ₹499. Shipping charges, if any, will be shown
                        at checkout.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q6">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a6">
                        When will my order be delivered?
                    </button>
                </h2>
                <div id="a6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
                    <div class="accordion-body">
                        Orders are typically delivered within 5–10 business days across India. Delivery times may vary
                        based on location.
                    </div>
                </div>
            </div>
        </div>

        <!-- Returns & Refunds -->
        <div class="faq-category"><i class="bi bi-arrow-counterclockwise"></i> Returns & Refunds</div>
        <div class="accordion" id="faqAccordion3">
            <div class="accordion-item">
                <h2 class="accordion-header" id="q7">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a7">
                        Can I return a product after delivery?
                    </button>
                </h2>
                <div id="a7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion3">
                    <div class="accordion-body">
                        Yes, if you’re not satisfied or there’s a size issue, you may return the product within 7 days,
                        provided:<br>
                        • It is unused, unwashed, in original condition<br>
                        • The Ivoric return seal is intact<br>
                        • Return is raised via our website or support team
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q8">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a8">
                        How do I raise a return request?
                    </button>
                </h2>
                <div id="a8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion3">
                    <div class="accordion-body">
                        1. Log in to your account<br>
                        2. Go to My Orders → select order → click Request Return<br>
                        3. Or contact us directly at <a href="mailto:hello@ivoric.in">hello@ivoric.in</a>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q9">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a9">
                        How will I receive my refund?
                    </button>
                </h2>
                <div id="a9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion3">
                    <div class="accordion-body">
                        Refunds are processed within 7–10 business days to the original payment method. For COD orders,
                        refund is via bank transfer.
                    </div>
                </div>
            </div>
        </div>

        <!-- Sizing & Fit -->
        <div class="faq-category"><i class="bi bi-rulers"></i> Sizing & Fit</div>
        <div class="accordion" id="faqAccordion4">
            <div class="accordion-item">
                <h2 class="accordion-header" id="q10">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a10">
                        How do I choose the right size?
                    </button>
                </h2>
                <div id="a10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion4">
                    <div class="accordion-body">
                        Refer to our Size Guide for measurements and fit advice. If in doubt, contact our team for
                        assistance.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q11">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a11">
                        Do you offer size exchanges?
                    </button>
                </h2>
                <div id="a11" class="accordion-collapse collapse" data-bs-parent="#faqAccordion4">
                    <div class="accordion-body">
                        We currently do not offer direct exchanges. You can return the item (if eligible) and place a
                        new order.
                    </div>
                </div>
            </div>
        </div>

        <!-- IVORIC Club -->
        <div class="faq-category"><i class="bi bi-star"></i> IVORIC Club Membership</div>
        <div class="accordion" id="faqAccordion5">
            <div class="accordion-item">
                <h2 class="accordion-header" id="q12">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a12">
                        What is the IVORIC Club?
                    </button>
                </h2>
                <div id="a12" class="accordion-collapse collapse" data-bs-parent="#faqAccordion5">
                    <div class="accordion-body">
                        A premium membership offering early access to new drops, exclusive offers, and more. It’s free
                        to join.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="q13">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#a13">
                        How do I join?
                    </button>
                </h2>
                <div id="a13" class="accordion-collapse collapse" data-bs-parent="#faqAccordion5">
                    <div class="accordion-body">
                        Sign up via our website using your email and phone number. You’ll receive member benefits right
                        in your inbox.
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="contact-help mt-5">
            <p><i class="bi bi-tools"></i> Still have questions? Contact us at <a
                    href="mailto:hello@ivoric.in">hello@ivoric.in</a> or <a href="tel:+917905150529">+91-7905150529</a>
                — we’re happy to assist.</p>
        </div>
    </section>



  
<?php
include('include/footer.php');
?>
</body>



</html>