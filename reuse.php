<!-- jQuery -->
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome (if using icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

<!-- AOS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Banner Swiper
    var bannerSwiper = new Swiper(".banner-swiper", {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        effect: "slide"
    });

    // Another Swiper (if needed)
    var slideSwiper = new Swiper(".banner-swiper-slide", {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".next-1",
            prevEl: ".prev-1",
        },
        effect: "slide"
    });
</script>

<!-- Counterup -->
<script src="assets/js/waypoints.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>

<!-- Marquee -->
<script src="assets/js/jquery.marquee.min.js"></script>
<script>
    $(".marquee_text1").marquee({direction:"left", duration:25000, gap:50, duplicated:true});
    $(".marquee_text2").marquee({direction:"right", duration:25000, gap:50, duplicated:true});
</script>

<!-- AJAX Functions for Cart/Wishlist/Search -->
<script>
function add_to_wishlist(product_id, user_id){
    $.post("ajax.php",{user_id, product_id, add_to_wishlist:"add_to_wishlist"}, function(data){
        alert(data); location.reload();
    });
}

function delete_wishlist_item(product_id, user_id){
    $.post("ajax.php",{product_id, user_id, delete_wishlist_item:"delete_wishlist_item"}, function(data){
        alert(data); location.reload();
    });
}

function addtocart(product_id, product_name, product_image, product_price, url, product_baseprice){
    let product_quantity = $('#qty').val() || 1;
    $.post("ajax.php", {
        product_id, product_name, product_image, product_price, url, product_baseprice,
        add_to_cart:"add_to_cart", product_quantity
    }, function(result){
        alert(result); location.reload();
    });
}

function remove_item_from_cart(product_id, product_name){
    $.post("ajax.php", {product_id, product_name, remove_item_from_cart:"remove_item_from_cart"}, function(result){
        location.reload();
    });
}

function search1(str){
    let searchList = document.getElementById('search_data');
    if(str.trim() === '') { searchList.style.display='none'; return; }
    $.post("ajax.php",{search_book:str}, function(html){
        let data2 = JSON.parse(html);
        let htmldiv = data2.length ? data2.map(el=>`<a href="product.php?url=${el.url}"><li style="text-align:left;padding:5px 15px;border:1px solid #e4dede;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">${el.name}</li></a>`).join('') :
        `<a href="#"><li style="text-align:left;padding:5px 15px;border:1px solid #e4dede;">No Result Found</li></a>`;
        searchList.innerHTML = htmldiv;
        searchList.style.display = data2.length ? 'block' : 'none';
    });
}

function search2(str){
    let searchList = document.getElementById('search_data1');
    if(str.trim() === '') { searchList.style.display='none'; return; }
    $.post("ajax.php",{search_book1:str}, function(html){
        let data2 = JSON.parse(html);
        let htmldiv = data2.length ? data2.map(el=>`<a href="product.php?url=${el.url}"><li style="text-align:left;padding:5px 15px;border:1px solid #e4dede;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">${el.name}</li></a>`).join('') :
        `<a href="#"><li style="text-align:left;padding:5px 15px;border:1px solid #e4dede;">No Result Found</li></a>`;
        searchList.innerHTML = htmldiv;
        searchList.style.display = data2.length ? 'block' : 'none';
    });
}
</script>

<!-- Main JS -->
<script src="assets/js/main.js"></script>
