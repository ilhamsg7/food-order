<?php
    include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>An-Dox | Official Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/menustyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="images/Resto-Light.ico">
    <link rel="stylesheet" href="css/popup_style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <div class="content sticky-top">
        <div class="topnav" id="myTopnav">
            <div class="top"  data-aos="fade-down" data-aos-duration="1500">
                <img src="images/Resto Dark 2.png" alt="Restaurant Logo" class="item a images">
                    <a class="item a" href="<?php echo SITEURL; ?>">Home</a>
                    <a type="button" href="#" class="item a" onclick="konfirmasi()">Ordered Status</a>
                            <p id="pesan"></p>
                            <script>
                                function konfirmasi(){
                                    alert("Mohon untuk login terlebih dahulu");
                                    window.location.href="https://www.an-dox.com/after-login/customer-login.php";
                                    // document.getElementById("pesan").innerHTML = pesan;
                                }
                            </script>
                    <a class="item a" href="<?php echo SITEURL;?>after-login/customer-login.php">Login</a>
                    <a href="javascript:void(0);" class="a icon item" onclick="myFunction()">
                        <i class="fa fa-bars"></i>
                    </a>
            </div>
        </div>
    </div>
    
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
        /** tambah class active jika di klik */
        var url = window.location;
        // ini untuk menambahkan class active pada menu yg tidak memiliki anak atau single link
        $('ul a').filter(function() {
        return this.href == url;
        }).parent().addClass('active');
        // ini untuk menu beranak, jadi otomatis akan terbuka sesuai dengan link tujuan
        $('ul.treeview-menu a').filter(function() {
        return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
        AOS.init();
    </script>
    <!-- Navbar Section Ends Here -->

   

    <!-- 
        <nav class="navbar" data-aos="fade-down" data-aos-duration="1500">
        <div class="containers" data-aos="fade-down" data-aos-duration="1500"> -->
        <!-- <div class="logos">
                <a href="#" title="Logo" class="navbar-brand">
                    <img src="images/Resto Dark 2.png" alt="Restaurant Logo" class="img-responsives">
                </a>
            </div>
            <div class="pieces" id="pieces">
                <ul>
                    <li>
                        <a href="<?php //echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a onclick="konfirmasi()">Ordered Status</a>
                                <p id="pesan"></p>
                                <script>
                                    function konfirmasi(){
                                    alert("Mohon untuk login terlebih dahulu");
                                    window.location.href="http://localhost/food-order/after-login/customer-login.php";
                                        // document.getElementById("pesan").innerHTML = pesan;
                                    }
                                </script>
                    </li>
                    <li>
                        <a href="<?php //echo SITEURL;?>after-login/customer-login.php">Login</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div> -->
    <!-- </nav>
    <li>
                    <div class="dropdown">
                        <button class="dropbtn" style="font-weight: 400;"><b>Customer</b> <i class="fa fa-caret-down"></i></button>
                            <div class="dropdown-content">
                                <a href="<?php //echo SITEURL;?>after-login/customer-login.php">Login</a>
                                <a onclick="konfirmasi()">Ordered Status</a>
                                    <p id="pesan"></p> -->
                        
                                    <!-- <script>
                                        function konfirmasi(){
                                        alert("Mohon untuk login terlebih dahulu");
                                        window.location.href="http://localhost/food-order/after-login/customer-login.php";
                                    
                                
                                        // document.getElementById("pesan").innerHTML = pesan;
                                    }
                                    </script>
                            </div>
                    </div>
                    </li> 
                    <nav class="navbar" data-aos="fade-down" data-aos-duration="1500">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo" class="navbar-brand">
                    <img src="images/Resto Dark 2.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php //echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a onclick="konfirmasi()">Ordered Status</a>
                                <p id="pesan"></p>
                                <script>
                                    function konfirmasi(){
                                    alert("Mohon untuk login terlebih dahulu");
                                    window.location.href="http://localhost/food-order/after-login/customer-login.php";
                                        // document.getElementById("pesan").innerHTML = pesan;
                                    }
                                </script>
                    </li>
                    <li>
                        <a href="<?php //echo SITEURL;?>after-login/customer-login.php">Login</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
                    </section> 
                
    -->