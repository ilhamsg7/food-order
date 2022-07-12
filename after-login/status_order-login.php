<?php 
    ob_start();
    // include('checking/menu.php');\<?php
    include('checking/constants.php');
    // include('login-cust-check.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>An-Dox Official Website | Status Order</title>
    <!-- <meta http-equiv="refresh" content="60"/> -->
    <!-- Link our CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/modalstyle.css">
    <link rel="stylesheet" href="../css/menustyle.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="../css/stylestatus.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Bootstrap untuk invoice -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/Resto-Light.ico">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../script/menuscript.js"></script>
    <script type="text/javascript">
        function autoRefresh() {
            window.location = window.location.href;
        }
        setInterval('autoRefresh()', 60000, window.scrollTo(0,0));
    </script>
</head>
            <!-- Sintaks untuk menghapus cookie di website -->
<script>
		function delete_cookie( name, path, domain ) {
			if( get_cookie( name ) ) {
				document.cookie = name + "=" +
				((path) ? ";path="+path:"")+
				((domain)?";domain="+domain:"") +
				";expires=Thu, 01 Jan 1970 00:00:01 GMT";
			}
			}

		function get_cookie(name){
				return document.cookie.split(';').some(c => {
					return c.trim().startsWith(name + '=');
				});
		}
       
</script>
<?php
    //Check wether order is set or not
    if(isset($_GET['order_id'])){
        //Get the food id and details of the selected foof
        // $_SESSION['cust'] = $id_tbl;
        $order_id = $_GET['order_id'];
        // $id_tbl = $_GET['id_table'];
        // $price_total = $_GET['price_total'];
        //Get the details of the selected food
        // $sql = "SELECT * FROM tbl_order WHERE id_table= $id_tbl";
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
            $delivered_date = $row2['delivered_date'];
			$status = $row2['status'];
			$customer_name = $row2['customer_name'];
			$customer_address = $row2['customer_address'];
			$customer_contact  = $row2['customer_contact'];
        }else{
            //Akan terhubung ke halaman utama
            header('location:'.SITEURL);
            // header('location:'.SITEURL.'after-login/index-login.php');
        }
    }else{
        $_SESSION['please-order'] = "<div class='eror text-center'>Not yet order</div>";
        header('location:'.SITEURL.'after-login/index-login.php');
    }
