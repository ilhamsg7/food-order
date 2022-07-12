<!--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
<!--//<//?//php -->
    // include('checking/menu.php'); 
<!--        //include('../config/constants.php');-->
<!--        //if(isset($_SESSION['cust']) || isset($_SESSION['customer'])){-->
            // //$id_table = $_SESSION['cust'];
<!--            //$keyword = $_SESSION['customer'];-->
            ////echo //$id2;     
<!--        //}-->
<!--       // $turn = "UPDATE tbl_meja SET status = false WHERE keyword = '$keyword'";-->
<!--        //$periksa = mysqli_query($conn, $turn);-->
<!--        //if($periksa == true){-->
<!--            //$_SESSION['login-cust'] = "<div class='text-center sukses' style='color:#2ed573;'>Thank You</div>";-->
<!--            //header("location:".SITEURL."after-login/customer-login.php");-->
<!--        //} -->
<!--//?>-->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
    // include('checking/menu.php'); 
        include('../config/constants.php');
        if(isset($_SESSION['cust']) || isset($_SESSION['customer'])){
            // $id_table = $_SESSION['cust'];
            $keyword = $_SESSION['customer'];
            //echo $id2;     
        }
        function keyword_generator(
            int $length = 5,
            string $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'
        ): string {
            if ($length < 1) {
                throw new \RangeException("Length must be a positive integer");
            }
            $pieces = [];
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $pieces []= $keyspace[random_int(0, $max)];
            }
            return implode('', $pieces);
        }
        $generate = keyword_generator(5);
        $id_table = $_GET['id_table'];
        $turn = "UPDATE tbl_meja SET status = false, sensor = false, keyword = '$generate' WHERE keyword = '$keyword'";
        $periksa = mysqli_query($conn, $turn);
        if($periksa == true){
            $_SESSION['login-cust'] = "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thank You',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>";
            header("location:".SITEURL."after-login/customer-login.php");
        } 
?>