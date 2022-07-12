<?php include("partials/menu.php")?>

<!-- Set cookies untuk tour-->
<script type="text/javascript">
		function checkCookieIntro(){
		var cookie=getCookie("tourAdmin");

		if (cookie==null || cookie=="") {
			setCookie("tourAdmin", "1",90);
			runIntro();
			}
		}
</script>

	<!-- Main Content Section Starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Admin</h1>
			<?php 
				if(isset($_SESSION['add']))
				{
					echo $_SESSION['add']; //Display session message
					unset($_SESSION['add']); //Removing session message
				}
				if(isset($_SESSION['delete']))
				{
					echo $_SESSION['delete']; //Display session message
					unset($_SESSION['delete']); //Removing session message
				}
				if(isset($_SESSION['update']))
				{
					echo $_SESSION['update']; //Display session message
					unset($_SESSION['update']); //Removing session message
				}
				if(isset($_SESSION['user-hilang']))
				{
					echo $_SESSION['user-hilang']; //Display session message
					unset($_SESSION['user-hilang']); //Removing session message
				}
				if(isset($_SESSION['pwd-tdk-sesuai']))
				{
					echo $_SESSION['pwd-tdk-sesuai']; //Display session message
					unset($_SESSION['pwd-tdk-sesuai']); //Removing session message
				}
				if(isset($_SESSION['ubah-password']))
				{
					echo $_SESSION['ubah-password']; //Display session message
					unset($_SESSION['ubah-password']); //Removing session message
				}
			?>
			<br/><br/>
			<!-- Button to add Admin -->
			<a href="add-admin.php" class="btn-primary">Add Admin</a>
			<br /><br /><br />

			<table class="tbl-full">
				<tr>
					<th>Id</th>
					<th>Full name</th>
					<th>Username</th>
					<th>Action</th>
				</tr>

				<?php 
					//Query to get all admin
					$sql = "SELECT * FROM tbl_admin";
					//execute the query
					$res = mysqli_query($conn, $sql);

					//check whether the query is Executed of not
					if($res==true)
					{
						//count rows to check wether we have database or not
						$count = mysqli_num_rows($res); // function to get all the rows in database

						$sn = 1; //create variabel and assign the value (to solve the problem
					    //id which changed when add value or remove)

						//check the num of rows
						if($count>0){
							//we have data in database
							while($rows=mysqli_fetch_assoc($res))
							{
								//using while loop to get all the data from database
								//And while loop will run as long as we have database

								//Get individual data
								$id=$rows['id'];
								$full_name = $rows['full_name'];
								$username = $rows['username'];

								//Display the values in our table

								?>
								<tr>
									<td><?php echo $sn++ ?></td> 
									<td><?php echo $full_name ?></td>
									<td><?php echo $username ?></td>
									<td>
										<a style="background-color: #fd7e14;" href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
										<a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Data</a>
										<a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
									</td>
								</tr>	
								<?php
							}
						}else{
							//we do not have data in database
						}
					}
				?>
			</table>
		</div>
	</div>
	<!-- Main Content Section Ends -->
	<!-- Footer Section Starts -->
	<div class="footer" >
            <div class="wrapper">
                <center><div class="text-center" id="lang"></div></center>
                <p class="text-center" >2021 All Rights Reserved. <br>Developed By - Tim Sistem Pemesanan Makanan 2021</p>

            </div>
    </div>
	

<!-- Mengatur tulisan yang muncul di tour -->
<script>

function runIntro(){
const intro = introJs();

intro.setOptions({
	steps: [
		{
			intro: 'This is a admin page, here you can see information about the user who manages the admin section and you can edit and add a new admin'
		},
		{
			element:'#addAdmin',
			intro: 'Click this button to add a new admin'
		},
		{
			element: '#changePwd',
			intro: 'Click this button if you want to change admin password'
		},
		{
			element: '#updateAdmin',
			intro: 'Click this button if you want to update the admin name and username'
		},
		{
			element: '#deleteAdmin',
			intro: 'Click this button if you want to delete admin'
		}
	]
})

intro.start();
}

</script>

<?php include("partials/footer.php")?>