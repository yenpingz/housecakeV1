<?php
require("../../connection/database1.php");
$sql = "DELETE FROM news WHERE newsID=".$_GET['newsID'];
$sth = $db->prepare($sql);
$sth->execute();
header('Location: list.php');
 ?>
