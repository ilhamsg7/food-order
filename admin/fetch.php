<?php
    //fetch.php digunakan untuk membantu proses cdn databases di manage-order.php
        // define('SITEURL', 'https://www.an-dox.com/food-order/');
		// define('LOCALHOST',  'localhost');
		// define('DB_USERNAME',  'u1035172_privacy_owner');
		// define('DB_PASSWORD', 'lazarus_mission');
		// define('DB_NAME', 'u1035172_food_order');
    $connect = mysqli_connect("localhost", "u1035172_privacy_owner", "lazarus_mission", "u1035172_food_order");

    // define('SITEURL', 'http://localhost/food-order/');
	// 	define('LOCALHOST',  'localhost');
	// 	define('DB_USERNAME',  'root');
	// 	define('DB_PASSWORD', 'ZeroTwo02');
	// 	define('DB_NAME', 'food_order');
    // $connect = mysqli_connect("localhost", "root", "ZeroTwo02", "food_order");
    $columns = array('id', 'id_table', 'food', 'price', 'qty', 'total', 'order_date', 'delivered_date', 'timeout',
    'status', 'customer_name', 'customer_contact', 'customer_address');

    $query = "SELECT * FROM tbl_order WHERE ";

    if($_POST["is_date_search"] == "yes")
    {
        $query .= 'order_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
    }

    if(isset($_POST["search"]["value"]))
    {
        $query .= '
        (id LIKE "%'.$_POST["search"]["value"].'%" 
        OR id_table LIKE "%'.$_POST["search"]["value"].'%" 
        OR food LIKE "%'.$_POST["search"]["value"].'%" 
        OR price LIKE "%'.$_POST["search"]["value"].'%" 
        OR qty LIKE "%'.$_POST["search"]["value"].'%" 
        OR total LIKE "%'.$_POST["search"]["value"].'%" 
        OR order_date LIKE "%'.$_POST["search"]["value"].'%" 
        OR delivered_date LIKE "%'.$_POST["search"]["value"].'%" 
        OR timeout LIKE "%'.$_POST["search"]["value"].'%" 
        OR status LIKE "%'.$_POST["search"]["value"].'%" 
        OR customer_name LIKE "%'.$_POST["search"]["value"].'%" 
        OR customer_contact LIKE "%'.$_POST["search"]["value"].'%" 
        OR customer_address LIKE "%'.$_POST["search"]["value"].'%")
        ';
    }

    if(isset($_POST["order"]))
    {
        $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
        ';
    }
    else
    {
        $query .= 'ORDER BY id DESC ';
    }

    $query1 = '';

    if($_POST["length"] != -1)
    {
        $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    $number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

    $result = mysqli_query($connect, $query . $query1);

    $data = array();

    while($row = mysqli_fetch_array($result))
    {
        // $id untuk menangkap variabel id
        $id = $row["id"];
        $sub_array = array();
        $sub_array[] = $row["id"];
        $sub_array[] = $row["id_table"];
        $sub_array[] = $row["food"];
        $sub_array[] = $row["price"];
        $sub_array[] = $row["qty"];
        $sub_array[] = $row["total"];
        $sub_array[] = $row["order_date"];
        // $sub_array[] = $row["delivered_date"];
        $sub_array[] = $row["timeout"];
        $sub_array[] = $row["status"];
        $sub_array[] = $row["customer_name"];
        // $sub_array[] = $row["customer_contact"];
        // $sub_array[] = $row["customer_address"];
        // Untuk memunculkan tombol update
        $sub_array[] = "<a href='update-order.php?id=$id' class='btn btn-secondary' id='updateOrder'>Update</a>";
        $sub_array[] = "<a type='submit' href='manage-order.php?id=$id' class='btn btn-danger' id='print'>Print</a>";
        
        
        $data[] = $sub_array;
    }

    function get_all_data($connect) {
        $query = "SELECT * FROM tbl_order";
        $result = mysqli_query($connect, $query);
        return mysqli_num_rows($result);
    }

    $output = array(
        "draw"    => intval($_POST["draw"]),
        "recordsTotal"  =>  get_all_data($connect),
        "recordsFiltered" => $number_filter_row,
        "data"    => $data
    );

    echo json_encode($output);
    
?>