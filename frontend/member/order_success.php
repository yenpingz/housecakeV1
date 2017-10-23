<?php
session_start();
require_once("../../connection/database.php");
$sql= "INSERT INTO customer_order
				(memberID,orderNO,orderDate,totalPrice,shipping,name,phone,mobile,email,address,createdDate) VALUES (
				:memberID,
				:orderNO,
				:orderDate,
				:totalPrice,
				:shipping,
				:name,
				:phone,
				:mobile,
				:email,
				:address,
				:createdDate)";
	$sth = $db ->prepare($sql);
	$sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
	$sth ->bindParam("orderNO", $_POST['orderNO'], PDO::PARAM_STR);
	$sth ->bindParam(":orderDate", $_POST['orderDate'], PDO::PARAM_STR);
	$sth ->bindParam(":totalPrice", $_POST['totalPrice'], PDO::PARAM_INT);
	$sth ->bindParam(":shipping", $_POST['shipping'], PDO::PARAM_INT);
	$sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
	$sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
	$sth ->bindParam(":mobile", $_POST['mobile'], PDO::PARAM_STR);
	$sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
	$sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
	$sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
	$sth -> execute();
	$sth2 = $db->query("SELECT * FROM customer_order WHERE memberID=".$_POST["memberID"]." ORDER BY createdDate DESC");
	$last_order = $sth2->fetch(PDO::FETCH_ASSOC);

for ($i=0; $i < count($_SESSION['Cart']); $i++) {
	$sql= "INSERT INTO order_details
					(customer_orderID,productID,picture,name,price,Quantity,createdDate) VALUES (
					:customer_orderID,
					:productID,
					:picture,
					:name,
					:price,
					:Quantity,
					:createdDate)";
		$sth = $db ->prepare($sql);
		$sth ->bindParam(":customer_orderID", $last_order['customer_orderID'], PDO::PARAM_INT);
		$sth ->bindParam("productID", $_SESSION['Cart'][$i]['productID'], PDO::PARAM_INT);
		$sth ->bindParam(":picture", $_SESSION['Cart'][$i]['picture'], PDO::PARAM_STR);
		$sth ->bindParam(":name",  $_SESSION['Cart'][$i]['name'], PDO::PARAM_STR);
		$sth ->bindParam(":price",  $_SESSION['Cart'][$i]['price'], PDO::PARAM_INT);
		$sth ->bindParam(":Quantity",  $_SESSION['Cart'][$i]['Quantity'], PDO::PARAM_INT);
		$sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
		$sth -> execute();
}

//unset($SESSION['Cart']);
//寄信會員(管理者)

 ?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-訂購成功</title>
	<?php require_once("../template/files2.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("../template/memberheader.php"); ?>
		<div id="body" class="contact">
			<div class="header">
				<div>
					<h1>訂購成功</h1>
				</div>
			</div>
			<div class="body">

			</div>
			<div class="footer">
				<div id="MemberForm">

					<h3>
						您已成功訂購商品，請至「<a href="my_orders.php">我的訂單</a>」查詢訂單進度。
					</h3>
				</div>
			</div>
		</div>
		<?php require_once("../template/footer.php"); ?>
	</div>
</body>
</html>
