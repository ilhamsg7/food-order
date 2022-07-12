<?php 
	include("partials/menu.php");
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

  <!-- Sintaks yang diperlukan untuk pembuatan fitur-fitur sort, search, dan filter -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css"/>
  <script src="https://use.fontawesome.com/00909f12c6.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

	<meta http-equiv="refresh" content="900" />

	<!-- Set cookies untuk tour-->
	<script type="text/javascript">
			function checkCookieIntro(){
			var cookie=getCookie("tourOrderAdmin");

			// Pembuatan variabel untuk menyimpan cookies auto Refresh
			var cookiese=getCookie("autoRefresh");
				
				if (cookie==null || cookie=="") {
					setCookie("tourOrderAdmin", "1",90);
					runIntro();
					}
			
				// Set cookies untuk auto refresh dengan time = 7 detik
				if (cookiese!=null) {
					window.setTimeout(function () {
					window.location.reload();
					}, 7000);

					// Jika cookiese tidak kosong atau sama dengan autoRefresh
					// maka tombol button autoRefresh akan hilang dan muncul
					// tombol button autoRefres akan muncul
					// Ini hanyalah sebuah metode unik agar autoReferesh berjalan :)
					document.getElementById("autoRefresh").style.display = "none";
					document.getElementById("autoRefres").style.display = "inline";
					document.getElementById("autoRefres").style.backgroundColor= "green";
					document.getElementById("autoRefres").style.color= "white";

					// Jika button autoRefres di klik
					var btn = document.getElementById("autoRefres");
					btn.addEventListener("click", getRefresh);
				}
			}
	</script>

	<!-- Membuat fungsi getRefresh untuk keperluan auto refresh -->
	<script>
		function getRefresh(){
			delete_cookie("autoRefresh","1","localhost");
		}
	</script>
	<!-- Membuat fungsi getRefresh untuk keperluan auto refresh -->
	<script>
		function getRefresh(){
			delete_cookie("autoRefresh","1","localhost");
		}
	</script>

	<!-- Sintaks js untuk fitur tabel -->
	<script type="text/javascript" language="javascript" >
		$(document).ready(function(){
		
		$('.form-control').datepicker({
			todayBtn:'linked',
			format: "yyyy-mm-dd",
			autoclose: true
		});

		fetch_data('no');
		
		// Pemrosesan dengan fetch.php
		function fetch_data(is_date_search, start_date='', end_date='') {
			var dataTable = $('#order_data').DataTable({
				"processing" : true,
				"serverSide" : true,
				"order" : [],
				"ajax" : {
					url:"fetch.php",
					// url:"http://localhost/food-order/admin/fetch.php",
					type:"POST",
					data:{
						is_date_search:is_date_search, 
						start_date:start_date, 
						end_date:end_date
					}
				}
			});
		}

		$('#search').click(function(){
			var start_date = $('#start_date').val();
			var end_date = $('#end_date').val();
			if(start_date != '' && end_date !='') {
				$('#order_data').DataTable().destroy();
				fetch_data('yes', start_date, end_date);
			} else {
				alert("Both Date is Required");
			}
		}); 

	});
	</script>

