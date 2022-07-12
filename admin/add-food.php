<?php
	include('partials/menu.php');
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>

		<br><br>

		<?php
			if(isset($_SESSION['upload'])){
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
		?>

		<?php
			if(isset($_SESSION['same-title'])){
				echo $_SESSION['same-title'];
				unset($_SESSION['same-title']);
			}
		?>

		<?php
			if(isset($_SESSION['validation-image'])){
				echo $_SESSION['validation-image'];
				unset ($_SESSION['validation-image']);
			}
		?>

		<br><br>
		
		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Title of the food" required>
					</td>
				</tr>
				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5" placeholder="Description of the food" required></textarea>
					</td>
				</tr>
				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price" required>
					</td>
				</tr>
				<tr>
					<td>Select Image: </td>
					<td>
						<input type="file" name="image" required>
					</td>
				</tr>
				<tr>
					<td>Category: </td>
					<td>
						<select name="category">
							<?php
								//Create PHP to display categories from database
								//1. Create SQL to get all active categories
								$sql = "SELECT * FROM tbl_category WHERE active='Yes'";
								//Exceute query
								$res = mysqli_query($conn, $sql);
								//Count rows to check whether we have categories or not
								$count = mysqli_num_rows($res);
								//If count is greater than zeor, we have categories, else we don't have
								if($count>0)
								{
									//We have categories
									while($row = mysqli_fetch_assoc($res))
									{
										//Get the details of categories
										$id = $row['id'];
										$title = $row['title'];
										?>
										<option value="<?php echo $id;?>"><?php echo $title;?></option>
										<?php
									}
								}else
								{	
									//We do not have category
									?>
									<option value="0">No category found</option>
									<?php
								}
								//2. Display on dropdown

							?>
					
						</select>
					</td>
				</tr>
				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes">Yes
						<input type="radio" name="featured" value="No">No
					</td>
				</tr>
				<tr>
					<td>Active: </td>	
					<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="No">No
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Food" class="btn-secondary">
					</td>
				</tr>

			</table>

		</form>

		<?php
			//Check whether the button is clicked or not
		 	if(isset($_POST['submit'])){
		 		//Add the food in database

		 		//1. Get the data from form
		 		$title = mysqli_real_escape_string($conn, $_POST['title']);
		 		
				//Food name validation
				$sql2 = "SELECT * FROM tbl_food";

				$res2 = mysqli_query($conn, $sql2);
				$count = mysqli_num_rows($res2);
				
				if($count > 0){
					while($row = mysqli_fetch_assoc($res2)){
						$title2 = $row['title'];
						if($title == $title2){
							$_SESSION['same-title'] = "<div class = 'eror'>Food name already exist!</div>";
							header("location:".SITEURL.'admin/add-food.php');
							die();
						}
					}
				} 
				
				$description = mysqli_real_escape_string($conn, $_POST['description']);

		 		//Validation description
				if (strlen($description)>60) {
					$_SESSION['upload'] = "<div class='eror'>Number of characters in description exceeds 60</div>";
					header('location:'.SITEURL.'admin/add-food.php');
					die();
				}

				$price = mysqli_real_escape_string($conn, $_POST['price']);
				$category = mysqli_real_escape_string($conn, $_POST['category']);
		 		//Check whether radio button for featured and active are checked or not
		 		if(isset($_POST['featured'])){
		 			$featured = $_POST['featured'];
		 		}else{
		 			$featured = "No";//Setting default value
		 		}
		 		if(isset($_POST['active'])){
		 			$active = $_POST['active'];
		 		}else{
		 			$active = "No";//Setting default value
		 		}
		 		//2. Upload the image if selected
		 		//Check whether the select image is clicked or not
		 		if(isset($_FILES['image']['name']))
		 		{
					//Validation image
					//Get image dimension
					$fileinfo = @getimagesize($_FILES['image']['tmp_name']);
					$width = $fileinfo[0];
					$height = $fileinfo[1];
					
					$allowed_image_extension = array(
						"png",
						"jpg",
						"jpeg"
					);
					
					// Get image file extension
					$file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				
					// Validate file input to check if is with valid extension
					if (! in_array($file_extension, $allowed_image_extension)) {
						
						$_SESSION['validation-image'] = "<div class='eror'>Upload valid images. Only PNG and 
						JPEG are allowed</div>";
						header("location:".SITEURL.'admin/add-food.php');
						die();

					}    // Validate image file size
					else if (($_FILES["image"]["size"] > 2000000)) {
						
						$_SESSION['validation-image'] = "<div class='eror'>Image size exceeds 
						2MB</div>";
						header("location:".SITEURL.'admin/add-food.php');
						die();

					}    // Validate image file dimension
					else if ($width != "400" && $height != "500") {
				
						$_SESSION['validation-image'] = "<div class='eror'>Image dimension should be 
						400X500</div>";
						header("location:".SITEURL.'admin/add-food.php');
						die();
					}
					else{
						//Get the details of the selected image
						$image_name = $_FILES['image']['name'];
						//Check whether the image is selected or not and upload image only if selected
						if($image_name !="")
						{
							//Image is selected
							//A. Rename the image
							//Get the extension of selected image (jpg, png, gif, etc.)
							$ext = end(explode('.',$image_name));
							//Create new name for image
							$image_name = "Food-Name-".rand(0000,9999).".".$ext;//New image name may be "Food-Name-657.jpg"
							//B. Upload the image
							//Get the src path and destination path

							//Source path is the current location of the image 
							$src = $_FILES['image']['tmp_name'];
							//Destination path for image to be uploaded
							$dst = "../images/food/".$image_name;
							//Finally upload the food image
							$upload = move_uploaded_file($src, $dst);
							//Check whether image uploaded or not
							if($upload==false)
							{
								//Failed to upload the image
								//Redirect to add food page with error message
								$_SESSION['upload'] = "<div class='eror'>Failed to upload image</div>";
								header('location:'.SITEURL.'admin/add-food.php');
								//Stop the proccess
								die();
							}
						}
					}
				}
		 		else
		 		{
		 			$image_name = "";//Default value is blank
		 		}
		 		//3. Insert data into database
		 		//Create SQL Query to save to or add food
		 		//For numerical we do not need to pass value inside quotes '' but for string value it is compulsory to add quotes ''
		 		$sql2 = "INSERT INTO tbl_food SET
		 			title='$title',
		 			description = '$description',
		 			price = $price,
		 			image_name = '$image_name',
		 			category_id = $category,
		 			featured = '$featured',
		 			active = '$active'
		 		";
		 		//Execute query
		 		$res2 = mysqli_query($conn, $sql2);
		 		//Check whether data inserted or not
		 		if($res2 == true){
		 			//Data inserted successfully
		 			$_SESSION['add'] = "<div class='sukses'>Food addedd successfully</div>";
		 			header('location:'.SITEURL.'admin/manage-food.php');
		 		}else{
		 			//Failed to insert data
		 			$_SESSION['add'] = "<div class='eror'>Failed to add food</div>";
		 			header('location:'.SITEURL.'admin/manage-food.php');
		 		}
		 		//4. Redirect with message to manage food page
		 	}
		?>

	</div>
</div>

<?php
	include('partials/footer.php');
?>
