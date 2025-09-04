<!-- DESKTOP HEADER (visible on lg and up) -->
<div class="d-none d-xl-block">
  <!-- hearder section strats here -->
  <header class="header-area header4">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
          <div class="main-menu">
            <div class="mobile-menu-logo">
              <a href="index.php"><img alt="image" class="img-fluid"
                  src="assets/image/Logo_1.png" width="120px"></a>
            </div>
            <ul class="menu-list">
              <li><a href="index.php" style="border: none;"><img alt="image" class="img-fluid"
                    src="assets/image/left-logo.png" width="50px"></a></li>
              <?php
              $catRes = mysqli_query($con, "SELECT * FROM category WHERE status = 1");
              while ($catRow = mysqli_fetch_assoc($catRes)) {
                echo '<li><a href="category.php?category=' . urlencode($catRow['id']) . '">' . htmlspecialchars($catRow['name']) . '</a></li>';
              }
              ?>
            </ul>
          </div>
          <div class="header-logo">
            <a href="index.php"><img alt="image" class="img-fluid"
                src="assets/image/Logo_1.png" width="120px"></a>
          </div>

          <div class="nav-right">
            <ul>
              <!-- Search Container -->
              <div class="position-relative" style="max-width: 350px;">
                <input type="text"
                  id="search_input"
                  class="form-control"
                  placeholder="What are you looking for?"
                  style="padding:8px 12px; border-radius:50px;"
                  onkeyup="showPopularSearches(this.value)"
                  onkeydown="handleSearch(event)">
                <!-- Dropdown for Popular Searches -->
                <ul id="search_dropdown"
                  class="list-group position-absolute w-100 shadow-sm"
                  style="top: 110%; left: 0; display:none; z-index:999; max-height:200px; overflow-y:auto; border-radius:8px;">
                  <!-- JS will populate this -->
                </ul>
              </div>

              <div class="d-flex align-items-center">
                <li class="px-2">
                  <?php if (!isset($_SESSION['u_id'])): ?>
                    <a href="login.php" class="user">
                      <!-- SVG user icon -->
                      <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7135 8.34627C12.8653 7.50628 13.6153 6.14686 13.6153 4.61538C13.6153 2.07046 11.5448 0 8.99989 0C6.45497 0 4.38451 2.07046 4.38451 4.61538C4.38451 6.14686 5.1345 7.50628 6.28629 8.34627C3.42316 9.44191 1.38452 12.2179 1.38452 15.4615C1.38452 16.8613 2.52327 18 3.92298 18H14.0768C15.4765 18 16.6153 16.8613 16.6153 15.4615C16.6153 12.2179 14.5766 9.44191 11.7135 8.34627ZM5.76914 4.61538C5.76914 2.83395 7.21845 1.38463 8.99989 1.38463C10.7813 1.38463 12.2306 2.83395 12.2306 4.61538C12.2306 6.39682 10.7813 7.84617 8.99989 7.84617C7.21845 7.84617 5.76914 6.39682 5.76914 4.61538ZM14.0768 16.6154H3.92298C3.28676 16.6154 2.76915 16.0978 2.76915 15.4615C2.76915 12.0258 5.56421 9.23073 8.99993 9.23073C12.4356 9.23073 15.2307 12.0258 15.2307 15.4615C15.2307 16.0978 14.7131 16.6154 14.0768 16.6154Z" />
                      </svg>
                    </a>
                  <?php else: ?>
                    <a href="my-account.php" class="user">
                      <!-- SVG user icon -->
                      <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7135 8.34627C12.8653 7.50628 13.6153 6.14686 13.6153 4.61538C13.6153 2.07046 11.5448 0 8.99989 0C6.45497 0 4.38451 2.07046 4.38451 4.61538C4.38451 6.14686 5.1345 7.50628 6.28629 8.34627C3.42316 9.44191 1.38452 12.2179 1.38452 15.4615C1.38452 16.8613 2.52327 18 3.92298 18H14.0768C15.4765 18 16.6153 16.8613 16.6153 15.4615C16.6153 12.2179 14.5766 9.44191 11.7135 8.34627ZM5.76914 4.61538C5.76914 2.83395 7.21845 1.38463 8.99989 1.38463C10.7813 1.38463 12.2306 2.83395 12.2306 4.61538C12.2306 6.39682 10.7813 7.84617 8.99989 7.84617C7.21845 7.84617 5.76914 6.39682 5.76914 4.61538ZM14.0768 16.6154H3.92298C3.28676 16.6154 2.76915 16.0978 2.76915 15.4615C2.76915 12.0258 5.56421 9.23073 8.99993 9.23073C12.4356 9.23073 15.2307 12.0258 15.2307 15.4615C15.2307 16.0978 14.7131 16.6154 14.0768 16.6154Z" />
                      </svg>
                    </a>
                  <?php endif; ?>
                </li>
                <li class="px-2">
                  <div class="cart-area">
                    <a href="whislist.php">
                      <!-- SVG heart icon -->
                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.00035 16.3798C8.75818 16.3804 8.51829 16.333 8.29455 16.2403C8.07081 16.1477 7.86764 16.0116 7.69679 15.84L1.73357 9.87658C0.848151 8.99116 0.360352 7.81396 0.360352 6.56152V6.48826C0.360352 5.23582 0.848151 4.05844 1.73357 3.1732C2.61899 2.28796 3.79655 1.7998 5.04845 1.7998H5.12225C6.37415 1.7998 7.55171 2.2876 8.43713 3.17302L9.00035 3.73624L9.56357 3.17302C10.449 2.2876 11.6266 1.7998 12.8785 1.7998H12.9523C14.2042 1.7998 15.3817 2.2876 16.2671 3.17302C17.1526 4.05844 17.6404 5.23564 17.6404 6.48808V6.56134C17.6404 7.81378 17.1526 8.99116 16.2671 9.8764L10.3039 15.8398C10.1331 16.0115 9.92994 16.1476 9.70619 16.2403C9.48244 16.333 9.24254 16.3804 9.00035 16.3798ZM8.46035 15.0762C8.74979 15.3651 9.25145 15.3644 9.54035 15.0761L15.5036 9.1132C15.8396 8.77883 16.106 8.38115 16.2874 7.94317C16.4688 7.50518 16.5616 7.03558 16.5604 6.56152V6.48826C16.5604 5.52436 16.1849 4.61824 15.5036 3.93676C14.8223 3.25528 13.9158 2.8798 12.9523 2.8798H12.8785C12.4044 2.87847 11.9349 2.97119 11.4969 3.15259C11.059 3.33398 10.6614 3.60046 10.3271 3.93658L9.38213 4.88158C9.33201 4.93175 9.2725 4.97155 9.20699 4.99871C9.14148 5.02586 9.07126 5.03984 9.00035 5.03984C8.92944 5.03984 8.85922 5.02586 8.79371 4.99871C8.7282 4.97155 8.66869 4.93175 8.61857 4.88158L7.67357 3.93658C7.33933 3.60046 6.94173 3.33398 6.50379 3.15259C6.06585 2.97119 5.59627 2.87847 5.12225 2.8798H5.04845C4.08491 2.8798 3.17843 3.25492 2.49713 3.93658C1.81583 4.61824 1.44035 5.52418 1.44035 6.48808V6.56134C1.43908 7.03538 1.53183 7.50497 1.71322 7.94292C1.89462 8.38089 2.16106 8.77853 2.49713 9.11284L8.46035 15.0762Z"
                          fill="white" />
                      </svg>
                    </a>
                    <span>0</span>
                  </div>
                </li>
                <li class="px-2">
                  <div class="cart-area">
                    <a href="cart-page.php">
                      <!-- SVG cart icon -->
                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.375 4.78125H14.625M6.1875 4.78125V3.51562C6.1875 1.96232 7.44669 0.703125 9 0.703125C10.5533 0.703125 11.8125 1.96232 11.8125 3.51562V4.78125M11.8125 7.59375C11.8125 9.14706 10.5533 10.4062 9 10.4062C7.44669 10.4062 6.1875 9.14706 6.1875 7.59375"
                          stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                          stroke-linejoin="round" />
                        <path d="M14.625 4.78125L16.0201 15.7131C16.0275 15.772 16.0313 15.8313 16.0312 15.8906C16.0312 16.6673 15.4016 17.2969 14.625 17.2969H3.375C2.59836 17.2969 1.96875 16.6673 1.96875 15.8906C1.96875 15.8305 1.97251 15.7712 1.97986 15.7131L3.375 4.78125"
                          stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                          stroke-linejoin="round" />
                      </svg>
                    </a>
                    <span>0</span>
                  </div>
                </li>
              </div>
            </ul>
            <div class="sidebar-button mobile-menu-btn d-none">
              <span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</div>

