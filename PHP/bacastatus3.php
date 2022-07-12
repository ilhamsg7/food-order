<?php 

    $koneksi = mysqli_connect("localhost","u1035172_privacy_owner","lazarus_mission","u1035172_food_order");
    $sql = mysqli_query($koneksi,"SELECT status FROM tbl_order WHERE id_table ='M3' ORDER BY id DESC LIMIT 1");
    $ambil = mysqli_fetch_array($sql);
    $kode3 = $ambil['status'];
    // response 
    echo "$kode3";
?>