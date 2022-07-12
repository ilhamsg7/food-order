<?php 
	ob_start();
	include("../config/constants.php");
	include("login-check.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Food Ordering System - Dashboard</title>
    <script src="../script/loginscript.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<link rel="stylesheet" href="../BS/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/admin.css">
	<link rel="stylesheet" href="../css/modalstyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/Resto-Light.ico">
    <!-- <script src="/script/menuscript.js"></script> -->

    <!--  Memanggil file intro js untuk tour -->
	<link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/intro.js/themes/introjs-modern.css"/>

	<!-- Penambahan jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Memanggil boostrap.js dan intro.min.js untuk tour -->
	<script src="../BS/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
</head>
<script>
		function delete_cookie( name, path, domain ) {
			if( get_cookie( name ) ) {
				document.cookie = name + "=" +
				((path) ? ";path="+path:"")+
				((domain)?";domain="+domain:"") +
				";expires=Thu, 01 Jan 1970 00:00:01 GMT";
			}
			}

		function get_cookie(name){
				return document.cookie.split(';').some(c => {
					return c.trim().startsWith(name + '=');
				});
		}
</script>
<body onload="checkCookieIntro()">
	<!-- Menu Section Starts -->
	<div class="menu text-center">
		<div class="wrapper">
			<ul>
				<li><a href="index.php" id="dashboard">Dashboard</a></li>
				<li><a href="manage-admin.php" id="admin">Admin</a></li>
                <li><a href="manage-table.php" id="table">Table</a></li>
				<li><a href="manage-categories.php" id="category">Category</a></li>
				<li><a href="manage-food.php" id="food">Food</a></li>
				<li><a href="manage-order.php" id="order">Order</a></li>
                <!-- Navbar multi dropdown -->
				<nav class="navbar">
					<li class="nav-item dropdown" id="myDropdown">
						<a class="dropdown-toggle" href="#" data-bs-toggle="dropdown">Help</a>
						<ul class="dropdown-menu">
							<li> <a class="dropdown-item" href="#"> Contact Us </a></li>
							<li> <a class="dropdown-item" href="#"> Tour &raquo; </a>
								<ul class="submenu dropdown-menu">

									<!-- Sintaks untuk tour -->
									<li><a class="dropdown-item" href="#" onclick=tourIndex()>Dashboard</a>
									
									<!-- Mengalihkan ke halaman yang dituju dan menghapus cookies -->
									<!-- Cookies dihapus agar dapat mengakses tour -->
									<script>	
                                        function tourIndex(){
										
											window.location.href="<?php echo SITEURL;?>admin/index.php";
										delete_cookie("tourIndexAdmin","1","localhost");

                                    }
                                    </script>

									</li>
									
									<li><a class="dropdown-item" href="#" onclick=tourAdmin() >Admin</a>
										
									<script>	
                                        function tourAdmin(){
										
											window.location.href="<?php echo SITEURL;?>admin/manage-admin.php";
										delete_cookie("tourAdmin","1","localhost");

                                    }
                                    </script>
								
									</li>
									
									<li><a class="dropdown-item" href="#">Table</a></li>

									<li><a class="dropdown-item" href="#" onclick=tourCategoryAdmin()>Category</a>
									
									<script>	
                                        function tourCategoryAdmin(){
										
											window.location.href="<?php echo SITEURL;?>admin/manage-categories.php";
										delete_cookie("tourCategoryAdmin","1","localhost");

                                    }
                                    </script>

									</li>

									<li><a class="dropdown-item" href="#" onclick=tourFoodAdmin()>Foods</a>
									
										<script>	
											function tourFoodAdmin(){
											
												window.location.href="<?php echo SITEURL;?>admin/manage-food.php";
											delete_cookie("tourFoodAdmin","1","localhost");

										}
										</script>
								
									</li>

									<li><a class="dropdown-item" href="#" onclick=tourOrderAdmin()>Order</a>
										<script>	
											function tourOrderAdmin(){
											
											window.location.href="<?php echo SITEURL;?>admin/manage-order.php";
											delete_cookie("tourOrderAdmin","1","localhost");

										}
										</script>
									</li>  
								</ul>
							</li>
						</ul>
					</li>
				</nav>
				<li><a href="#" type="button" id="modal_btn" data-toggle="modal" data-target="#modal">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class="garis"></div>
	<!-- Menu Section Ends -->
	<!-- Modal -->
    <div class="modal" id="modal">
        <div class="modal__container" id="modal__container">
            <h1>Log Out</h1>
            <p>Are you sure you want to log-out?</p>
            <div class="modal__buttons">
                <button onclick="logout()" class="btn-primer button">Yes</button>
                <button id="modal-skip" class="btn-seken button">No</button>
            </div>
        </div>
    </div>
    <!-- Sintaks javascript untuk multi dropdown -->
	<script>
		document.addEventListener("DOMContentLoaded", function(){
		// make it as accordion for smaller screens
		if (window.innerWidth < 992) {

		// close all inner dropdowns when parent is closed
		document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
			everydropdown.addEventListener('hidden.bs.dropdown', function () {
			// after dropdown is hidden, then find all submenus
				this.querySelectorAll('.submenu').forEach(function(everysubmenu){
				// hide every submenu as well
				everysubmenu.style.display = 'none';
				});
			})
		});

		document.querySelectorAll('.dropdown-menu a').forEach(function(element){
			element.addEventListener('click', function (e) {
				let nextEl = this.nextElementSibling;
				if(nextEl && nextEl.classList.contains('submenu')) {	
				// prevent opening link if link needs to open dropdown
				e.preventDefault();
				if(nextEl.style.display == 'block'){
					nextEl.style.display = 'none';
				} else {
					nextEl.style.display = 'block';
				}

				}
			});
		})
		}
		// end if innerWidth
		}); 
		// DOMContentLoaded  end
	</script>

	<script>
            const btnModal = document.getElementById("modal_btn");
            const modal = document.getElementById("modal");
            const btnSkip = document.getElementById("modal-skip");
            btnModal.onclick = function() {
                modal.classList.add("modal-visible");
            }
            btnSkip.addEventListener("click", () => {
                modal.classList.remove("modal-visible");
            });

            function logout(){
                window.location.href="<?php echo SITEURL;?>admin/logout.php";
            }
    </script>            
    <!-- Sintaks untuk membuat button menjadi active pada navbar saat di klik -->
	<script>
	
    /** tambah class active jika di klik */

    var url = window.location;

    // ini untuk menambahkan class active pada menu yg tidak memiliki anak atau single link

    $('ul a').filter(function() {
    
    return this.href == url;
    
    }).parent().addClass('active');

    // ini untuk menu beranak, jadi otomatis akan terbuka sesuai dengan link tujuan

    $('ul.treeview-menu a').filter(function() {
    
    return this.href == url;
    
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

</script>

<div class="garis"></div>

<!-- Menu Section Ends -->