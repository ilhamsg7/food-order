<?php
    include('../config/constants.php');
    include('login-cust-check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Website of An-Dox | Order Status</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/modalstyle.css">
    <link rel="stylesheet" href="../css/menustyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/Resto-Light.ico">
    <script src="../script/menuscript.js"></script>
</head>
<?php
    //Check wether order is set or not
    if(isset($_GET['order_id'])){
        //Get the food id and details of the selected foof
        $order_id = $_GET['order_id'];
        //Get the details of the selected food
        $sql = "SELECT * FROM tbl_order WHERE id=$order_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row2 = mysqli_fetch_assoc($res);
            $id = $row2['id'];
			$food = $row2['food'];
			$id_table = $row2['id_table'];
			$price = $row2['price'];
			$qty = $row2['qty'];
			$total = $row2['total'];
			$order_date = $row2['order_date'];
			$status = $row2['status'];
			$customer_name = $row2['customer_name'];
			$customer_address = $row2['customer_address'];
			$customer_contact  = $row2['customer_contact'];
        }else{
            //Akan terhubung ke halaman utama
            header('location:'.SITEURL);
        }
    }else{
        header('location:'.SITEURL);
    }
?>

<body>
    <!-- Navbar Section Starts Here -->
    <div class="content sticky-top">
        <div class="topnav" id="myTopnav">
            <div class="top" data-aos="fade-down" data-aos-duration="1500">
                    <img src="../images/Resto Dark 2.png" alt="Restaurant Logo" class="item a images">
                    <a class="item a b" href="<?php echo SITEURL;?>after-order/index-order.php?order_id=<?php echo $id;?>">Home</a>
                    <a class="item a b" href="<?php echo SITEURL;?>after-login/status_order-login.php?order_id=<?php echo $id;?>">Ordered Status</a>
                    <a class="item a b cart" href="<?php echo SITEURL; ?>after-order/cart-order.php?order_id=<?php echo $id;?>"> <i class="fa fa-shopping-cart">
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
                    <a href="javascript:void(0);" class="a icon item" onclick="myFunction()">
                        <i class="fa fa-bars"></i>
                    </a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- Modal -->
    <div class="modal" id="modal" style="z-index: 1;">
        <div class="modal__container" id="modal__container">
            <h1>Log Out</h1>
            <p>Are you sure you want to log-out?</p>
            <div class="modal__buttons">
                <button onclick="logout()" class="btn-primer button">Yes</button>
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
    <!-- Navbar Section Ends Here -->

   