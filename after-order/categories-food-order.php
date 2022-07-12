<?php
    include('../config/constants.php');
    include('checking/login-cust-check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/menustyle.css">
    <link rel="stylesheet" href="../css/modalstyle.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/Resto Light.png">
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
    <div class="modal" id="modal">
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
            window.location.href="<?php echo SITEURL; ?>after-login/customer-login.php";
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
    <script>
 
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
 
</script>
        <script>
                AOS.init();
        </script>
    <!-- Navbar Section Ends Here -->

   
    <?php
        //Check whether id is passed or not
        if(isset($_GET['category_id'])){
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            //Get the category title based on category id
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //Get the value from database
            $row = mysqli_fetch_assoc($res);

            //Get the title
            $category_title = $row['title'];
        }else{
            //Category not passed
            //Redirect to home page
            header('location:'.SITEURL);
        }
    ?>

     <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center" style="background-image:url('../images/BackGround\ IMG.jpg');">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center title">Food Menu</h2>

            <?php
                //Create SQL Query foods based on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //Execute query
                $res2 = mysqli_query($conn, $sql2);
                //Count the rows
                $count2 = mysqli_num_rows($res2);

                //Check whether food is available or not
                if($count2>0){
                    //Food is available
                    while($row2=mysqli_fetch_assoc($res2)){
                        $food_id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $stock = $row2['stock'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];

                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                 <?php
                                    //Check whether image is available or not
                                    if($image_name == ""){
                                        //Display message
                                        echo "<div class='eror'>Image is not available</div>";
                                    }else{
                                        //Image available
                                ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">

                                <?php
                            }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">Rp <?php echo number_format($price, ((int) $price == $price ? 0 : 2), '.', ',');?></p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>


                                <?php
                                if($stock == 0){
                                ?>
                                   <div class="btnStock">Stock Out</div>
                                <?php
                                }else{
                                ?>
                                    <a href="<?php echo SITEURL;?>after-order/order-order.php?order_id=<?php echo $id;?>&food_id=<?php echo $food_id;?>" class="btn btn-primary">Order</a>
                                    <div class="btnStock">Stock : <?php echo $stock;?></div>

                                <?php 
                                }
                            ?>
                                <!-- <a href="<?php echo SITEURL;?>after-login/order-login.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a> -->
                            </div>
                        </div>

                        <?php
                    }
                }else{
                    //Food is not available
                    echo "<div class='eror'>Food not found</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

<?php
    include('../partials-front/footer.php');
?>