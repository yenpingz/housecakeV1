<?php
require("../../connection/database1.php");
$sql = "DELETE FROM member WHERE memberID=".$_GET['memberID'];
$sth = $db->prepare($sql);
$sth->execute();
header('Location: list.php');
 ?>
