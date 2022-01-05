<?php

include("./Lib/Conn.php");
$Util = new UtilClass();

$product_id =  $_POST['PRODUCT_ID'];  

$sql = "SELECT * FROM product where product_id";

?>