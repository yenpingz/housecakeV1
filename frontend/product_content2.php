<?php
session_start();
require('../connection/database.php');
$sql = $db->query("SELECT * FROM product WHERE productID=".$_GET['productID']);
$product = $sql->fetch(PDO::FETCH_ASSOC);
if(isset($_GET['Existed']) && $_GET['Existed'] == "false"){
	echo "<script>alert('成功加入購物車!');</script>";
}
if(isset($_GET['Existed']) && $_GET['Existed'] == "true"){
	echo "<script>alert('此商品已存在購物車!，請至「我的購物車」修改數量');</script>";
}
?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>product - Cake House</title>
	<?php require_once("template/files.php"); ?>
	<link rel="stylesheet" href="../assets/css/cart.css">
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>產品介紹</h1>
				</div>
			</div>
			<div class="wrapper">
				<ol class="breadcrumb">
				  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				  <li><a href="#">蛋糕</a></li>
				  <li class="active"><?php echo $product['name']; ?></li>
				</ol>
				<div id="Product">

					<div class="content-left">
						<img src="../uploads/products/<?php echo $product['picture']; ?>" alt="">
					</div>
					<div class="content-right">
						<h2><?php echo $product['name']; ?></h2>
						<form class="" action="add_cart.php" method="post">
							<table id="ProductTable">
								<tr>
									<td width="20%">價格：</td>
									<td class="price">
										<?php echo $product['price']; ?>
										<input type="hidden" name="price" value="<?php echo $product['price']; ?>">
										<input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
									</td>
								</tr>
								<tr>
									<td>數量：</td>
									<td>
										<div class="quantity-button">
											<i class="fa fa-minus" aria-hidden="true"></i>
										</div>
										<input type="text" name="Quantity" value="1">
										<div class="quantity-button">
											<i class="fa fa-plus" aria-hidden="true"></i>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" class="cart" value="加入購物車"></td>
								</tr>
							</table>
						</form>
					</div>
					<div class="clearboth"></div>
					<hr>
					<p><?php echo $product['description']; ?></p>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
