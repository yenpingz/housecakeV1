<?php
  require_once("database.php");
  $sth = $db->query("SELECT * FROM news");
  $all_news = $sth->fetchAll(PDO::FETCH_ASSOC);
  print_r($all_news);
  echo "<br>";
  print_r($all_news[1]);
  echo "<br>";
  echo  $all_news[1]["title"];
 ?>
