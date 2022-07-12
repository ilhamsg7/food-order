<?php 
    ob_start();
    include('checking/menu.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cart Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/cart-style.css">
        <link rel="shortcut icon" href="../images/Icon Restoran.ico"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link rel="stylesheet" href="../css/admin.css">
        <style>
            .images{
                height: 90px;
                margin-bottom: 7px;
            }
        </style>
    </head>
    <body>
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
            <div class="container-fluid mt-4">
                <?php
                    if(isset($_SESSION['update']))
                    {
                            echo $_SESSION['update']; //Display session message
                            unset($_SESSION['update']); //Removing session message
                    }
                    if(isset($_SESSION['delete']))
                    {
                            echo $_SESSION['delete']; //Display session message
                            unset($_SESSION['delete']); //Removing session message
                    }
                    if(isset($_SESSION['submit']))
                    {
                            echo $_SESSION['submit']; //Display session message
                            unset($_SESSION['submit']); //Removing session message
                    }
                    if(isset($_SESSION['order']))
                    {
                            echo $_SESSION['order']; //Display session message
                            unset($_SESSION['order']); //Removing session message
                    }
                ?>
                    <h3 class="mt-2 mb-2 container-fluid">Your Cart</h3>
                    <h4 class="mt-2 container-fluid id_tbl" name="id_tbl" id="id_tbl">ID Table : <?php echo $_SESSION['cust'];?></h4>
                    <table class="table table-striped table-bordered mt-4 container-fluid tabel table-responsive">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Item</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Sub Total Price</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
            <?php   
                    $id_tbl = $_SESSION['cust'];
                    $sql = "SELECT * FROM tbl_cart WHERE id_table = '$id_tbl'";
                    $cek = mysqli_query($conn, $sql);
                    if($cek==true){
                        $count = mysqli_num_rows($cek);
                        $sn = 1;
                        if($count>0){
                            while($row = mysqli_fetch_assoc($cek)){
                                // $id = $_row['id_table'];
                                $id_cart = $row['id_cart'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $subtotal = $qty * $price;
                                $pricetotal += $subtotal; 
            ?>
                            <tbody style="padding: 1%;">
                                <tr class="text-center table-striped" style="vertical-align: middle;">
                                    <td scope="row" class="text-center"><?php echo $sn++ ?></td>
                                    <td name="title"><?php echo $title;?></td>
                                    <td name="qty"><?php echo $qty;?></td>
                                    <td name="price"><?php echo $price;?></td>
                                    <td name="subtotal"><?php echo $subtotal;?></td>
                                    <td>
                                        <a class="btn btn-danger" href="<?php echo SITEURL; ?>after-login/remove-item.php?id_cart=<?php echo $id_cart ;?>" style="vertical-align: middle; background-color: #ff6b81; width: 30%;">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>   
                <?php
                            }
                        } else {
                            echo "<tr><td colspan='12' class='eror text-center'>Cart is Empty</td></tr>";
                        }
                    }
                ?>
                        <tfoot style="padding: 1%;">
                                <tr class="table-striped" style="vertical-align: middle;">
                                <td colspan="5" class="text-lg-start">Total Price</td>
                                <td scope="col-lg-7" class="text-center" name="pricetotal"><?php echo $pricetotal;?></td>
                                </tr>
                        </tfoot>
                </table>

                <?php
                    $sql4 = "SELECT * FROM tbl_order WHERE id='$id'";
                    $res4 = mysqli_query($conn, $sql4);
                    $row4 = mysqli_fetch_assoc($res4);

                    $customer_name = $row4['customer_name'];
                    $customer_contact = $row4['customer_contact'];
                    $customer_address = $row4['customer_address'];
                ?>
                <form method="POST" action="" class="row g-3 mt-4 mb-4" style="padding: 1%;">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Full Name</label><br>
                        <b><?php echo $customer_name;?></b>
                        <input type="hidden" class="form-control" id="full_name" name="full_name" value="<?php echo $customer_name;?>">

                    </div>
                    <div class="col-md-6">
                        <label for="contact" class="form-label">Contact</label><br>
                        <b><?php echo $customer_contact;?></b>
                        <input type="hidden" class="form-control" id="contact" name="contact" value="<?php echo $customer_contact;?>">
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label><br>
                        <b><?php echo $customer_address;?></b>
                        <input type="hidden" class="form-control" id="address" name="address" value="<?php echo $customer_address;?>">    
                        <!-- <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required> -->
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <button type="submit" name="submit" class="btn btn-success input-responsive" style="width: 30%;">Checkout</button>
                    </div>
                </form>
                <?php
                if(isset($_POST['submit'])){
                    //Proses mendapatkan data
                    $id_tbl = $_SESSION['cust'];
                    $insert = "INSERT INTO tbl_order(id_table, food, price, qty, total) SELECT id_table, title, price, qty, sub_total FROM tbl_cart";
                    $check = mysqli_query($conn, $insert);
                             date_default_timezone_set("Asia/Jakarta");
                             $id_order = $_GET['id'];
                             $order_date2 = date("Y-m-d H:i:sa");
                             $status = "Ordered";
                             $customer_name = mysqli_real_escape_string($conn, $_POST['full_name']);
                             $customer_contact  = mysqli_real_escape_string($conn, $_POST['contact']);
                             //Validation number
                             if (strlen($customer_contact)!=12) {
                                ?>
                                <script>
                                    alert('Please input valid phone number');
                                </script>
                                <?php
                                die();
                             }
                             $customer_address = mysqli_real_escape_string($conn, $_POST['address']);
                            //  $sql2 = "UPDATE tbl_order SET status = '$status', order_date = '$order_date2', customer_name = '$customer_name', customer_contact ='$customer_contact', customer_address = '$customer_address' 
                            //  WHERE id_table = '$id_tbl' AND status != 'Delivered'";
                            $sql2 = "UPDATE tbl_order SET status = '$status', order_date = '$order_date2', customer_name = '$customer_name', customer_contact ='$customer_contact', customer_address = '$customer_address' 
                            WHERE id_table = '$id_tbl' AND status != 'Delivered' AND status != 'TIMEOUT'";
                            //proses eksekusi
                            $checking = "SELECT * FROM tbl_order WHERE id = '$id_order'";

                            $res2 = mysqli_query($conn, $sql2);
                            if($res2 == true && $check == true){
                                $id = $_SESSION['cust'];
                                $sqli = "DELETE FROM tbl_cart WHERE id_table = '$id'";
                                $res = mysqli_query($conn, $sqli);
                                //Data akan tersimpan
                                //Proses mengirimkan id
                                        $sql3 = "SELECT * FROM tbl_order WHERE order_date = '$order_date2' AND id_table = '$id_tbl' 
                                        ORDER BY id DESC LIMIT 1";

                                        $res3 = mysqli_query($conn, $sql3);
                                        $count2 = mysqli_num_rows($res3);
                                
                                        $row2 = mysqli_fetch_assoc($res3);
                                          
                                                $id2 = $row2['id'];
                                                
                                                header('location:'.SITEURL.'after-login/status_order-login.php?order_id='.$id2);
                                                die();
                                       
                            } else {
                                //Gagal di simpan
                                $_SESSION['order'] = "<div class = 'eror text-center'>Failed to order food</div>";
                                header("Location: https://www.an-dox.com/food-order/after-login/index-login.php");
                            }
                } 
        ?>
            </div>
            <section class="footer text-center" style="line-height: 50px; margin: auto; background-color: #E00543;">
                <div class="container text-center" style="margin: auto">
                    <center><div class="text-center" id="lang"></div></center>
                    <p style="color:white">Copyright &copy 2021 All rights reserved</p>
                </div>
            </section>
            <!-- footer Section Ends Here -->
            <!-- Menambahkan sintaks js untuk translate -->
            <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

            <!-- Menghilangkan top bar tentang translate -->
            <style type="text/css">iframe.goog-te-banner-frame{ display: none !important;}</style>
            <style type="text/css">body {position: static !important; top:0px !important;}</style>

            <!-- Sintaks untuk translate -->
            <script>
                
                function googleTranslateElementInit(){
                    new google.translate.TranslateElement({PageLanguage:'en'},'lang')
                }
                
            </script>
    <script src="../BS/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../BS/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <?php 
        ob_flush();
    ?>
    <script>
        AOS.init();
    </script>
</body>
</html>