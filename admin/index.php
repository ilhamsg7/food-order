<?php include("partials/menu.php") ?>


	<!-- Set Cookies for Tour-->
	<script type="text/javascript">
		function checkCookieIntro(){
		var cookie=getCookie("tourIndexAdmin");

		if (cookie==null || cookie=="") {
			setCookie("tourIndexAdmin", "1",90);
			runIntro();
			}
		}
	</script>
	<!-- Main Content Section Starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Dashboard</h1><br><br>
			<?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION ['login'];
                    unset($_SESSION['login']);
                }
            ?>
				<div class="container-fluid">
					<div class="row row-cols-2">
						<div class="col-6 text-center">
						<?php
							//Query SQL
							$sql = "SELECT * FROM tbl_category";
							//Proses eksekusi
							$res = mysqli_query($conn, $sql);
							//Menghitung baris
							$hitung = mysqli_num_rows($res);
							?>
							<h1><?php echo $hitung; ?></h1>
							<br/>
							Category
						</div>

						<div class="col-6 text-center">
							<?php
							//Query SQL
							$sql = "SELECT * FROM tbl_food";
							//Proses eksekusi
							$res = mysqli_query($conn, $sql);
							//Menghitung baris
							$hitung = mysqli_num_rows($res);
							?>
							<h1><?php echo $hitung; ?></h1>
							<br/>
							Food
						</div>
					</div>
					<div class="row mt-3 row-cols-2">
						<div class="col-6 text-center">
						<?php
							//Query SQL
							$sql = "SELECT * FROM tbl_order";
							//Proses eksekusi
							$res = mysqli_query($conn, $sql);
							//Menghitung baris
							$hitung = mysqli_num_rows($res);
						?>
							<h1><?php echo $hitung; ?></h1>
							<br/>
							Total Order
						</div>

						<div class="col-6 text-center">
						<?php
							//Proses Pembuatan SQL Query menghitung pendapatan
							//Query SQL
							$sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Ordered' OR status = 'On Delivery' OR status = 'Delivered' OR status = 'TIMEOUT'";
							//Proses eksekusi
							$res = mysqli_query($conn, $sql);
							//Menghitung baris
							$hitung = mysqli_fetch_assoc($res);
							//Proses menghitung total
							$total_pendapatan = $hitung['Total'];
						?>
							<h2 class="mb-5 mt-0">Rp <?php echo $total_pendapatan; ?></h2>
							Revenue Generated
						</div>
					</div>
					<div class="row mt-3 row-cols-2"> 
						<div class="col-6 text-center">
							<?php
								//Query SQL
								$status_active = "SELECT COUNT(status) AS active_status FROM tbl_meja WHERE status = true";
								//Proses eksekusi
								$res = mysqli_query($conn, $status_active);
								//Menghitung baris
								// $aktif = mysqli_fetch_assoc($res);
								$aktif = mysqli_fetch_assoc($res);
								// $total_aktif = $aktif['status']
							?>
								<h1><?php echo $aktif['active_status']; ?></h1>
								<br/>
								Active Table
						</div>

						<div class="col-6 text-center">
						<?php
								//Query SQL
								$status_inactive = "SELECT COUNT(status) as inactive_status FROM tbl_meja WHERE status = false";
								//Proses eksekusi
								$res = mysqli_query($conn, $status_inactive);
								//Menghitung baris
								$non_aktif = mysqli_fetch_assoc($res);
							?>
								<h1><?php echo $non_aktif['inactive_status']; ?></h1>
								<br/>
								Inactive Table
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
		</div>
	</div>
	<script>
        AOS.init();
    </script>
	<!-- Main Content Section Ends -->
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
					intro: 'Welcome to our website, Let\'s take a tour, if you wan\'t tour you can click anywhere or click cross in top right corner'
				},
				{
					element:'#lang',
					intro: 'Let\'s select language first'
				},
				{
					element: '#dashboard',
					intro: 'This is a dashboard page, here you can see information about the number of categories, food, orders to income'
				},
				{
					element: '#admin',
					intro: 'This is a admin page, here you can see information about the user who manages the admin section and you can add a new admin'
				},
				{
					element: '#category',
					intro: 'This is a category page, here you can see information about food categories and you also can add a new food categories'
				},
				{
					element: '#food',
					intro: 'This is a food page, here you can see information about food menu and you also can add a new food'
				},
				{
					element: '#order',
					intro: 'This is a order page, here you can see information about customers and you can manage order status here'
				},
				{
					element: '#myDropdown',
					intro: 'This is a helpful feature, you can contact us or try the tour feature like this pop up'
				},
				{
					element: '#logout',
					intro: 'If the restaurant wants to close, don\'t forget to log out'
				}
			]
		})

		intro.start();
		}

	</script>

<?php include("partials/footer.php") ?>