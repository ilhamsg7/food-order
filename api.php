<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include('config/constants.php');
// SAMPLE HIT API iPaymu v2 PHP //

?>


   <?php
    //Check wether order is set or not
    if (isset($_GET['order_id'])) {
        //Get the food id and details of the selected foof
        $order_id = $_GET['order_id'];
        $sql = "SELECT * FROM tbl_order WHERE id=$order_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row2 = mysqli_fetch_assoc($res);
            $id = $row2['id'];
            $food = $row2['food'];
            $id_table = $row2['id_table'];
            $order_date = $row2['order_date'];
            $customer_name = $row2['customer_name'];
            // $customer_address = $row2['customer_address'];
            $customer_contact  = $row2['customer_contact'];
        } else {
            //Akan terhubung ke halaman utama
            header('location:' . SITEURL);
            // header('location:'.SITEURL.'after-login/index-login.php');
        }
    } else {
        // $_SESSION['please-order'] = "<div class='eror text-center'>Not yet order</div>";
        $_SESSION['please-order'] = "
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: 'Not yet Order!',
        })
        </script>
        ";
        header('location:' . SITEURL . 'after-login/index-login.php');
    }

    $sql6 = "SELECT * FROM tbl_order WHERE order_date = '$order_date' && id_table = '$id_table'";
    $res6 = mysqli_query($conn, $sql6);
    $count6 = mysqli_num_rows($res6);
    $y = 0;
    $total = 0;
    $product = array();
    $quantity = array();
    $harga = array();
    while ($row6 = mysqli_fetch_array($res6)) {

        $product[] = $row6['food'];
        $quantity[] = $row6['qty'];
        $harga[] = $row6['price'];
    }
    ?>

    <?php

    $_POST['product'] = $product;
    $_POST['qty'] = $quantity;
    $_POST['price'] = $harga;
    $_POST['buyerName'] = $customer_name;
    $_POST['buyerPhone'] = $customer_contact;
    $va           = '0000005648224202'; //get on iPaymu dashboard
    $secret       = '79E47DE1-8092-45E7-8F9D-7971D1A5FF85'; //get on iPaymu dashboard
    $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; //url
    $method       = 'POST'; //method

    //Request Body//
    $body['product']    = $_POST['product'];
    $body['qty']        = $_POST['qty'];
    $body['price']      = $_POST['price'];
    $body['buyerName']  = $_POST['buyerName'];
    $body['buyerPhone'] = $_POST['buyerPhone'];

    $body['returnUrl']  = 'https://www.an-dox.com/after-login/status_order-login.php?order_id='. $order_id;
    $body['cancelUrl']  = 'https://ipaymu.com/cancel';
    $body['notifyUrl']  = 'https://www.an-dox.com/after-login/status_order-login.php?order_id=' . $order_id;
    //End Request Body//

    //Generate Signature
    // *Don't change this
    $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
    $requestBody  = strtolower(hash('sha256', $jsonBody));
    $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
    $signature    = hash_hmac('sha256', $stringToSign, $secret);
    $timestamp    = Date('YmdHis');
    //End Generate Signature


    $ch = curl_init($url);

    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
        'va: ' . $va,
        'signature: ' . $signature,
        'timestamp: ' . $timestamp
    );

    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_POST, count($body));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $err = curl_error($ch);
    $ret = curl_exec($ch);
    curl_close($ch);
    if ($err) {
        echo $err;
    } else {

        //Response
        $ret = json_decode($ret);
        // var_dump($ret);
        if ($ret->Status == 200) {
            $sessionId  = $ret->Data->SessionID;
            $url        =  $ret->Data->Url;
            header('Location:' . $url);
        } else {
            echo $ret;
        }
        //End Response
    }

    ?>