<!-- MOBILE HEADER (visible below lg) -->
<div class="d-block d-xl-none">
  <header class="header-area header4">
    <div class="container-fluid px-3">
      <div class="d-flex justify-content-between align-items-center py-2">

        <!-- Left: Hamburger + Logo -->
        <div class="d-flex align-items-center">
          <!-- <button class="hamburger-btn me-3" onclick="toggleMobileMenu()">
            <span></span><span></span><span></span>
          </button> -->
          <button onclick="toggleMobileMenu()" class="bg-white fs-4">
            <span><i class="fa-solid fa-bars"></i></span>
          </button>
        </div>
        <div class="justify-content-center">
          <a href="index.php" style="border: none;"><img alt="image" class="img-fluid"
              src="assets/image/Logdgo_1.png" width="60px"></a>
          </a>
        </div>

        <!-- Right: Icons -->
        <div class="header-icons d-flex align-items-center">
          <!-- User -->
          <?php if (!isset($_SESSION['u_id'])): ?>
            <a href="login.php" class="icon-link">
              <div class="icon"><i class="fa-regular fa-user"></i></div>
            </a>
          <?php else: ?>
            <a href="my-account.php" class="icon-link">
              <div class="icon"><i class="fa-regular fa-user"></i></div>
            </a>
          <?php endif; ?>

          <!-- Cart -->
          <a href="cart-page.php" class="icon-link">
            <div class="icon position-relative">
              <span class="number cart-count">0</span>
              <i class="fa-solid fa-bag-shopping"></i>
            </div>
          </a>

          <!-- Wishlist -->
          <a href="whislist.php" class="icon-link">
            <div class="icon position-relative">
              <span class="number wishlist-count">0</span>
              <i class="fa-regular fa-heart"></i>
            </div>
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- MOBILE SIDEBAR MENU -->
  <div class="mobile-menu-overlay" onclick="toggleMobileMenu()"></div>
  <div class="mobile-menu">
    <div class="mobile-menu-header d-flex align-items-end pb-3 px-2">
      <img alt="image" class="img-fluid" src="assets/image/left-logo.png" width="60px">
      <div>
        <a href="index.php"><img src="assets/image/Logo_1.png" ></a>
        <!-- <button class="close-btn" onclick="toggleMobileMenu()" ><i class="fa-regular fa-circle-xmark"></i></i></button> -->
      </div>
    </div>

    <div class="mobile-menu-body px-3">
      <!-- Login/Register -->
      <div class="text-center mb-3">
        <?php if (!isset($_SESSION['u_id'])): ?>
          <a href="login.php" class="btn btn-dark w-100">Log In / Register</a>
        <?php else: ?>
          <a href="my-account.php" class="btn btn-dark w-100">My Account</a>
        <?php endif; ?>
      </div>

      <!-- Categories -->
      <ul class="mobile-nav p-0">
        <?php
              $catRes = mysqli_query($con, "SELECT * FROM category WHERE status = 1");
              while ($catRow = mysqli_fetch_assoc($catRes)) {
                echo '<li><a href="category.php?category=' . urlencode($catRow['id']) . '">' . htmlspecialchars($catRow['name']) . '</a></li>';
              }
              ?>
      </ul>

      <!-- Quick Links -->
      <ul class="mobile-quick mt-4 p-0">
        <li><a href="stores.php">Stores Near Me</a></li>
        <li><a href="track-order.php">Track My Order</a></li>
        <li><a href="offers.php">Markdowns</a></li>
      </ul>
    </div>
  </div>
