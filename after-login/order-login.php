<?php
    ob_start();
    include('checking/menu.php'); 
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>An-Dox | Official Website</title>
        <link rel="stylesheet" href="../css/style.css">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/modalstyle.css">
        <script src="../script/menuscript.js"></script>
    </head>
    <body>
<?php
    //Check wether food is set or not
    if(isset($_GET['food_id'])){
        //Get the food id and details of the selected foof
        $food_id = $_GET['food_id'];
        //Get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $stock = $row['stock'];
            $image_name = $row['image_name'];

        }else{
            //Akan terhubung ke halaman utama
            header('location:'.SITEURL.'after-login/index-login.php');
        }
    }else{
        header('location:'.SITEURL.'after-login/index-login.php');
    } ?>  
    <?php 
        if(isset($_SESSION['order']))//Checking whether the session is set or not
        {
            echo $_SESSION['order']; //Display session message
            unset($_SESSION['order']); //Removing session message
        }
?>            
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search" data-aos="zoom-in" data-aos-duration="1200" style="background-image:url('../images/BackGround\ IMG.jpg');">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to <br>confirm your order</h2>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend style="color: white;">Selected Food</legend>

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
                    <div class="food-menu-desc" style="color: white;">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">

                        <p class="food-price">Rp <?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                        <div class="order-label">Id table</div>
                        <p class="food-price"><?php echo $id_table;?></p>
                        <input type="hidden" name="id_table"value="<?php echo $id_table;?>">
                    </div>
                </fieldset>
                <fieldset>
                    <legend style="color: white;">Delivery Details</legend>
                    <input type="submit" name="submit" data-target="#notif" data-toogler="modal" value="Add to Cart" class="btn btn-primary">
                </fieldset>
            </form>
            <div class="modal" id="notif">
                <div class="modal__container" id="modal__container">
                    <h1>Succesfully</h1>
                    <p>Succesfully to Added Item Into Cart</p>
                    <div class="modal__buttons">
                        <button id="notif-skip" class="btn-secondary button">Ok</button>
                    </div>
                </div>
            </div>
            <?php
                //Cek apakah tombol submit berhasil di clik
                if(isset($_POST['submit'])){
                    //Proses mendapatkan data
                    $id = $_GET['id_cart'];
                    $id_tbl = $_POST['id_table'];
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $sub_total = $price * $qty;
                    // $total = $price * $qty; // Menghitung total
                    date_default_timezone_set("Asia/Jakarta");
                    $stock2 = $stock-$qty;
                    if ($stock2 < 0) {
                        echo
                       "<script>
                        alert('Food stocks are not enough');
                        </script>";
                    die();
                    }

                    $sql4 = "UPDATE tbl_food SET stock = '$stock2' where id='$food_id'";
                    $res4 = mysqli_query($conn, $sql4);
                        $sqli = "SELECT * FROM tbl_cart WHERE title = '$food' AND id_table = '$id_tbl'";
                        $qry = mysqli_query($conn, $sqli);
                        $rowCheck = mysqli_num_rows($qry);
                        //If data exist in table
                        if($rowCheck > 0) {
                            $update = "UPDATE tbl_cart SET qty = '$qty' WHERE id_table = '$id_tbl' AND title = '$food'";
                            $change = mysqli_query($conn, $update);
                            if($change == true){
                                // echo "<script>
                                // alert('Food successfully added')
                                // </script>";
                                echo "<script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success add to Cart',
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                    </script>";
                                // header('location:'.SITEURL.'after-login/index-login.php');
                            } else {
                                //Gagal di simpan
                                $_SESSION['order'] = "<div class = 'eror text-center'>Failed to added food</div>";
                                header('location:'.SITEURL.'after-login/index-login.php');
                            }
                        } else {
                            $sql2 = "INSERT INTO tbl_cart(id_table, title, price, qty, sub_total) 
                            VALUES('$id_tbl','$food', '$price', '$qty', '$sub_total')";
                            //proses eksekusi
                            $res2 = mysqli_query($conn, $sql2);
                            if($res2 == true){
                                echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                            $('#notif').modal('show')
                                        });
                                    </script>";
                                // echo '<script type="text/javascript">';
                                // echo '$(document).ready(function(){';
                                // echo '$("#notif").modal("show");';
                                // echo  '});';
                                // echo '</script>';
                                // echo "<script>
                                // alert('Food successfully added')
                                // </script>";
                                // header('location:'.SITEURL.'after-login/index-login.php');
                                //Data akan tersimpan
                            } else {
                                //Gagal di simpan
                                $_SESSION['order'] = "<div class = 'eror text-center'>Failed to added food</div>";
                                header('location:'.SITEURL.'after-login/index-login.php');
                            }
                        }
                    } 
               ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- social Section Starts Here -->
    <!-- <section class="social">
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
    </section> -->
    <script>
        function panggil(){
            const btnModal = document.getElementById("notif_btn");
            const modal = document.getElementById("notif");
            const btnSkip = document.getElementById("notif-skip");
            btnModal.onclick = function() {
            notif.classList.add("modal-visible");
            }
            btnSkip.addEventListener("click", () => {
                notif.classList.remove("modal-visible");
            });
        }
        const btnModal = document.getElementById("notif_btn");
        const modal = document.getElementById("notif");
        const btnSkip = document.getElementById("notif-skip");
        btnModal.onclick = function() {
            notif.classList.add("modal-visible");
        }
        btnSkip.addEventListener("click", () => {
            notif.classList.remove("modal-visible");
        });
    </script>
    <!-- social Section Ends Here -->
<?php
    include('../partials-front/footer.php');
    ob_flush();
?>