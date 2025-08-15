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
    <title>Ethics - Fashion Shop HTML Template</title>
    <link rel="icon" href="assets/image/thumbnail.svg" type="image/gif" sizes="20x20">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <style>
        :root {
            --ivory-white: #F6F4F2;
            --onyx-black: #0F0F0F;
            --muted-cocoa: #6E6259;
            --warm-sand: #D5C7B2;
            --soft-gold: #CBB275;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--onyx-black);
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Playfair Display', serif;
            text-transform: uppercase;
            font-weight: 700;
        }

        section {
            padding: 80px 0;
        }

        .heading-line {
            width: 60px;
            height: 2px;
            background: var(--muted-cocoa);
            margin: 20px auto;
        }

        .custom-img {
            width: 100%;
            height: auto;
            border-radius: 12px;
        }

        .icon-svg {
            width: 60px;
            margin-bottom: 12px;
            fill: var(--soft-gold);
        }

        .btn-style {
            background-color: var(--muted-cocoa);
            color: #fff;
            padding: 10px 24px;
            border-radius: 50px;
            border: none;
        }

        .btn-style:hover {
            background: var(--onyx-black);
        }

        section {
            padding: 80px 0;
        }

        .heading-line {
            width: 60px;
            height: 2px;
            background: var(--muted-cocoa);
            margin: 20px auto;
        }

        .section-bg {
            background-color: var(--warm-sand);
        }

        .highlight {
            color: var(--muted-cocoa);
            font-weight: 500;
        }

        .icon {
            font-size: 36px;
            color: var(--soft-gold);
        }

        .custom-img {
            border-radius: 12px;
            object-fit: cover;
            width: 100%;
            max-height: 500px;
        }

        .fade-in {
            transition: all 0.8s ease-in-out;
        }

        .btn-style {
            background-color: var(--muted-cocoa);
            color: #fff;
            padding: 10px 24px;
            border-radius: 50px;
            border: none;
        }

        .btn-style:hover {
            background-color: var(--onyx-black);
            color: #fff;
        }

        .about-section {
            padding: 100px 0;
            background-color: var(--ivory-white);
        }

        .story-section {
            padding: 100px 0;
            background-color: var(--warm-sand);
        }

        .vision-section {
            padding: 100px 0;
            background-color: var(--ivory-white);
        }

        .craftsmanship-section {
            padding: 100px 0;
            background-color: var(--warm-sand);
        }

        .sustainability-section {
            padding: 100px 0;
            background-color: var(--ivory-white);
        }

        .img-container {
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }

        .img-container img {
            width: 100%;
            height: auto;
            transition: transform 0.5s ease;
        }

        .img-container:hover img {
            transform: scale(1.05);
        }

        .feature-box {
            padding: 40px 30px;
            background-color: white;
            margin-bottom: 30px;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--soft-gold);
            margin-bottom: 1.5rem;
        }

        .feature-box h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--muted-cocoa);
        }

        .text-highlight {
            color: var(--soft-gold);
            font-weight: 600;
        }

        .stat-item {
            text-align: center;
            padding: 30px 20px;
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            color: var(--soft-gold);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted-cocoa);
        }

        .section-title {
            position: relative;
            margin-bottom: 3rem;
            padding-bottom: 1rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 2px;
            background-color: var(--soft-gold);
        }

        .about-section {
            padding: 100px 0;
            background-color: var(--ivory-white);
        }
    </style>
</head>

