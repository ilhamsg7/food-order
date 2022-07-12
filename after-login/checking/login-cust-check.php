<?php 
    if(!isset($_SESSION['customer'])){
       $_SESSION['auto-login-cust'] = "<div class='eror text-center'>Please Login First </div>";
        header ("location:".SITEURL.'after-login/customer-login.php');
    }
?>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
<!--<//?php -->
<!--    if(!isset($_SESSION['customer'])){-->
<!--        $_SESSION['auto-login-cust'] = -->
<!--        "<script>-->
<!--            Swal.fire({-->
<!--                icon: 'error',-->
<!--                title: 'Failed to Order',-->
<!--                text: 'Please Login First!',-->
<!--            })-->
<!--        </script>";-->
<!--        header("location:".SITEURL."after-login/customer-login.php");-->
<!--    }-->
<!--?>-->