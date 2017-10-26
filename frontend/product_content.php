<?php
require_once("../connection/database.php");
session_start();
print_r($_SESSION['Cart']);
$sth = $db->query("SELECT * FROM cakecategory WHERE cakecategoryID=".$_GET["cakecategoryID"]);
$cakecategory = $sth->fetch(PDO::FETCH_ASSOC);

$sth = $db->query("SELECT * FROM product WHERE productID=".$_GET["productID"]);
$product = $sth->fetch(PDO::FETCH_ASSOC);
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
  <script type="text/javascript" src="../assets/js/jquery.js"></script>
  <script type="text/javascript">
/*
  $( function() {
      $('.quantity-button').click(function() {
        var num = 1;
        num = $('input[name="Quantity"]').val();
        if($(this).find('i').hasClass('fa-plus')){
          if(num<20)num++;
          console.log(num);
        }else{
          if(num>1)num--;
          console.log(num);
        }
        $('input[name="Quantity').val(num);
      });
  });*/
  $( function() {
      $('.quantity-button').click(function() {
        var num = 1;
        num = $('#Quantity').val();
        if($(this).find('i').hasClass('fa-plus')){
          if(num<20)num++;
          console.log(num);
        }else{
          if(num>1)num--;
          console.log(num);
        }
        $('#Quantity').val(num);
      });
  });
  </script>
<?php
if(isset($_GET['Existed']) && $_GET['Existed'] != null){
  if($_GET['Existed'] == 'true'){
    echo "<script>alert('此商品已存在購物車，請至我的購物車修改數量。')</script>";
  }else{
    echo "<script>alert('成功加入購物車!')</script>";
  }
}
 ?>
</head>
<body>
  <div id="fb-root"></div>
      <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.10';
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>





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
				  <li class="active"><a href="product_no_category.php">全部</a></li>
				  <li><a href="product_category.php?cakecategoryID=<?php echo $cakecategory['cakecategoryID'] ?>"><?php echo $cakecategory['categoryName']; ?></a></li>
				  <li class="active"><?php echo $product['name']; ?></li>
				</ol>
				<div id="Product">

					<div class="content-left">
						<img src="../uploads/products/<?php echo $product['picture']; ?>" alt="">
					</div>
					<div class="content-right">
						<h2><?php echo $product['name']; ?></h2>
						<form class="" action="addCart.php" method="post">
							<table id="ProductTable">
								<tr>
									<td width="20%">價格：</td>
									<td class="price">
										NT$<?php echo $product['price']; ?>
									</td>
								</tr>
								<tr>
									<td>數量：</td>
									<td>
										<div class="quantity-button">
											<i class="fa fa-minus" aria-hidden="true"></i>
										</div>
										<input type="text" id="Quantity" name="Quantity" value="1">
										<div class="quantity-button">
											<i class="fa fa-plus" aria-hidden="true"></i>
										</div>
									</td>
								</tr>
								<tr>
                  <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
                  <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                  <input type="hidden" name="picture" value="<?php echo $product['picture']; ?>">
                  <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
                  <input type="hidden" name="cakecategoryID" value="<?php echo $product['product_cakecategoryID']; ?>">
									<td colspan="2"><input type="submit" class="cart" value="加入購物車"></td>
								</tr>
							</table>
						</form>
					</div>
					<div class="clearboth"></div>
					<hr>
					<p>商品說明</p>
          <p><div class="fb-comments" data-href="https://www.facebook.com/%E9%81%8A%E6%A8%82%E7%AF%80-149193725823228/?modal=admin_todo_tour" data-width="100%" data-numposts="5"></div></p>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
