<?php
session_start(); 
include "connect.php";

?>
<!DOCTYPE html>
<html lang="zxx">


<?php include "head.php" ?>
<body>
    <style>
        /* Basic styling for the circular button */
.circular-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px; /* Set the desired width and height for your circular button */
    height: 40px;
    border: none;
    background-color: #113946; /* Set the background color */
    color: #fff; /* Set the text color */
    border-radius: 50%; /* Makes it circular */
    cursor: pointer;
    transition: background-color 0.3s; /* Add a smooth transition for hover effect */
}

/* Hover effect */
.circular-button:hover {
    background-color: #1b6e89; /* Change the background color on hover */
}

    </style>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    
    <!-- Humberger End -->
    <?php include "menu-mb.php" ?>
    <!-- Header Section Begin -->
    <?php include "header.php" ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
        <div class="row">
            <div class="col-lg-2">
            </div>
                
            <?php include "search.php" ?>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/shop2.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Liên Hệ</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Trang Chủ</a>
                            <span>Liên Hệ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
            <?php
              
              $sql = "SELECT* from cua_hang";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              ?>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Số Điện Thoại</h4>
                        <p><?php echo $row['sdt'] ?></p>
                    </div>
                </div>
            
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Địa Chỉ</h4>
                        <p><?php echo $row['diachi_ch'] ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Mở Cửa</h4>
                        <p>10:00 am to 23:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p><?php echo $row['email'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->

    <div id="map" class="map">
        <!-- <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>New York</h4>
                <ul>
                    <li>Phone: +12-345-6789</li>
                    <li>Add: 16 Creek Ave. Farmingdale, NY</li>
                </ul>
            </div>
        </div>
    </div>


    <!-- Map  End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Gửi tin nhắn</h2>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message"></textarea>
                        <button type="submit" class="site-btn">GỬI</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

    <!-- Footer Section Begin -->
   <?php include "footer.php" ?>


   <script>




var data = [
    <?php $sql = "SELECT * from cua_hang ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_array()) { 		
        ?>
        { "loc": [<?php echo $row['kinhdo'] ?>, <?php echo $row['vido'] ?>], "title": "Rohan Shop", "s_id": "<?php echo $row['mach'] ?>", "dc": "<?php echo $row['diachi_ch'] ?>" },
        <?php
    }
    ?>
];


var map = L.map('map').setView([10.0279603, 105.7664918], 15);
var layer = new L.TileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});

map.addLayer(layer);
var markersLayer = new L.LayerGroup();	//layer contain searched elements
map.addLayer(markersLayer);

function customTip(text, val) {
    return '<a href="#">' + text + '<em style="background:' + text + '; width:14px;height:14px;float:right"></em></a>';
}
// Add search control to the map


for (i in data) {
    var title = data[i].title,
        loc = data[i].loc,
       dc =  data[i].dc,
        iconUrl = 'https://media1.giphy.com/media/SWWLF8WluVJ5vJjMln/giphy.gif',
        shadowUrl = 'https://png.pngtree.com/png-clipart/20220119/ourmid/pngtree-round-gradient-black-shadow-png-image_4317601.png', // add this line
        icon = new L.Icon({
            iconUrl: iconUrl,
            iconSize: [40, 55],
            shadowUrl: shadowUrl, // add this line
            shadowSize: [50, 50], // add this line
            shadowAnchor: [25, 5] // add this line
        }),

        marker = new L.Marker(new L.latLng(loc), { title: title, icon: icon });
    marker.bindPopup("<div style='font-size: 16px;'><b>" + title + "</b></div>" + "<br>" + ", " + dc );

    //marker.on('click', function (e) {
    //     var clickedLocation = e.latlng;
    //     var destination = L.latLng(clickedLocation.lat, clickedLocation.lng);

    //     routingControl.spliceWaypoints(routingControl.getWaypoints().length - 1, 1, destination);
    // });
    var currentTime = new Date();
var currentHour = currentTime.getHours();
var currentMinute = currentTime.getMinutes();


var morningOpenHour = 8;
var morningOpenMinute = 0;
var morningCloseHour = 13;
var morningCloseMinute = 30;
var afternoonOpenHour = 13;
var afternoonOpenMinute = 30;
var afternoonCloseHour = 16;
var afternoonCloseMinute = 30;

var isOpen;
if (
(currentHour > morningOpenHour || (currentHour == morningOpenHour && currentMinute >= morningOpenMinute)) &&
(currentHour < morningCloseHour || (currentHour == morningCloseHour && currentMinute <= morningCloseMinute))
) {
isOpen = true;
} else if (
(currentHour > afternoonOpenHour || (currentHour == afternoonOpenHour && currentMinute >= afternoonOpenMinute)) &&
(currentHour < afternoonCloseHour || (currentHour == afternoonCloseHour && currentMinute <= afternoonCloseMinute))
) {
isOpen = true;
} else {
isOpen = false;
}


var openStatus = isOpen ? "<span style='color: green;'>Đang mở cửa</span>" : "<span style='color: red;'>Đang đóng cửa</span>";

    marker.bindPopup("<div style='font-size: 14px;'><b>" + title + "<br>Địa chỉ:</b>" + dc + "<br>"  + openStatus + "</div>");

    markersLayer.addLayer(marker);

}


function searchMarkerById(id) {
    for (var i = 0; i < data.length; i++) {
        if (data[i].s_id == id) {
            var marker = markersLayer.getLayers()[i];

            map.flyTo(marker.getLatLng(), 18);
            marker.openPopup();
            break;
        }
    }
}

var routingControl = null;

if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(function (position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    var currentLocation = L.latLng(latitude, longitude);

    // Tạo marker cho vị trí hiện tại
    var currentMarker = L.marker(currentLocation).addTo(map);
    currentMarker.bindPopup("<div style='font-size: 14px;'>Vị trí hiện tại của bạn </div>").openPopup();
    currentMarkerr.bindPopup();
    routingControl = L.Routing.control({
        waypoints: [
            currentLocation
        ],
        routeWhileDragging: true
    }).addTo(map);
});
} else {
alert("Trình duyệt của bạn không hỗ trợ Geolocation.");
}


</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var storeItems = document.getElementsByClassName("store-item");
    var searchInput = document.getElementById("store-search");
    searchInput.addEventListener("input", function () {
        var query = removeDiacritics(this.value.toLowerCase());
        var searchWords = query.split(" ");
        for (var i = 0; i < storeItems.length; i++) {
            var storeName = removeDiacritics(storeItems[i].getAttribute("data-store-name").toLowerCase());
            var displayStore = true;
            for (var j = 0; j < searchWords.length; j++) {
                var searchWord = searchWords[j];
                if (!storeName.includes(searchWord)) {
                    displayStore = false;
                    break;
                }
            }
            if (displayStore) {
                storeItems[i].style.display = "block";
            } else {
                storeItems[i].style.display = "none";
            }
        }
    });
});
function removeDiacritics(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}
</script>

<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    var storeItems = document.getElementsByClassName("store-item");
    var searchInput = document.getElementById("store-search");
    searchInput.addEventListener("input", function () {
        var query = removeDiacritics(this.value.toLowerCase());
        for (var i = 0; i < storeItems.length; i++) {
            var storeName = removeDiacritics(storeItems[i].getAttribute("data-store-name").toLowerCase());
            if (storeName.startsWith(query)) {
                storeItems[i].style.display = "block";
            } else {
                storeItems[i].style.display = "none";
            }
        }
    });
});
function removeDiacritics(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}
</script> -->


</body>

</html>