<?php
    include('checking/menu.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>An-Dox | Official Website</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="images/Resto-Light.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- <link rel="stylesheet" href="css/intro_style.css"> -->
    </head>
    <body>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center" style="background-image:url('../images/BackGround\ IMG.jpg');">
        <div class="container">
            
            <?php
                 //Get the search keyword
                //$search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>

            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center title" >Food Menu</h2>

            <?php 
               
                //SQL Query to get food or search keyword
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE'%$search%'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                if($count>0){
                    //Food available
                    while($row=mysqli_fetch_assoc($res)){
                        //Get details
                        $id = $row['id'];
                        $title=$row['title'];
                        $stock = $row['stock'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        //Check whether image is available or not
                                        if($image_name == ""){
                                            //Display message
                                            echo "<div class='eror'>Image is not available</div>";
                                        }else{
                                            //Image available
                                            ?>
                                             <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">
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
                    echo "<div class='eror'>Food not found</div>";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
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

<?php
    include('../partials-front/footer.php');
?>