<?php 
    include ('../config/constants.php');
        // $id_tbl = $_SESSION['cust'];
        // $title = $_POST['title'];
        $id_cart = $_GET['id_cart'];
        $del = "DELETE FROM tbl_cart WHERE id_cart = '$id_cart'";
        $res = mysqli_query($conn, $del);
        if($res == true){
            $_SESSION['delete'] = "<div class = 'sukses text-center' style='color:#157347;'>Item Successfully to Delete</div>";
            header("Location: https://www.an-dox.com/food-order/after-login/cart-index.php");
        } else {
            //Gagal di simpan
            $_SESSION['delete'] = "<div class = 'eror text-center' style='color:#E00543;'>Failed to delete</div>";
            header("Location: https://www.an-dox.com/food-order/after-login/cart-index.php");
        }
?>