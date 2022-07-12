<?php
    include('checking/menu.php');
?>  
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Beranda Restoran</title>
        <link rel="stylesheet" href="/BS/dist/css/bootstrap.min.css">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../images/Icon Restoran.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link rel="stylesheet" href="../css/intro_style.css">
        <link rel="stylesheet" href="../css/modalstyle.css">

    </head>
    <body>
            <div class="CSSgal" id="CSSgal" style="box-sizing: border-box; -webkit-box-sizing: border-box; margin: 0; font: 16px/1.3 sans-serif;">
                    <s id="s1"></s> 
                    <s id="s2"></s>
                    <s id="s3"></s>
                    <s id="s4"></s>
                <div class="slider" id="slider">
                    <div style="background-image: url('../images/Front Introduction/Intro 1.jpg');">
                        <h2 class="slogan">Welcome to <b>An-Dox</b> Restaurant</h2>
                        <p>We will serve you with best service</p>
                        <br>
                    </div>
                    <div style="background-image: url('../images/Front Introduction/Intro 2.jpg');">
                        <h2 class="slogan">Fresh</h2>
                        <p>We use fresh and quality materials</p>
                        <br>
                    </div>
                    <div style="background-image: url('../images/Front Introduction/Intro 3.jpg');">
                        <h2 class="slogan">Healty</h2>
                        <p>During a pandemic, we implementation of Health Protocol to comfortable and safety for Customer</p>
                        <br>
                    </div>
                    <div style="background-image: url('../images/Front Introduction/Intro 4.jpg');">
                        <h2 class="slogan">Usability</h2>
                        <p>With technology, We're making eating at restaurants easier</p>
                        <br>
                    </div>
                </div>
                <div class="prevNext">
                    <div><a href="#s4"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><a href="#s2"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></div>
                    <div><a href="#s1"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><a href="#s3"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></div>
                    <div><a href="#s2"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><a href="#s4"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></div>
                    <div><a href="#s3"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><a href="#s1"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></div>
                </div>
            </div>
            <!-- fOOD sEARCH Section Starts Here -->
                <section class="food-search text-center" style="margin-top: -17px;">
                    <div class="container">
                        <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                            <input type="search" name="search" placeholder="Search for Food.." required>
                            <button type="submit" name="submit" value="Search" class="btn btn-primary"><i class="fa fa-search fa-lg" aria-hidden="true" style="width: 25px;"></i></button>
                        </form>

                    </div>
                </section>
               <!-- Modal Table Status -->
               <div class="buttons" style="margin-top: -50px;">
                    <div class="containerd">
                        <a href="#" id="modals_btn" data-toggle="modals" data-target="#modals" data-sm-link-text="Click This" type="button" class="btnd effect04"><span>Table Status</span></a>
                    </div>
                </div>
                <div class="label"></div>
                
            <!-- Modal -->
            <div class="modals" id="modals">
                <div class="modals__container" id="modals__container">
                <table class="row text-center inline_table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th colspan="5"><h3 style="text-align: center;">Status Table</h3></th>
                                <vr></vr>
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
                                    $status = $baris['status'];
                                ?>
                        <tbody>
                            <tr>
                                <td scope="row"><?php echo $num++; ?>.</td>
                                <td><?php echo $id_table;?></td>
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
                            </tr>
                        </tbody>
                    <?php
                                }
                            }   
                        } else {}
                    ?>
                    </table>
                    <div class="modals__buttons">
                        <!-- <button onclick="logout()" type="submit" name="submit" class="btn-primer button">Yes</button> -->
                        <button id="modals-skip" class="btn-primer buttont">Close</button>
                    </div>
                </div>
            </div>
            <script>
                const btnModals = document.getElementById("modals_btn");
                const modals = document.getElementById("modals");
                const btnSkips = document.getElementById("modals-skip");
                btnModals.onclick = function() {
                    modals.classList.add("modals-visible");
                }
                btnSkips.addEventListener("click", () => {
                    modals.classList.remove("modals-visible");
                });
                AOS.init();
            </script>
                <!-- Pick Data From tbl_meja-->
                    </br>
                <?php
                    if(isset($_SESSION['login-cust'])){
                        echo $_SESSION ['login-cust'];
                        unset($_SESSION['login-cust']);
                    }
                ?>
                <!-- fOOD sEARCH Section Ends Here -->
                <?php 
                    if(isset($_SESSION['order']))//Checking whether the session is set or not
                    {
                        echo $_SESSION['order']; //Display session message
                        unset($_SESSION['order']); //Removing session message
                    }
                ?>   
                
                <?php
                    if(isset($_SESSION['please-order'])){
                        echo $_SESSION['please-order'];
                        unset($_SESSION['please-order']);
                    }
		        ?>
                <!-- CAtegories Section Starts Here -->
                <section class="categories">
                    <div class="container">
                        <h2 class="text-center title">Explore Foods</h2>

                        <?php
                        //Create SQL Query to display categories
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured ='Yes' LIMIT 3";
                        //Execute the query
                        $res = mysqli_query($conn, $sql);
                        //Count rows ro check whether the category is available or not
                        $count = mysqli_num_rows($res);

                        if($count>0){
                            //Category is available
                            while($row = mysqli_fetch_assoc($res)){
                                //Get the value 
                                $cat_id = $row['id'];
                                $title =$row['title'];
                                $image_name = $row['image_name'];
                                ?>

                                <a href="<?php echo SITEURL;?>after-order/categories-food-order.php?order_id=<?php echo $id;?>&category_id=<?php echo $cat_id;?>">
                                <div class="box-3 float-container" data-aos="zoom-in" data-aos-duration="1500">
                                    <?php
                                        //Check whether image is available or not
                                        if($image_name == ""){
                                            //Display message
                                            echo "<div class='eror'>Image is not available</div>";
                                        }else{
                                            //Image available
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">

                                            <?php
                                        }
                                    ?>
                                
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                                </a>

                                <?php
                            }
                        }else{
                            //Category is not available
                            echo "<div class='eror'>Category not added</div>";
                        }
                        ?>

                        <div class="clearfix"></div>
                    </div>
                </section>
                <!-- Categories Section Ends Here -->

                <!-- fOOD MEnu Section Starts Here -->
                <section class="food-menu" data-aos="fade-up" data-aos-duration="1500">
                    <div class="container">
                        <h2 class="text-center title">Food Menu</h2>

                    
                        <?php
                            //Getting food from database that are active and featured
                            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                            //Execute query
                            $res2 = mysqli_query($conn, $sql2);
                            //Count rows
                            $count2 = mysqli_num_rows($res2);
                            //Check whether food available or not
                            if($count2>0){
                                //Food available
                                while($row=mysqli_fetch_assoc($res2)){
                                    //Get all value
                                    $food_id = $row['id'];
                                    $title = $row['title'];
                                    $price = $row['price'];
                                    $stock = $row['stock'];
                                    $description = $row['description'];
                                    $image_name = $row['image_name'];
                        ?>
                                    <div class="food-menu-box">
                                        <div class="food-menu-img">
                                            <?php
                                                //Check whether image is available or not
                                                if($image_name==""){
                                                    //Image not available
                                                    echo "<div class='eror'>Image not available</div>";
                                                }else{
                                                    //Image available
                                                    ?>
                                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                    <?php
                                                }
                                            ?>
                                            
                                        </div>

                                        <div class="food-menu-desc">
                                            <h4><?php echo $title;?></h4>
                                            <p class="food-price">Rp <?php echo number_format($price, ((int) $price == $price ? 0 : 2), '.', ',');?></p>
                                            <p class="food-detail">
                                                <?php echo $description;?>
                                            </p>
                                            <br>
                                            <?php
                                                if($stock == 0){
                                                ?>
                                                <div class="btnStock">Stock Out</div>
                                                <?php
                                                }else{
                                                ?>
                                                    
                                                    <a href="<?php echo SITEURL;?>after-order/order-order.php?order_id=<?php echo $id;?>&food_id=<?php echo $food_id;?>" class="btn btn-primary">Order</a>
                                                    <div class="btnStock">Stock : <?php echo $stock;?></div>

                                                <?php 
                                                }
                                            ?>
                                            <!-- <a href="<?php echo SITEURL;?>after-login/order-login.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a> -->
                                        </div>
                                    </div>
                            <?php
                                }
                            }else{
                                //Food not available
                                echo "<div class='eror'>Food not available</div>";
                            }
                        ?>


                        <div class="clearfix"></div>

                        

                    </div>

                    <p class="text-center">
                        <a href="#">See All Foods</a>
                    </p>
                </section>
                <!-- fOOD Menu Section Ends Here -->

                <!-- social Section Starts Here -->
                <section class="social" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1500">
                    <div class="container text-center">
                        <ul>
                            <li>
                                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- social Section Ends Here -->
                    <script>
                        AOS.init();
                    </script>
            <?php
                include('../partials-front/footer.php');
            ?>

        <script src="" async defer></script>
  