?>
<body> 

    <!-- Navbar Section Starts Here -->
    <div class="content sticky-top">
        <div class="topnav" id="myTopnav">
            <div class="top" data-aos="fade-down" data-aos-duration="1500">
                    <img src="../images/Resto Dark 2.png" alt="Restaurant Logo" class="item a images" style="height: 95px;">
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
                <button onclick="signout()" class="btn-primer button">Yes</button>
                <button id="modal-skip" class="btn-seken button">No</button>
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

        function signout(){
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
    <section class="food-menu">
            <div class="container">
                <h2 class="text-center title">Order Status</h2>
                    <div class="status text-center" style="background-color: #E00543;"><?php echo $status;?></div><br>
                    <!-- Checking Queue -->
                <?php
                    //Proses penghitungan total antrian
                    // $sql2 = "SELECT * FROM tbl_order WHERE status != 'Delivered' AND id < '$order_id' AND id_table != '$id_table'";
                    $sql2 = "SELECT * FROM tbl_order WHERE status != 'Delivered' AND status != 'TIMEOUT' AND id < '$order_id' AND 
                    id_table != '$id_table'";
                    $res2 = mysqli_query($conn, $sql2);
                    $countId = 0;
                    if ($res2 == true) {
                        $count2 = mysqli_num_rows($res2);
                        $x = 0;
                        $idTable = $row2['id_table'];

                        while ($row2 = mysqli_fetch_array($res2)) {
                            $idTable = $row2['id_table'];

                           
                            if ($countId == 0) {
                                if ($idTable != $id_table) {
                                    $countId++;
                                }
                            }else{
                                if($idTable != $idTable2){
                                    $countId++;
                                }
                            }
                            $idTable2 = $row2['id_table'];
                            $x++;
                        }
                        
                    }

                    if ($status != "Delivered" && $status != "Timeout") {
                        ?>
                        <meta http-equiv="refresh" content="59" />
                        <h2 class="text-center" id="queueStatus">Queue Status</h2> 
                            <div class="status text-center" id="queueStatus" ><?php echo $countId; ?></div><br>
                        <?php
                    //  Jika status = deliverd, maka akan refresh selama 59 detik sekali
                    }else{
                        ?>
                        <meta http-equiv="refresh" content="59" />
                        <h2 class="text-center" id="timeStatus">Time Status</h2>        

                 <?php
                    //Timezone
                    if (function_exists('date_default_timezone_set')) {
                        date_default_timezone_set('Asia/Jakarta');
                    }   
                    
                    //Jika delivered_date belum terisi
                    if ($delivered_date == null) {
                        $sql5 = "SELECT * FROM tbl_order WHERE id=$order_id";
                        $res5 = mysqli_query($conn, $sql5);
                        
                        if ($res5 == true) {
                            $dtNow = date('Y-m-d H:i:s');
                       
                            $sql3 = "UPDATE tbl_order SET delivered_date = '$dtNow' WHERE status = 'Delivered' AND id = '$order_id'";
                                        
                            $res3 = mysqli_query($conn, $sql3);

                            $sql4 = "SELECT * FROM tbl_order WHERE id=$order_id";
                            $res4 = mysqli_query($conn, $sql4);

                            $row4 = mysqli_fetch_assoc($res4);
                            $dateNow = date('M d, Y H:i:s', strtotime($row4["delivered_date"]));
                         
                            // Menambagkan jam
                            if ($res3 == true) {
                                if (function_exists('date_default_timezone_set')) {
                                    date_default_timezone_set('Asia/Jakarta');
                                }
                                $date = date_create($dateNow);
                                date_add($date, date_interval_create_from_date_string('29 minutes'));
                                //Menyimpan hasil penambahan serta mengatur format hari agar bisa di ekseskusi di js
                                $time = date_format($date, 'M d, Y H:i:s');

                            $sql5 = "UPDATE tbl_order SET timeout = '$time' WHERE status = 'Delivered' AND id = '$order_id'";
                            $res5 = mysqli_query($conn, $sql5);

                            } else {
                                ?>
                                        <script>
                                            alert("eror");
                                        </script>
                                    <?php
                            }
                        }
                        else {
                            ?>
                                    <script>
                                        alert("eror");
                                    </script>
                                <?php
                        }
                    }else{

                        //Jika deliverd date sudah terisi
                            $sql4 = "SELECT * FROM tbl_order WHERE id=$order_id";
                            $res4 = mysqli_query($conn, $sql4);
                            
                            $row4 = mysqli_fetch_assoc($res4);
                            $dateNow = date('M d, Y H:i:s', strtotime($row4["delivered_date"]));
                           
                            if ($res4 == true) {
                                if (function_exists('date_default_timezone_set')) {
                                    date_default_timezone_set('Asia/Jakarta');
                                }
                                $date = date_create($dateNow);
                                date_add($date, date_interval_create_from_date_string('29 minutes'));
                                //Menyimpan hasil penambahan serta mengatur format hari agar bisa di ekseskusi di js
                                $time = date_format($date, 'M d, Y H:i:s');
                            }
                            $time2 =  date_format($date, 'Y-m-d H:i:s');
                            $sql5 = "UPDATE tbl_order SET timeout = '$time2' WHERE id = '$order_id'";
                            $res5 = mysqli_query($conn, $sql5);
                        }
                        ?>
                                    
                        <div class="status text-center" id="demo" >

                        <!-- Proses menambah waktu -->
                        <script>
                            //Menyimpan tanggal sekarang dalam variabel
                            var dateOrder = new Date();

                            //Menyimpan tanggal yang ditambah 29 menit
                            var countDownDate = new Date('<?php echo $time; ?>');
                            //document.write(countDownDate);

                            // Deklarasi variabel
                            var minutes = 40;
                            var seconds = 60;
                            if(minutes > 0){
                                    var distance = countDownDate - dateOrder;
                                    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

                            }
                            var x = setInterval(function() {

                                seconds--; 
                                    if(seconds == 0 ){
                                        seconds = 59;
                                        minutes--;
                                    }
                                
                                // Perhitungan waktu untuk hari, jam, menit dan detik
                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  
                                // Keluarkan hasil dalam elemen dengan id = "demo"
                                document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
                                    
                                    if (minutes <=0) {
                                        clearInterval(x);
                                        document.getElementById("demo").innerHTML = "TIMEOUT";
                                        document.cookie="menit="+minutes;
                                    }
                                    
                            }, 1000);

                        </script>      
                    </div><br>     
                    <?php
                    }
                 ?>
                  <?php
                    // Menyimpan cooke menit dalam variabel minute
                    $minute = (int)$_COOKIE['menit'];
                    
                    // Memberikan batasan jika $minute kurang dari 0 menit
                    if($minute < 0){
                        $sql7 = "UPDATE tbl_order SET status = 'TIMEOUT' WHERE id_table = '$id_table' AND status = 'Delivered'";
                    // Proses eksekusi
                       $res7 = mysqli_query($conn, $sql7);
                        $sql8 = "UPDATE tbl_meja SET sensor = false AND status = false WHERE id_table = '$id_table'";
                    // Proses eksekusi
                       $res8 = mysqli_query($conn, $sql8);
                    }
                   
                    ?>
                   
                    <?php
                    if($status == "TIMEOUT")
                    {
                    ?>
                        <style>
                            #timeStatus {
                                display: none;
                            }
                            #demo {
                                display: none;
                            }
                            #queueStatus{
                                display: none;
                            }
                        </style>

                        <script>
                            // Menghapus cookie menit apabila status pemesanan = Timeout
                            var menit = "<?php echo $minute;?>";
                            delete_cookie("menit",menit,"localhost");
                            window.location.href="<?php echo SITEURL;?>after-login/cust-logout.php";
                            // window.location.href="https://www.an-dox.com/after-login/cust-logout.php";
                            alert(Swal.fire({
                                icon: 'success',
                                title: 'Thank you for the order, See you!!',
                                showConfirmButton: false,
                                timer: 1500
                            }));
                            // window.location.href="https://www.an-dox.com/after-login/cust-logout.php";
                            // alert('Thank you for the order, See you!!');
                           
                         </script>

                    <?php
                   
                    }
                 ?>
        <div class="refresh text-center" value="Reload" onClick="document.location.reload(true)">Refresh</div>

            <script>
                    function reloadpage()
                    {
                        location.reload()
                    }
            </script>
                <br>
                <div class="clearfix"></div>
            </div>

    </section>

        <!-- fOOD Menu Section Ends Here -->
        <br>
        
        <!-- <form action="" method="post"> -->
     
        <div class="container"  >
     
        <div class="container" id="print">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 body-main">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4"> <img height="125px" class="imgPrint" alt="Invoce Template" src="../images/Resto Light.png" /> </div>
                            <div class="col-md-8 text-right">
                                <h4 style="color: #F81D2D;"><strong>RESTAURANT</strong></h4>
                                <p>Malang, Indonesia</p>
                                <p>1800-234-124</p>
                                <p>restaurant@gmail.com</p>
                            </div>
                        </div> <br />
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>INVOICE</h2>    
                            </div>
                            <div class="col-md-12 text-left">
                                <h5 style="color: #F81D2D;"><?php echo $id.$id_table;?></h5>
                                <p><?php echo $customer_name;?></p>
                                <p><?php echo $customer_contact;?></p>
                                <p><?php echo $customer_address;?></p>
                            </div>
                        </div> <br />
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h5>Description</h5>
                                        </th>
                                        <th>
                                            <h5>Qty</h5>
                                        </th>
                                        <th>
                                            <h5>Price</h5>
                                        </th>
                                        <th>
                                            <h5>Amount</h5>
                                        </th>
                                    </tr>
                                </thead>

                                <?php
                                //Proses pembuatan nota
                                $sql6 = "SELECT * FROM tbl_order WHERE order_date = '$order_date' && id_table = '$id_table'";
                                $res6 = mysqli_query($conn, $sql6);
                                $count6 = mysqli_num_rows($res6);
                                $y = 0;
                                $total = 0;
                                while($row6 = mysqli_fetch_array($res6)){
                                    $food = $row6['food'];
                                    $qty = $row6['qty'];
                                    $price = $row6['price'];
                                    $subtotal = $row6['total'];
                                    $total+=$subtotal;
                                
                                ?>
                                    <tbody>
                                        <tr>
                                            <td class="col-md-6"><?php echo $food;?></td>
                                            <td class="col-md-3">&emsp;&nbsp;&nbsp;<?php echo $qty;?></td>
                                            <td class="col-md-3">&emsp;&nbsp;&nbsp;<?php echo $price;?></td>
                                            <td class="col-md-6"><i area-hidden="true"></i> Rp. <?php echo number_format($subtotal, ((int) $subtotal == $subtotal ? 0 : 2), '.', ',');?> </td>
                                        </tr>
                                    <?php
                                
                                }
                                ?>  
                                    <tr>
                                       
                                    </tr>
                                    <tr style="color: #F81D2D;">
                                        <td></td>
                                        <td></td>
                                        <td class="text-right">
                                            <h6><strong>Total:</strong></h6>
                                        </td>
                                        <td class="text-left">
                                            <h6><strong><i area-hidden="true"></i> Rp. <?php echo number_format($total, ((int) $total == $total ? 0 : 2), '.', ',');?></strong></h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <script>
                            function printContent(el){
                                // "<style type='text/css'>#btn-print{display:none;}</style>";
                                document.getElementById("btn-print").style.display = "none"
                                // document.getElementById("btn-print")
                                var restorepage = document.body.innerHTML;
                                var printcontent = document.getElementById(el).innerHTML;
                                document.body.innerHTML = printcontent;
                                window.print();
                                document.body.innerHTML = restorepage;
                                document.getElementById("btn-print").style.display = "block"
                            }
                        </script>
                        
                            <div class="col-md-12">
                                <p><b>Date :</b> <?php echo $order_date;?></p> <br />
                                <!-- <p><b>Signature</b></p> -->
                            <input type="submit" style="background-color: #E00543;"  onclick="printContent('print')" class="btnPrint" id="btn-print" value="Print">
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
            AOS.init();
    </script>
    <!-- Navbar Section Ends Here -->
     <!-- footer Section Starts Here -->
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
    <!-- footer Section Ends Here -->
    <script src="/BS/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function autoRefresh() {
            window.location = window.location.href;
        }
        setInterval('autoRefresh()', 60000, window.scrollTo(0,0));
    </script>
</body>