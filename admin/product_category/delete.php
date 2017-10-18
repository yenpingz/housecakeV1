<?php
require("../../connection/database.php");
/*$sql = "DELETE FROM cakecategory WHERE cakecategoryID=".$_GET['cakecategoryID'];
$sth = $db->prepare($sql);
$sth->execute();*/
$sth = $db->query("DELETE FROM cakecategory WHERE cakecategoryID=".$_GET['cakecategoryID']);
header('Location: list.php');
 ?>
