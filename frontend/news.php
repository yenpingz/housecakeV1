<?php
require_once("../connection/database.php");
$sth = $db->query("SELECT * FROM news WHERE newsID=".$_GET["newsID"]);
$news = $sth->fetch(PDO::FETCH_ASSOC);

$sth2 = $db->query("SELECT * FROM news ORDER BY publishedDate DESC");
$lastestnews = $sth2->fetch(PDO::FETCH_ASSOC);


 ?>

 <!doctype html>
 <!-- Website template by freewebsitetemplates.com -->
 <html>
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>singlepost - Cake House</title>
 	<?php require_once("template/files.php"); ?>
 </head>
 <body>
 	<div id="page">
 		<?php require_once("template/header.php"); ?>
 		<div id="body">
 			<div class="header">
 				<div>
 					<h1>Single Post</h1>
 				</div>
 			</div>
 			<div class="singlepost">
 				<div class="featured">
 					<img src="../images/strwberry-delights.jpg" alt="">
 					<h1><?php echo $news["title"]; ?></h1>
 					<span><?php echo $news["publishedDate"]; ?></span>
 					<p><?php echo $news["content"]; ?></p>
 					<a href="newslist.php" class="load">返回最新消息列表</a>
 				</div>
 				<div class="sidebar">
 					<h1>最新消息</h1>
 					<img src="../images/on-diet.png" alt="">
 					<h2><?php echo $lastestnews["title"]; ?></h2>
 					<span><?php echo $lastestnews["publishedDate"]; ?></span>
 					<p><?php echo mb_substr($lastestnews["content"],0,50,"utf-8")."..."; ?></p>
 					<a href="news.php?newsID=<?php echo $lastestnews["newsID"]; ?>" class="more">Read More</a>
 				</div>
 			</div>
 		</div>
 		<?php require_once("template/footer.php"); ?>
 	</div>
 </body>
 </html>
