<?php
session_start();
require_once("../connection/database.php");
$sth = $db->query("SELECT * FROM cakecategory");
$cakecategories = $sth->fetchAll(PDO::FETCH_ASSOC);

$sth2 = $db->query("SELECT * FROM product ORDER BY createdDate DESC");
$product = $sth2->fetchAll(PDO::FETCH_ASSOC);

 ?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>product - Cake House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">

			<div class="header">
				<div>
					<h1>Products</h1>
				</div>
			</div>
			<div class="wrapper">
				<ol class="breadcrumb">
				  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				  <li class="active"><a href="product_no_category.php">全部</a></li>
				</ol>
				<ul class="Category">

					<li><a href="product_no_category.php">產品分類</a></li>
					<?php foreach ($cakecategories as $row ){?>
					<li><a href="product_category.php?cakecategoryID=<?php echo $row["cakecategoryID"] ?>"><?php echo $row["categoryName"]; ?></a></li>
					<?php } ?>
				</ul>
				<ul id="Products">
					<?php foreach ($product as $row ){?>
					<li>
						<a href="product_content.php?cakecategoryID=<?php echo $row['product_cakecategoryID'] ?>&productID=<?php echo $row['productID'];?>"><img src="../uploads/products/<?php echo $row["picture"] ?>" width="200" height="150" alt=""></a>
						<a href="product_content.php?cakecategoryID=<?php echo $row['product_cakecategoryID'] ?>&productID=<?php echo $row['productID'];?>"><h2><?php echo $row["name"] ?></h2></a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
