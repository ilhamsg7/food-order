<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Table</h1>
        <meta http-equiv="refresh" content="30" />
        <br><br>
        <a href="<?php echo SITEURL;?>admin/add-table.php" class="btn-primary">Add Table</a>
        <br><br><br>
        <?php 
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <?php 
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        ?>
        <?php 
            if(isset($_SESSION['random-text'])){
                echo $_SESSION['random-text'];
                unset($_SESSION['random-text']);
            }
        ?>
        <?php 
            if(isset($_SESSION['unauthorized'])){
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }
        ?>
        <table class="tbl-full">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col" class="text-center">Id Table</th>
                    <th scope="col">Status Sensor</th>
                    <th scope="col">Status</th>
                    <th scope="col">Keyword</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        <?php 
            $query = "SELECT * FROM tbl_meja";
            $connect = mysqli_query($conn, $query);
            if($connect == true){
                $count = mysqli_num_rows($connect);
                $num = 1;
                if($count > 0){
                    while($baris = mysqli_fetch_assoc($connect)){
                        $id_table = $baris['id_table'];
                        $sensor = $baris['sensor'];
                        $status = $baris['status'];
                        $keyword = $baris['keyword'];
                        
                    ?>
                <tbody>
                    <tr>
                        <td scope="row" class="text-center"><?php echo $num++; ?></td>
                        <td class="text-center"><?php echo $id_table;?></td>
                 
                    
                    <?php 
                            if($sensor == false){
                                
                                // $sql2 = "UPDATE tbl_meja SET status = false WHERE id_table = '$id_table'";
                                    //Proses eksekusi
                                // $res2 = mysqli_query($conn, $sql2);
                                   
                                // header("Refresh:0");
                                // $status = false;
                    ?>
                                <td class="eror text-center">Inactive</td>
                    <?php
                            } else {
                                //   $sql2 = "UPDATE tbl_meja SET status = true WHERE id_table = '$id_table'";
                                    //Proses eksekusi
                                //  $res2 = mysqli_query($conn, $sql2);
                                   
                                // header("Refresh:0");
                                 
                    ?>
                                <td class="sukses text-center">Active</td>
                                
                    <?php
                            // $status = true;
                            }
                    ?>
                       <?php 
                            if($status == false){
                    ?>
                                <td class="eror">Inactive</td>
                    <?php
                            } else {
                    ?>
                                <td class="sukses">Active</td>
                    <?php
                            }
                    ?>
                            <td><?php echo $keyword;?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-table.php?id_table=<?php echo $id_table; ?>" class="btn-primary" id="updateTable">Update Table</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-table.php?id_table=<?php echo $id_table; ?>" class="btn-danger" id="deleteTable">Delete Table</a>
                                <a href="<?php echo SITEURL; ?>admin/keyword-generator.php?id_table=<?php echo $id_table; ?>" style="background-color: #fd7e14;" class="btn-primary" id="generateKeyword">Generate Keyword</a>
                            </td>
                    </tr>
                </tbody>        
        <?php
                    }
                }   
            } else {}
        ?>
        </table>
    </div>
</div>

        <!-- Footer Section Starts -->
        <div class="footer" >
            <div class="wrapper">
                <center><div class="text-center" id="lang"></div></center>
                <p class="text-center" >2021 All Rights Reserved. <br>Developed By - Tim Sistem Pemesanan Makanan 2021</p>

            </div>
        </div>

<?php include("partials/footer.php")?>