</div>



<!-- CSS for mobile menu and hamburger (from header-another.php) -->
<style>

  .icon-link {
    color: #222;
    text-decoration: none;
  }

  .icon {
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
  }

  .icon i {
    font-size: 16px;
    color: #000;
  }

  /* .icon .number {
    position: absolute;
    top: -6px;
    right: -6px;
    background: #000;
    color: #fff;
    font-size: 11px;
    font-weight: bold;
    border-radius: 50%;
    padding: 2px 5px;
    min-width: 16px;
    text-align: center;
  } */
  .icon .number {
    height: 18px;
    transition: 0.45s;
    width: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    font-size: 12px;
    font-weight: 500;
    color: var(--title-color);
    font-family: var(--font-outfit);
    background-color: var(--primary-color);
    border-radius: 50%;
    position: absolute;
    top: -0.1rem;
    right: -0.1rem;
  }

  .hamburger-btn {
    background: none;
    border: none;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .hamburger-btn span {
    display: block;
    width: 22px;
    height: 2px;
    background: #000;
  }

  .mobile-menu-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, .5);
    z-index: 1040;
  }

  .mobile-menu {
    position: fixed;
    top: 0;
    left: -100%;
    width: 260px;
    height: 100%;
    background: #fff;
    z-index: 1050;
    overflow-y: auto;
    transition: .4s;
    padding-top: 20px;
  }

  .mobile-menu-header a img{
    max-width: 60%;
  }
  .mobile-menu.active {
    left: 0;
  }

  .mobile-menu-overlay.active {
    display: block;
  }

  .mobile-nav li,
  .mobile-quick li {
    list-style: none;
    border-bottom: 1px solid #eee;
  }

  .mobile-nav li a,
  .mobile-quick li a {
    display: block;
    padding: 12px 0;
    color: #000;
    text-decoration: none;
    text-transform: uppercase;
    font-weight: 500;
    left:0;
  }

  .close-btn {
    position: relative;
    top: 0.35rem;
    background: none;
    border: none;
    font-size: 26px;
  }
