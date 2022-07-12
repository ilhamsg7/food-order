<?php 
    include ('../config/constants.php');
    // if(isset($_GET['id_table'])){
        $id_table = $_GET['id_table'];
        $remove = "DELETE FROM tbl_meja WHERE id_table = '$id_table'";
        $pair = mysqli_query($conn, $remove);
        if($pair == true){
            $_SESSION['delete'] = "<div class='sukses'>Table Successfully Delete</div>";
            header('location:'.SITEURL.'admin/manage-table.php');
        } else {
            $_SESSION['delete'] = "<div class='eror'>Failed to Delete Table</div>";
            header('location:'.SITEURL.'admin/manage-table.php');
        }
    // }
?>