<body>


    <?php
    include('include/header.php');
    ?>
    <!-- hearder section ends here -->

    <!-- breadcrumb section strats here -->
    <div class="breadcrumb-section mb-100"
        style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url(assets/image/inner-page/breadcrumb-image3.jpg);">
    
    </div>
    <!-- breadcrumb section ends here -->

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="img-container">
                        <img src="https://images.unsplash.com/photo-1520367445093-50dc08a59d9d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80" alt="Ivoric Craftsmanship" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 fade-in slide-in-right">
                    <h2 class="section-title">Who We Are</h2>
                    <p>At <span class="text-highlight">Ivoric Lifestyle Private Limited</span>, we are proud to be crafted in India. Ivoric is an affordable premium clothing and lifestyle brand that blends Indian craftsmanship with global standards of luxury.</p>
                    <p style="text-align: justify;">We believe that true style is timeless - defined not by trends, but by quality, comfort, and purpose. Our mission is to create exceptional wardrobe essentials that elevate everyday life - refined, versatile pieces that reflect elegance, utility, and modern minimalism.</p>
                    <p style="text-align: justify;">Proudly Made in India, Every Ivoric product is conceived, designed, and made in India, showcasing the skill and artistry of Indian creators. From fabric sourcing to final stitch, we work with India's finest artisans and production partners, ensuring precision, durability, and a luxurious finish.</p>
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-6 col-md-3 stat-item">
                                <div class="stat-number">100%</div>
                                <div class="stat-label">Made in India</div>
                            </div>
                            <div class="col-6 col-md-3 stat-item">
                                <div class="stat-number">50+</div>
                                <div class="stat-label">Artisans</div>
                            </div>
                            <div class="col-6 col-md-3 stat-item">
                                <div class="stat-number">1000+</div>
                                <div class="stat-label">Happy Clients</div>
                            </div>
                            <div class="col-6 col-md-3 stat-item">
                                <div class="stat-number">5</div>
                                <div class="stat-label">Collections</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-bg" id="our-story">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-up">
                    <h2>Our Story</h2>
                    <p style="text-align: justify;">
                        Ivoric was born in India - shaped by heritage, driven by craftsmanship, and elevated
                        for the world.

                        In a world saturated with fleeting trends and fast fashion, we envisioned something
                        different - a brand that would stand proudly from India, delivering clothing that
                        rivals the world’s finest. We wanted to redefine affordable luxury from an Indian
                        perspective - crafted in India, made for the global stage.
                        <br>

                        The name “Ivoric” draws from ivory - timeless, rare, and refined - much like
                        the garments we create. Our designs reflect minimalism, utility, and quiet
                        confidence, blending Indian craftsmanship with global luxury standards.

                    </p>
                </div>
                <div class="col-md-6" data-aos="fade-up">
                    <img src="https://media.istockphoto.com/id/1443245439/photo/business-meeting-businesswoman-woman-office-portrait-job-career-happy-businessman-teamwork.jpg?s=612x612&w=0&k=20&c=1ZR02c1UKfGdBCNWzzKlrwrVZuEiOqnAKcKF4V_t038=" class="custom-img" alt="Story">
                </div>
            </div>
        </div>
    </section>

    <section class="vision-mission-luxury" id="vision-mission">
        <div class="container">

            <!-- Section Intro -->
            <div class="text-center" data-aos="fade-up">
                <h2 class="section-title">Our Vision & Mission</h2>
            </div>

            <!-- Vision -->
            <div class="vision-statement" data-aos="fade-up">
                <blockquote>
                    To be India’s global ambassador of <strong>luxury clothing</strong>, creating timeless designs rooted in culture and built for the modern world.
                </blockquote>
            </div>

            <!-- Mission -->
            <div class="mission-timeline" data-aos="fade-up" data-aos-delay="100">
                <h3 class="subtitle">Our Mission</h3>
                <div class="timeline-item">
                    <span class="timeline-number">01</span>
                    <p>Design and deliver exceptional clothing that blends utility with elegance, made entirely in India using superior materials and skilled craftsmanship.</p>
                </div>
                <div class="timeline-item">
                    <span class="timeline-number">02</span>
                    <p>Create a global benchmark for Indian luxury fashion, offering products that stand equal to the world’s finest – in design, comfort, and finish.</p>
                </div>
                <div class="timeline-item">
                    <span class="timeline-number">03</span>
                    <p>Cultivate a conscious and enduring brand that values longevity over trends, quality over quantity, and craftsmanship over compromise.</p>
                </div>
                <div class="timeline-item">
                    <span class="timeline-number">04</span>
                    <p>Inspire confidence and clarity in our customers’ lives – through clothing that feels effortless, refined, and made with intention.</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* ===== Base Section Styling ===== */
        .vision-mission-luxury {
            background-color: #F6F4F2;
            /* Ivory White */
            padding: 5rem 0;
            font-family: 'Inter', sans-serif;
        }

        /* Headings */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 2.5rem;
            color: #0F0F0F;
            letter-spacing: 1px;
        }

        .heading-line {
            width: 60px;
            height: 3px;
            background-color: #CBB275;
            /* Soft Gold */
            margin: 1rem auto;
        }

        .tagline {
            font-size: 1.1rem;
            color: #6E6259;
            /* Muted Cocoa */
            max-width: 700px;
            margin: 0 auto;
        }

        /* Vision */
        .vision-statement {
            max-width: 800px;
            margin: 4rem auto 3rem auto;
            text-align: center;
        }

        .vision-statement blockquote {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: #6E6259;
            font-style: italic;
            border-left: 4px solid #CBB275;
            padding-left: 1rem;
        }

        /* Mission Timeline */
        .mission-timeline {
            max-width: 800px;
            margin: 0 auto;
        }

        .subtitle {
            font-family: 'Playfair Display', serif;
            text-transform: uppercase;
            font-size: 1.5rem;
            font-weight: bold;
            color: #0F0F0F;
            margin-bottom: 2rem;
            text-align: center;
        }

        .timeline-item {
            position: relative;
            padding-left: 3.5rem;
            margin-bottom: 2rem;
        }

        .timeline-number {
            position: absolute;
            left: 0;
            top: 0;
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: #CBB275;
            font-weight: bold;
            background: #FFFFFF;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            border: 2px solid #CBB275;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timeline-item p {
            color: #6E6259;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }

            .vision-statement blockquote {
                font-size: 1.2rem;
            }
        }
    </style>


    <section class="py-5 section-bg" id="craftsmanship" id="craftsmanship">
        <div class="container">
            <div class="row align-items-center g-5">

                <!-- Image -->
                <div class="col-lg-6" data-aos="zoom-in">
                    <figure class="text-center">
                        <img src="https://www.blugraphic.com/wp-content/uploads/2013/05/010-.jpg"
                            class="img-fluid rounded shadow-sm"
                            alt="Luxury Fabric & Craftsmanship">
                        <figcaption class="mt-3 text-muted fst-italic small">
                            Precision tailoring & artisanal fabric mastery
                        </figcaption>
                    </figure>
                </div>

                <!-- Content -->
                <div class="col-lg-6" data-aos="fade-left">
                    <h2 class="fw-bold text-uppercase mb-4" style="font-family: 'Playfair Display', serif; color: #0F0F0F;">
                        Craftsmanship & Fabric Quality
                    </h2>

                    <p class="lead" style="color: #6E6259;">
                        At Ivoric, we believe true luxury lies in the details you can feel – the precision of the cut, the purity of the fabric, and the dedication behind every stitch.
                    </p>

                    <p style="color: #6E6259;">
                        Every Ivoric garment reflects India’s finest craftsmanship. We collaborate with skilled artisans, expert tailors, and trusted textile partners to ensure excellence, care, and integrity in each piece.
                    </p>

                    <p style="color: #6E6259;">
                        We proudly present India not just as a manufacturing hub, but as a <strong>center of luxury craftsmanship</strong>.
                    </p>

                    <!-- Fabric First -->
                    <div class="mt-4 p-4 rounded shadow-sm" style="background-color: #FFFFFF;">
                        <h5 class="fw-bold mb-3" style="color: #0F0F0F;">Fabric First – Because Quality Speaks</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">✔ Superior materials: Only high‑grade, responsibly sourced fabrics.</li>
                            <li class="mb-2">✔ Tailored precision: Perfect fit, clean lines, and utility‑driven design.</li>
                            <li class="mb-0">✔ Attention to detail: Reinforced seams and refined finishing touches.</li>
                        </ul>
                    </div>

                    <p class="mt-4" style="color: #6E6259;">
                        We don’t believe in shortcuts or compromises. Every product carrying the Ivoric name is crafted with care, designed with purpose, and made to last — inspiring confidence.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="container" id="sustainability">
        <div class="text-center" data-aos="fade-up">
            <h2>Sustainability & Ethical Practices</h2>
            <div class="heading-line"></div>
            <p class="lead">True luxury is mindful - of people, materials, and the planet. Every decision we make is guided by a commitment to responsible craftsmanship, quality over quantity, and lasting value.</p>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 text-center" data-aos="fade-up">
                <img src="https://static.thenounproject.com/png/4565028-200.png" class="icon-svg" alt="Made in India" />
                <h5>All Ivoric products are designed and made in India, supporting local artisans, skilled tailors, and trusted manufacturing partners.</h5>
            </div>
            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                <img src="https://static.thenounproject.com/png/4596915-200.png" class="icon-svg" alt="Fabric Choices" />
                <h5>We carefully select high-quality, durable fabrics that are built to last – reducing the need for overconsumption and short-lived fashion.</h5>
            </div>
            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="400">
                <img src="https://static.thenounproject.com/png/4565330-200.png" class="icon-svg" alt="Longevity" />
                <h5>Ivoric is designed for timeless style – clothing that transcends seasons and fast‑changing trends, encouraging you to invest in pieces you can wear and love for years.</h5>
            </div>
        </div>
    </section>

    <section class="text-center section-bg py-5" data-aos="zoom-in">
        <div class="container">
            <h2 class="mb-3">Crafted in India. Worn with Pride.</h2>
            <p class="mb-4">Join the journey. Choose better. Choose Ivoric.</p>
            <a href="#" class="btn btn-style">Explore Collection</a>
        </div>
    </section>



    <?php
    include('include/footer.php');
    ?>

</body>

</html>