<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>An-Dox | Official Website</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="images/Resto-Light.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
<?php
    include('partials-front/menu.php');
?>

    <?php
        //Check whether id is passed or not
        if(isset($_GET['category_id'])){
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            //Get the category title based on category id
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //Get the value from database
            $row = mysqli_fetch_assoc($res);

            //Get the title
            $category_title = $row['title'];
        }else{
            //Category not passed
            //Redirect to home page
            header('location:'.SITEURL);
        }
    ?>

     <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center" style="background-image:url('images/BackGround\ IMG.jpg');">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center title">Food Menu</h2>

            <?php
                //Create SQL Query foods based on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //Execute query
                $res2 = mysqli_query($conn, $sql2);
                //Count the rows
                $count2 = mysqli_num_rows($res2);

                //Check whether food is available or not
                if($count2>0){
                    //Food is available
                    while($row2=mysqli_fetch_assoc($res2)){
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $stock = $row2['stock'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];

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
                                <p class="food-price">Rp <?php echo number_format($price, ((int) $price == $price ? 0 : 2), '.', ',')?></p>
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
                                            <a href="<?php echo SITEURL;?>after-login/customer-login.php" class="btn btn-primary">Order</a>
                                            <div class="btnStock">Stock : <?php echo $stock;?></div>

                                        <?php 
                                        }
                                    ?>
                            </div>
                        </div>

                        <?php
                    }
                }else{
                    //Food is not available
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
    <!-- social Section Ends Here -->=
    <?php
        include('partials-front/footer.php');
    ?>
</body>
</html>