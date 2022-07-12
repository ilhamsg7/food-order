<?php
    ob_start();
    include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>An-Dox | Customer Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custlogin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="shortcut icon" href="../images/Resto-Light.ico">
    <script src="../script/loginscript.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
    <body>
        <div class="container-fluid">
            <div class="row" style="height: 100vh;">
                <div class="col col-lg-8 nopadding">
                    <div class="slider-container nopadding overflow-hidden">
                        <div class="slider-control left inactive"></div>
                        <div class="slider-control right"></div>
                        <ul class="slider-pagi col-lg-12"></ul>
                        <div class="slider nopadding container overflow-visible container-fluid">
                            <div class="slide slide-0 active">
                                <img src="../images/Slider/Food 1.jpg" class="slide__bg col-lg-12">
                                <div class="slide__content col-lg-12">
                                    <svg class="slide__overlay col-lg-12" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                                        <path class="slide__overlay-path col-lg-12" d="M0,0 150,0 500,405 0,405" />
                                    </svg>
                                    <div class="slide__text col-lg-12">
                                        <p class="slide__text-desc">Rasakan cita rasa khas indonesia</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slide-1 overflow-hidden container-fluid">
                                <img src="../images/Slider/Food 2.jpg" class="slide__bg col-lg-12">
                                <div class="slide__content col-lg-12">
                                    <svg class="slide__overlay col-lg-12" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                                        <path class="slide__overlay-path col-lg-12" d="M0,0 150,0 500,405 0,405" />
                                    </svg>
                                    <div class="slide__text col-lg-12">
                                        <p class="slide__text-desc">Dibuat dari bahan berkualitas yang terjamin kesegarannya</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slide-2 overflow-hidden container-fluid">
                                <img src="../images/Slider/Food 3.jpg" class="slide__bg col-lg-12">
                                <div class="slide__content col-lg-12">
                                    <svg class="slide__overlay col-lg-12" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                                        <path class="slide__overlay-path col-lg-12" d="M0,0 150,0 500,405 0,405" />
                                    </svg>
                                    <div class="slide__text col-lg-12">
                                        <p class="slide__text-desc">Dimasak oleh tangan-tangan handal yang kami miliki</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slide-3 overflow-hidden container-fluid">
                                <img src="../images/Slider/Food 4.jpg" class="slide__bg col-lg-12">
                                <div class="slide__content col-lg-12">
                                    <svg class="slide__overlay col-lg-12" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                                        <path class="slide__overlay-path col-lg-12" d="M0,0 150,0 500,405 0,405" />
                                    </svg>
                                    <div class="slide__text col-lg-12">
                                        <p class="slide__text-desc">Disajikan dengan memperhatikan kenyamanan anda</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 px-5"> 
                    <center><img src="../images/Resto Light.png" class="" style="height:200px;"></center>
                    <center><h4 class="mb-2">Customer Login</h4></center>
                    <?php
                        if(isset($_SESSION['login-cust'])){
                            echo $_SESSION ['login-cust'];
                            unset($_SESSION['login-cust']);
                        }
                        if(isset($_SESSION['auto-login-cust'])){
                            echo $_SESSION ['auto-login-cust'];
                            unset($_SESSION['auto-login-cust']);
                        }
                        if(isset($_SESSION['already-login'])){
                            echo $_SESSION['already-login'];
                            unset($_SESSION['already-login']);
                        }
                    ?>
                <form action="" method="POST">
                    <!-- <div class="col-lg-12 mt-4 txt_field">
                        <label for="id_table" class="form-label" name="id_table"></label>
                        <span></span>
                        <input type="text" class="form-control" id="id_table" name="id_table" placeholder="ID Table" required>
                    </div>
                    <div class="col-lg-12 mb-3 mt-3 txt_field">
                        <label for="password" class="form-label"></label>
                        <span></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div> -->
                    <div class="col-lg-12 mb-3 mt-4 txt_field">
                        <label for="keyword" class="form-label"></label>
                        <span></span>
                        <input type="password" class="form-control" id="keyword" name="keyword" placeholder="Keyword" required>
                    </div>
                    <div class="col mt-4">
                    <input type="submit" name='submit' class="btn btn-primary" value='Login'>
                    <div>
                    <a class="btn btn-danger mt-3" href="<?php echo SITEURL;?>index.php">Back to Menu</a>
                </form>
                <p class="text-center mt-5" style="color: inherit;">Copyright &copy 2021 All Rights Reserved.<br> Developed By - Tim Sistem Pemesanan Makanan 2021</p>
                </div>
            </div>
        </div>
        <script>
            AOS.init();
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../BS/dist/js/bootstrap.bundle.min.js"></script>
        <!-- <script src="../BS/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    </body>
</html>
<?php 
    //Check data dari form login
    if(isset($_POST['submit'])){
        // $id_table= $_POST['id_table'];
        // $password = md5($_POST['password']);
        // $id_table = mysqli_real_escape_string($conn, $_POST['id_table']);
        // $pw = md5($_POST['password']);
        // $password = mysqli_real_escape_string($conn, $pw);
        $keyword = mysqli_escape_string($conn, $_POST['keyword']);

        $periksa = "SELECT * FROM tbl_meja WHERE keyword = '$keyword' AND status = true";
        $koneksi = mysqli_query($conn, $periksa);
        $hitung = mysqli_num_rows($koneksi);
        if($hitung > 0){
            while($row = mysqli_fetch_assoc($koneksi)){
                $idtbl = $row['id_table'];
                $stat = $row['status'];
                $key = $row['keyword'];
                if($keyword == $key && $stat == true){
                    $_SESSION['already-login'] = "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Login',
                            text: 'ID Table Has Already Login!',
                        })
                    </script>";
                    header("location:".SITEURL."after-login/customer-login.php");
                    die();
                } 
            }
        }
        $sql = "SELECT * FROM tbl_meja WHERE keyword = '$keyword'";
        $updt = "UPDATE tbl_meja SET status = true WHERE keyword = '$keyword'";
        $res = mysqli_query($conn, $sql);
        $update = mysqli_query($conn, $updt);
        $count = mysqli_num_rows($res);
        
        if($count==1 && $update == true){
                $row = mysqli_fetch_assoc($res);
                $id_table = $row['id_table'];
                $_SESSION['login-cust'] = "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully Login',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>";
                $_SESSION['cust'] =  $id_table;
                $_SESSION['customer'] = $keyword;
                header('location:'.SITEURL.'after-login/index-login.php');
        } else {
                $_SESSION['login-cust'] = "
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to Login',
                    text: 'Keyword do not match!',
                  })
                </script>";
                header('location:'.SITEURL.'after-login/customer-login.php');
        }
    }
    ob_flush();
?>