</style>

<!-- JS for mobile menu toggle -->
<script>
  function toggleMobileMenu() {
    document.querySelector('.mobile-menu').classList.toggle('active');
    document.querySelector('.mobile-menu-overlay').classList.toggle('active');
  }
</script>

<!-- Update cart/wishlist badge dynamically (shared logic) -->
<script>
  (function() {
    function setCartCount(n) {
      n = parseInt(n) || 0;
      // Desktop / header .cart-area (the <span> after cart anchor)
      document.querySelectorAll('.cart-area a[href="cart-page.php"]').forEach(function(a) {
        var s = a.parentElement.querySelector('span');
        if (s) s.textContent = n;
      });
      // Mobile bottom wrapper badge(s)
      document.querySelectorAll('.mobile-bottom-wrapper a[href="cart-page.php"] .number').forEach(function(el) {
        el.textContent = n;
      });
      document.querySelectorAll('.cart-count').forEach(function(el) {
        el.textContent = n;
      });
    }

    function setWishlistCount(n) {
      n = parseInt(n) || 0;
      // Desktop wishlist (markup uses whislist.php)
      document.querySelectorAll('.cart-area a[href="whislist.php"]').forEach(function(a) {
        var s = a.parentElement.querySelector('span');
        if (s) s.textContent = n;
      });
      // Mobile bottom wrapper wishlist
      document.querySelectorAll('.mobile-bottom-wrapper a[href="whislist.php"] .number').forEach(function(el) {
        el.textContent = n;
      });
      document.querySelectorAll('.wishlist-count').forEach(function(el) {
        el.textContent = n;
      });
    }

    window.updateCartBadge = setCartCount;
    window.updateWishlistBadge = setWishlistCount;

    function applyCountsFromData(data) {
      if (!data || typeof data !== 'object') return;
      if (typeof data.cart_count !== 'undefined') setCartCount(data.cart_count);
      if (typeof data.wishlist_count !== 'undefined') setWishlistCount(data.wishlist_count);
    }

    // Intercept fetch responses to pick up cart_count / wishlist_count from ajax.php
    var origFetch = window.fetch;
    if (origFetch) {
      window.fetch = function(input, init) {
        return origFetch(input, init).then(function(resp) {
          try {
            var cloned = resp.clone();
            cloned.json().then(function(data) {
              applyCountsFromData(data);
            }).catch(function() {
              /* not json */
            });
          } catch (e) {}
          return resp;
        });
      };
    }

    // Intercept XHR responses (for sites still using XHR)
    (function() {
      var origOpen = XMLHttpRequest.prototype.open;
      var origSend = XMLHttpRequest.prototype.send;
      XMLHttpRequest.prototype.open = function(method, url) {
        this._url = url;
        origOpen.apply(this, arguments);
      };
      XMLHttpRequest.prototype.send = function(body) {
        this.addEventListener('load', function() {
          try {
            if (this._url && this._url.indexOf('ajax.php') !== -1) {
              var json = JSON.parse(this.responseText || '{}');
              applyCountsFromData(json);
            }
          } catch (e) {
            /* ignore parse errors */
          }
        });
        origSend.apply(this, arguments);
      };
    })();

    // On load, request current cart + wishlist counts
    function fetchCartCount() {
      fetch('ajax.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'get_cart_count=1'
      }).then(function(r) {
        return r.json();
      }).then(function(data) {
        if (data && typeof data.cart_count !== 'undefined') setCartCount(data.cart_count);
      }).catch(function() {
        /* ignore */
      });
    }

    function fetchWishlistCount() {
      fetch('ajax.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'get_wishlist_count=1'
      }).then(function(r) {
        return r.json();
      }).then(function(data) {
        if (data && typeof data.wishlist_count !== 'undefined') setWishlistCount(data.wishlist_count);
      }).catch(function() {
        /* ignore */
      });
    }

    fetchCartCount();
    fetchWishlistCount();
  })();
</script>