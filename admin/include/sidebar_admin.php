<?php  isAdmin(); ?>

<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="index.php" data-bs-original-title="" title="">
                <img class="img-fluid for-white" src="../assets/images/logo.webp" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="index.php">
                <img class="img-fluid main-logo main-white" src="../assets/images/favicon.png" alt="logo">
                <img class="img-fluid main-logo main-dark" src="../assets/images/favicon.png" alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="index.php">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="all-orders.php">
                            <i class="ri-archive-line"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>Category</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="all-category.php">All Category</a>
                            </li>

                            <li>
                                <a href="add-category.php">Add New Category</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>Sub Category</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="all-subcategory.php">All Sub Category</a>
                            </li>

                            <li>
                                <a href="add-subcategory.php">Add New Sub Category</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="all-product.php">All Products</a>
                            </li>

                            <li>
                                <a href="add-product.php">Add New Products</a>
                            </li>
                        </ul>
                    </li>
                  
               
                   
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-price-tag-3-line"></i>
                            <span>Banner</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="all-banner.php">All Banner</a>

                            <li>
                                <a href="add-banner.php">Add New Banner</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-settings-line"></i>
                            <span>Content</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="about.php">About</a>
                            <li>
                                <a href="contact.php">Contact</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-user-3-line"></i>
                            <span>Users</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="all-users.php">All Users</a>
                            </li>
                            <li>
                                <a href="user_query.php">User Query</a>
                            </li>
                            <li>
                                <a href="newsletter.php">Emails</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-settings-line"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="profile-setting.php">Profile Setting</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                        href="javascript:void(0)">
                                        <b><i style="color: white;" data-feather="log-out"></i></b>
                            <span>Logout</span>
                        </a>
                    </li>


                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>