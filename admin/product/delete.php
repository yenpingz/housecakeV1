<?php
require("../../connection/database.php");
$sql = "DELETE FROM product WHERE productID=".$_GET['productID'];
$sth = $db->prepare($sql);
$sth->execute();
header("Location: list.php?cakecategoryID=".$_GET['product_cakecategoryID']);
 ?>
