<?php 
  // koneksi ke database

  $koneksi = mysqli_connect("localhost","u1035172_privacy_owner","lazarus_mission","u1035172_food_order");
  // baca data yang dikirim esp32
  //$value = $_GET['sensor1'];
  // update data ke database
 // $data = mysqli_query($koneksi,"update sensor_pkm set Sensor='$value' where ID ='1' ");
  
  if (isset($_GET['sensor1']))
  {
    $value = $_GET['sensor1'];
       // mysqli_query($koneksi,"update sensor_pkm set Sensor='$value' where ID ='1' ");
       $data = mysqli_query($koneksi,"update tbl_meja set sensor='$value' where id_table ='M1' ");
       if($data)
       {
          echo "data done save\n";
       }
  }
  else{
         echo "0\n";
  }
     if($koneksi)
         {
            echo "Succes Connection!";
         } 
         else { 
             echo "failed";
        }

    mysqli_close($koneksi);
?>