<?php
//1. Mendapatkan id dari admin yang dipilih
	$id = $_GET['id'];
	//2. Membuat SQL Query untuk mendapatkan detail adminya
	$sql = "SELECT * FROM tbl_order WHERE id=$id";
	//3. Mengeksekusi Query
	$res = mysqli_query($conn, $sql);
	//Cek apakah Query ter eksekusi
	if ($res == true) {
		//Cek apakah data ada atau tidak
		$count = mysqli_num_rows($res);
		//Cek apakah mempunyai data admin atau tidak
		if ($count == 1) {
			//Akan mendapatkan detail data
			//echo "Data Admin Ada";
			$row = mysqli_fetch_assoc($res);
			$id_table = $row['id_table'];
			$order_date = $row['order_date'];
			$customer_name = $row['customer_name'];
			$customer_contact = $row['customer_contact'];
			$customer_address = $row['customer_address'];
	?>


		<style>
			#areaPrint {
				visibility: hidden;
			}

			@media print {
				.menu {
					display: none;
				}

				.footer {
					display: none;
				}

				#btn-print {
					display: none;
				}

				.main-content {
					display: none;
					/* visibility: hidden; */
				}

				#areaPrint,
				#areaPrint * {
					visibility: visible;
				}

				#areaPrint {
					position: center;
					left: 0;
					top: -50px;
				}
			}
		</style>

		<div class="container" id="areaPrint">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 body-main">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4"> <img width="90px" height="90px" class="imgPrint" alt="Invoce Template" src="../images/andoxLight.png" /> </div>
								<div class="col-md-8 text-right">
									<h4 style="color: #F81D2D;"><strong>RESTAURANT</strong></h4>
									<p>Malang, Indonesia</p>
									<p>1800-234-124</p>
									<p>restaurant@gmail.com</p>
								</div>
							</div> <br />
							<div class="row">
								<div class="col-md-12 text-center">
									<h2>INVOICE</h2>
								</div>
								<div class="col-md-12 text-left">
									<h5 style="color: #F81D2D;"><?php echo $id . $id_table; ?></h5>
									<p><?php echo $customer_name; ?></p>
									<p><?php echo $customer_contact; ?></p>
									<p><?php echo $customer_address; ?></p>
								</div>
							</div> <br />
							<div>
								<table class="table">
									<thead>
										<tr>
											<th>
												<h5>Description</h5>
											</th>
											<th>
												<h5>Qty</h5>
											</th>
											<th>
												<h5>Amount</h5>
											</th>
										</tr>
									</thead>

									<?php
									//Proses pembuatan nota
									$sql6 = "SELECT * FROM tbl_order WHERE order_date = '$order_date' AND id_table = '$id_table'";
									$res6 = mysqli_query($conn, $sql6);
									$count6 = mysqli_num_rows($res6);
									$y = 0;
									$total = 0;
									while ($row6 = mysqli_fetch_array($res6)) {
										$food = $row6['food'];
										$qty = $row6['qty'];
										$price = $row6['price'];
										$subtotal = $row6['total'];
										$total += $subtotal;

									?>
										<tbody>
											<tr>
												<td class="col-md-6"><?php echo $food; ?></td>
												<td class="col-md-3">&emsp;&nbsp;&nbsp;<?php echo $qty; ?></td>
												<td class="col-md-6"><i class="fas " area-hidden="true"></i> Rp. <?php echo $subtotal; ?> </td>
											</tr>
										<?php

									}
										?>
										<tr>

										</tr>
										<tr style="color: #F81D2D;">
											<td></td>
											<td class="text-right">
												<h6><strong>Total:</strong></h6>
											</td>
											<td class="text-left">
												<h6><strong><i class="fas" area-hidden="true"></i> Rp. <?php echo $total; ?></strong></h6>
											</td>
										</tr>
										</tbody>
								</table>
							</div>
							<div class="col-md-12">
								<p><b>Date :</b> <?php echo $order_date; ?></p> <br />


								<script>
									$(document).ready(function() {
										window.print();
										setTimeout("closePrintView()", 3000);
									});

									function closePrintView() {
										document.location.href = '<?php echo SITEURL;?>admin/manage-order.php';
									}
								</script>

								<input type="button" onclick="windowPrint()" class="btnPrint" id="btn-print" value="Printk">

								<script>
									document.getElementById("btn-print").click();
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php

	} else {
		//Akan terhubung ke manage-admin
		header('location:' . SITEURL . 'admin/manage-admin.php');
	}
}
?>

	<!-- Sintaks js untuk fitur tabel -->
				
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Order</h1>

				<br /><br />
				
			<?php
			if(isset($_SESSION['update']))
				{
					echo $_SESSION['update']; //Display session message
					unset($_SESSION['update']); //Removing session message
				}
			?>
			<?php
			if(isset($_SESSION['validation']))
				{
					echo $_SESSION['validation']; //Display session message
					unset($_SESSION['validation']); //Removing session message
				}
			?>
			<?php 
			if(isset($_SESSION['status']))//Checking whether the session is set or not
			{
				echo $_SESSION['status']; //Display session message
				unset($_SESSION['status']); //Removing session message
			}
    		?>  
			<div class="table-responsive">
				<br />
				<div class="row">
						<div class="col-md-4">
						<input type="text" name="start_date" id="start_date" class="form-control" placeholder="Click this column to select the start date" />
						</div>

						<div class="col-md-4">
						<input type="text" name="end_date" id="end_date" class="form-control" placeholder="Click this column to select the due date"/>
						</div>
					
						<div class="col-md-4">
						<input type="button" name="search" id="search" value="Search" class="btn btn-info" />
						</div>

				</div>
				<br>

				<!-- Proses auto refresh -->
				<form action="<?php echo SITEURL;?>admin/manage-order.php" method="POST">
				
					<input type="submit" name="autoRefresh" id="autoRefresh" value="Auto Refresh" class="btn btn-outline-success" />
				
					<?php
						if (isset($_POST['autoRefresh'])) {
					?>	

					<!-- Menghilangkan tombol autoRefresh -->
					<style>
						#autoRefresh{
							display: none;
						}
					</style>

					<script>
						// Membuat cookie dengan nama autoRefresh dengan content = 1
						// Cookie bisa di cek di pengaturan website
						document.cookie="autoRefresh=1";
					</script>

               		 <meta http-equiv="refresh" content="900" />				

					<?php
						}
						else{
							?>

						<style>
						#autoRefres{
							display: none;
						}
						</style>
							<?php
						}
					?>

					<input type="submit" name="autoRefres" id="autoRefres" value="Auto Refresh" class="btn btn-outline-success active" />
					
					<a href="manage-order.php" name="refresh" id="refresh" value="Refresh" class="btn btn-outline-success">Refresh</a>
				</form>
			<br><br>
			<table id="order_data" class="table table-bordered table-striped">
				<thead>
					<tr class="text-center">
						<th>No</th>
						<th id="orderDetails">Table</th>
						<th>Food </i></th>
						<th>Price</th>
						<th>Qty </th>
						<th>Total</th>
						<th>Order Date</th>
						<!-- <th id="deliveredTime">Delivered Time</th> -->
						<th id="timeout">Timeout</th>
						<th id="status">Status</th>
						<th>Customer Name</th>
						<!-- <th>Contact</th>
						<th>Address</th> -->
						<th>Update</th>	
						<th>Action</th>	
					</tr>
				</thead>
			</table>
		</div>
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
				intro: 'This is a order page, here you can see about the order information and you can edit the order information'
			},
			{
				element:'#orderDetails',
				intro: 'Here contains information about customer id'
			},
			{
				element:'#deliveredTime',
				intro: '<img src="../images/tour/tourDelivered.png" width="250"/> Here contains information about the time of food order that arrives at the customer\'s table that indicates the start time of the customer eating at the table'
			},
			{
				element:'#timeout',
				intro: '<img src="../images/tour/tourTimeout.png" width="250"/> Timeouts indicate that the customer\'s time to eat is up, so customers should leave the restaurant'
			},
			{
				element: '#status',
				intro: '<img src="../images/tour/tourOrderStatus.png" width="250"/> Here contains real-time food order status information set by admin based on information from chef'
			},
			{
				element: '#updateOrder',
				intro: 'Click this button to update information about food ordering especially food order status'
			}
		]
	})

	intro.start();
	}

	</script>
	
<?php include("partials/footer.php")?>