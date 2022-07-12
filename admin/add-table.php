<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Table</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <?php 
            if(isset($_SESSION['same-idtable'])){
                echo $_SESSION['same-idtable'];
                unset($_SESSION['same-idtable']);
            }
        ?>
        <form method="POST" action="">
            <table class="tbl-30">
                <tr>
                    <td>Id Table</td>
                    <td><input type="text" name="id_table" placeholder="Enter ID Table" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter Password" required></td>
                </tr>
                <tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Table" class="btn-secondary">
					</td>
				</tr>
            </table>
        </form>
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

<?php 
    if(isset($_POST['submit'])){

        //Parameter
        $id_table = mysqli_real_escape_string($conn, $_POST['id_table']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //Connection & Checking
        $select = "SELECT * FROM tbl_meja";
        $sql = mysqli_query($conn, $select);
        $count = mysqli_num_rows($sql);
        if($count > 0){
            while($row = mysqli_fetch_assoc($sql)){
                $idtbl = $row['id_table'];
                if($id_table == $idtbl){
                    $_SESSION['same-idtable'] = "<div class='eror text-center'>ID Table Already Exist</div>";
                    header("location:".SITEURL."admin/add-table.php");
                    die();
                }
            }
        }

        //Insert Data
        // $insert = "INSERT INTO tbl_meja(id_table, password, status, keyword) VALUES('$id_table', '$password', false, null)";
        $insert = "INSERT INTO tbl_meja SET 
        id_table = '$id_table',
        password = '$password',
        status = false,
        keyword = null";
        $res = mysqli_query($conn, $insert);
        if($res == true){
            $_SESSION['add'] = "<div class='sukses text-center'>Succesfully to Added Table</div>";
            header("location:".SITEURL."admin/manage-table.php");
        } else {
            $_SESSION['add'] = "<div class='eror text-center'>Failed to Added Table</div>";
            header("location:".SITEURL."admin/manage-table.php");
        }
    }
?>