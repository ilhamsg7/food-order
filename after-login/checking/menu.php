<?php
    include('../config/constants.php');
    include('login-cust-check.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title>Restaurant Website</title> -->
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/modalstyle.css">
    <link rel="stylesheet" href="../css/menustyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/Resto-Light.ico">
    <script src="/script/menuscript.js"></script>
</head>

<body>
    <?php
        if(isset($_SESSION['cust'])){
        $id_table = $_SESSION['cust'];
        //echo $id2;     
        }

        if(isset($_SESSION['customer'])){
            $keyword = $_SESSION['customer'];
        }
    ?>
    <!-- Navbar Section Starts Here -->
    <div class="content sticky-top">
        <div class="topnav" id="myTopnav">
            <div class="top" data-aos="fade-down" data-aos-duration="1500">
                    <img src="../images/Resto Dark 2.png" alt="Restaurant Logo" class="item a images">
                    <a class="item a b" href="<?php echo SITEURL; ?>after-login/index-login.php">Home</a>
                    <a class="item a b" href="<?php echo SITEURL; ?>after-login/status_order-login.php">Ordered Status</a>
                    <a class="item a b cart" href="<?php echo SITEURL; ?>after-login/cart-index.php"> <i class="fa fa-shopping-cart">
                            <!-- <?php
                                // $_SESSION['cust'] = $id_table;
                                // $sq = "SELECT COUNT(qty) FROM tbl_cart WHERE id_table = $id_table";
                                // $practice = mysqli_query($conn, $sq);
                                // $qual = mysqli_num_rows($practice);
                                // if($qual > 0){
                                //     while($baris = mysqli_fetch_assoc($practice)){
                                //         $quantity = $baris['qty'];
                                //         echo $quantity;
                                //     }
                                // } else {
                                //     echo 0;
                                // }
                            ?> -->
                        </i>
                    </a>
                    <a href="#" id="modal_btn" data-toggle="modal" data-target="#modal" type="button" class="item a b">Logout</a>
                    <!-- <script>
                        onclick="show_modal()" 
                                function konfirmasi(){
                                    var tanya = $('#modal').modal("show");
                                    // if(tanya == true) {
                                    //     window.location.href="http://localhost/food-order/after-login/customer-login.php";
                                    // }else{
                                    // return this.href == window.location;
                                    // }
                                    // document.getElementById("pesan").innerHTML = pesan;
                                }
                    </script> -->
                    <a href="javascript:void(0);" class="a icon item" onclick="myFunction()">
                        <i class="fa fa-bars"></i>
                    </a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- Modal -->
    <div class="modal" id="modal">
        <div class="modal__container" id="modal__container">
            <h1>Log Out</h1>
            <p>Are you sure you want to log-out?</p>
            <div class="modal__buttons">
                <button onclick="logout()" type="submit" name="submit" class="btn-primer button">Yes</button>
                <button id="modal-skip" class="btn-secondary button">No</button>
            </div>
        </div>
    </div>
    <script>
        const btnModal = document.getElementById("modal_btn");
        const modal = document.getElementById("modal");
        const btnSkip = document.getElementById("modal-skip");
        btnModal.onclick = function() {
            modal.classList.add("modal-visible");
        }
        btnSkip.addEventListener("click", () => {
            modal.classList.remove("modal-visible");
        });

        function logout(){
            window.location.href="<?php echo SITEURL;?>after-login/cust-logout.php";
        }
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
        AOS.init();
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script> -->
    <!-- Navbar Section Ends Here -->

   