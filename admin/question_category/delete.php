<?php
require("../../connection/database1.php");
$sql = "DELETE FROM questioncategory WHERE questioncategoryID=".$_GET['questioncategoryID'];
$sth = $db->prepare($sql);
$sth->execute();
header('Location: list.php');
 ?>
