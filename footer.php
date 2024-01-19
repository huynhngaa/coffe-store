<footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img width="70%" src="img/logo2.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </footer>


    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<!-- Add this JavaScript code to your HTML file -->
<!-- Add this JavaScript code to your HTML, preferably in a separate script.js file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
// sort.js

// Function to send an Ajax request for sorting
function sortProducts() {
    var sortBy = $('#sort-by').val(); // Get the selected sorting option

    $.ajax({
        type: 'POST',
        url: 'sort-products.php', // Create a new PHP file for handling the sorting logic
        data: { sortBy: sortBy },
        success: function (response) {
            // Update the product list with the sorted data
            $('#product-list').html(response);
        }
    });
}

// Function to send an Ajax request for filtering
function filterProducts() {
    var sortBy = $('#sort-by').val(); // Get the selected sorting option

    $.ajax({
        type: 'POST',
        url: 'sort-products.php', // Use the same PHP file for filtering
        data: { sortBy: sortBy },
        success: function (response) {
            // Update the product list with the filtered data
            $('#product-list').html(response);
        }
    });
}

// Attach a change event listener to the sorting select input
$('#sort-by').change(sortProducts);

// Attach a click event listener to the "Lọc" button
$('#filter-button').click(filterProducts);

// Initial sorting on page load
sortProducts();


</script> -->


    <script>
    // Function to add items to the cart
    function addToCart(productId) {

        var cartItemCount = parseInt(document.getElementById('cart-item-count').textContent);
        cartItemCount += 1;
        document.getElementById('cart-item-count').textContent = cartItemCount;
    }

    // Add a click event listener to all "add-to-cart" links
    var addToCartLinks = document.querySelectorAll('.add-to-cart');
    addToCartLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var productId = this.getAttribute('data-product-id');
            addToCart(productId);
        });
    });
</script>

<script>
    // Get all quantity inputs
    const quantityInputs = document.querySelectorAll('.quantity-input');

    // Add an input event listener to each quantity input
    quantityInputs.forEach(input => {
        input.addEventListener('input', function () {
            const quantity = parseInt(this.value);
            const gia = parseFloat(this.getAttribute('data-gia'));
            const total = quantity * gia;

            // Find the corresponding total price element in the same row
            const totalPriceElement = this.closest('.cart-item').querySelector('.total-price');

            // Update the total price with the new calculated value
            totalPriceElement.textContent = number_format(total);
        });
    });

function number_format(number) {
    return number.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,') + ' đ';
}

</script>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const quantityInputs = document.querySelectorAll(".quantity-input");
    const totalAmount = document.querySelector("#total-amount");
    const shippingFee = document.querySelector("#shipping-fee");
    const totalAmount2 = document.querySelector("#total-amount2");

    function formatCurrency(amount) {
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function updateTotalAmount() {
        let total = 0;
        quantityInputs.forEach((input) => {
            const quantity = parseInt(input.value);
            const price = parseFloat(input.getAttribute("data-gia"));
            if (!isNaN(quantity) && !isNaN(price)) {
                total += quantity * price;
            }
        });

        // Calculate shipping fee
        const shippingFeeAmount = total >= 200000 ? 0 : 20000; // Miễn phí vận chuyển cho hóa đơn trên hoặc bằng 200,000 đ

        // Calculate total amount including shipping fee
        const totalWithShipping = total + shippingFeeAmount;

        // Display the values
        totalAmount.textContent = formatCurrency(total) + ' đ';
        shippingFee.textContent = formatCurrency(shippingFeeAmount) + ' đ';
        totalAmount2.textContent = formatCurrency(totalWithShipping) + ' đ';
    }

    function updateSessionData(productId, quantity) {
        // Send an AJAX request to update the session data
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "update-session.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Session data updated successfully
                updateTotalAmount(); // Cập nhật tổng tiền sau khi cập nhật dữ liệu phiên
            }
        };
        xhr.send("productId=" + productId + "&quantity=" + quantity);
    }

    quantityInputs.forEach((input) => {
        input.addEventListener("input", function () {
            const productId = input.getAttribute("data-product-id");
            const quantity = parseInt(input.value);
            updateSessionData(productId, quantity);
        });
    });

    // Calculate and update the total amount on page load
    updateTotalAmount();
});

</script>

<script>
  const sdtInput = document.getElementById('sdt');
  const sdtError = document.getElementById('sdtError');

  sdtInput.addEventListener('input', () => {
    const phoneNumber = sdtInput.value;

    // Sử dụng regex để kiểm tra số điện thoại
    const regex = /^0\d{9}$/;

    if (!regex.test(phoneNumber)) {
      sdtError.textContent = "Số điện thoại không hợp lệ!";
      sdtInput.setCustomValidity("Invalid phone number");
    } else {
      sdtError.textContent = "";
      sdtInput.setCustomValidity("");
    }
  });
</script>


    <!-- Js Plugins -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>