<?php 
    include("../config/constants.php");
    if(isset($_GET['id_table'])){
        function keyword_generator(
            int $length = 5,
            string $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'
        ): string {
            if ($length < 1) {
                throw new \RangeException("Length must be a positive integer");
            }
            $pieces = [];
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $pieces []= $keyspace[random_int(0, $max)];
            }
            return implode('', $pieces);
        }
        $generate = keyword_generator(5);
        $id_table = $_GET['id_table'];
        $random = "UPDATE tbl_meja SET keyword = '$generate' WHERE id_table = '$id_table'";
        $res = mysqli_query($conn, $random);
        if($res == true){
            header("location:".SITEURL."admin/manage-table.php");
        } else {
            header("location:".SITEURL."admin/manage-table.php");
        }
    }
?>