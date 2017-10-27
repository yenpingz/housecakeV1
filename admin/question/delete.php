<?php
require("../../connection/database1.php");
$sql = "DELETE FROM question WHERE questionID=".$_GET['questionID'];
$sth = $db->prepare($sql);
$sth->execute();
header("Location: list.php?questioncategoryID=".$_GET['questioncategoryID']);
 ?>
