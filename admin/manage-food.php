<?php include("partials/menu.php")?>

<!-- Set cookies untuk tour-->
<script type="text/javascript">
		function checkCookieIntro(){
		var cookie=getCookie("tourFoodAdmin");

		if (cookie==null || cookie=="") {
			setCookie("tourFoodAdmin", "1",90);
			runIntro();
			}
		}
</script>
<div class="main-content">
	<div class="wrapper">
	<h1>Manage Food</h1>

				<br /><br />

			<!-- Button to add Admin -->
			<a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
			<br /><br /><br />


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
				if(isset($_SESSION['upload'])){
					echo $_SESSION['upload'];
					unset($_SESSION['upload']);
				}
			?>

			<?php
				if(isset($_SESSION['unauthorized'])){
					echo $_SESSION['unauthorized'];
					unset($_SESSION['unauthorized']);
				}
			?>

			<?php
				if(isset($_SESSION['update'])){
					echo $_SESSION['update'];
					unset($_SESSION['update']);
				}
			?>

			<br><br>

			<table class="tbl-full">
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Price</th>
					<th>Stock</th>
					<th>Image</th>
					<th id="featureFood">Feature</th>
					<th id="activeFood">Active</th>
					<th>Actions</th>
				</tr>

				<?php
					//Create a SQL Query to get all the food
					$sql = "SELECT * FROM tbl_food";

					//Execute the query
					$res = mysqli_query($conn, $sql);

					//Count the rows to check whether we have food or not
					$count = mysqli_num_rows($res);

					//Create sn or id
					$sn=1;

					if($count>0)
					{
						//We have food
						//Get the foods drom database and display
						while($row = mysqli_fetch_assoc($res))
						{
							//Get the value from individual column
							$id = $row['id'];
							$title = $row['title'];
							$price = $row['price'];
							$stock = $row['stock'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];
							?>

								<tr>
									<td><?php echo $sn++;?></td>
									<td><?php echo $title;?></td>
									<td>Rp <?php echo $price;?></td>
									<td><?php echo $stock;?></td>
									<td>
										<?php
										//Check whether we have image or not
										if($image_name==""){
											//We do not have image, display error message
											echo "<div class='eror'>Image not added</div>";
										}else{
											//We have image, display image
											?>	
											<img src="<?php echo SITEURL;?>/images/food/<?php echo $image_name;?>" width = "100">;
											<?php
										}
										?>
										
									</td>
									<td><?php echo $featured;?></td>
									<td><?php echo $active;?></td>
									<td>
										<a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary" id="updateFood">Update</a>
										<a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger" id="deleteFood">Delete</a>
									</td>
								</tr>

							<?php
						}
					}else
					{
						//Food not added in database
						echo "<tr><td colspan='7' class='eror'>Food not added yet</td></tr>";
					}
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
		<!-- Footer Section Ends -->

		<!-- Mengatur tulisan yang muncul di tour -->
		<script>

		function runIntro(){
		const intro = introJs();

		intro.setOptions({
			steps: [
				{
					intro: 'This is a food page, here you can see information about the food menu and you can edit and add a new food'
				},
				{
					element:'#addFood',
					intro: 'Click this button to add a new food'
				},
				{
					element:'#featureFood',
					intro: '<p> If the feature status is \'yes\', then the food will appear on the customer\'s homepage, but if the feature status is \'no\' then it will not appear on the customer\'s homepage </p> <img src="../images/tour/displayFeatureFood.png" width="250">'
				},
				{
					element:'#activeFood',
					intro: '<p> If the active status is \'yes\', then the food will appear on customer\'s homepage and food menu page </p><video src="../videos/foodSection.mp4" autoplay width="250"/>',
					position: "top"
				},
				{
					element: '#updateFood',
					intro: 'Click this button if you want to update the food'
				},
				{
					element: '#deleteFood',
					intro: 'Click this button if you want to delete food'
				}
			]
		})

		intro.start();
		}

		</script>

<?php include("partials/footer.php")?>