<?php
    include ('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Table</h1>
        <br><br>
        <?php 
            $id_table = $_GET['id_table'];

            $sql = "SELECT * FROM tbl_meja WHERE id_table = '$id_table'";

            $res = mysqli_query($conn, $sql);

            if($res == true){
                $counting = mysqli_num_rows($res);

                if($counting == 1){
                    $baris = mysqli_fetch_assoc($res);
                    $id_tbl = $baris['id_table'];
                    $password = $baris['password'];
                    $status = $baris['status'];
                } else {
                    header ('location:'.SITEURL.'admin/manage-table.php');
                }
            }
        
        ?>
        <form action="" method="POST" >
            <table class="tbl-30">
                <tr>
                    <td>ID Table: </td>
                    <!-- <td><b><?php //echo $id_tbl;?></b></td> -->
                    <td>
                    <input type="text" name="id_table" value="<?php echo $id_tbl;?>"required>
                    </td>
                </tr>
                <!-- <tr>
                    <td>New Password: </td>
                    <td><input type="password" id="password" required>
                </td> -->
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status == true) {echo "selected";}?> value="True"> True</option>
                            <option <?php if($status == false) {echo "selected";}?> value="False"> False</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan ="2">
                        <input type="submit" name="submit" value="Update Table" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            if(isset($_POST['submit'])){

                $id_tbl = $_POST['id_table'];
                $password = md5($_POST['password']);
                $status = $_POST['status'];

                $sqli = "UPDATE tbl_meja SET id_table = '$id_tbl', password = '$password', status = '$status' WHERE id_table = '$id_table'";

                $resq = mysqli_query($conn, $sqli);

                if($resq == true){
                            //Berhasil di perbaruio
                    $_SESSION['update'] = "<div class='sukses'>Table successfully updated</div>";
                    header('location:'.SITEURL.'admin/manage-table.php');
                }else{
                    //Gagal di perbarui
                    $_SESSION['update'] = "<div class='eror'>Failed to update table</div>";
                    header('location:'.SITEURL.'admin/manage-table.php');
                }
                
            }
        ?>
    </div>
</div>

<?php include("partials/footer.php")?>