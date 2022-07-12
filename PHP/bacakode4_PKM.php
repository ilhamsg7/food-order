<?php 

    $koneksi = mysqli_connect("localhost","u1035172_privacy_owner","lazarus_mission","u1035172_food_order");
    $sql = mysqli_query($koneksi,"SELECT keyword FROM tbl_meja WHERE id_table ='M4'");
    $ambil = mysqli_fetch_array($sql);
    $kode4 = $ambil['keyword'];
    // response 
    echo "$kode4";
?>