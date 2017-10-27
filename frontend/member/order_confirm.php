<?php
require_once("../../connection/database1.php");
session_start();
$sth = $db->query("SELECT * FROM member WHERE account="."'".$_SESSION["account"]."'");
$member = $sth->fetch(PDO::FETCH_ASSOC);
 ?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-我的購物車</title>
	<?php require_once("../template/files2.php"); ?>
	<link rel="stylesheet" href="../assets/css/cart.css">
</head>

<body>
	<div id="page">
		<?php require_once("../template/memberheader.php"); ?>
		<div id="body" class="contact">
			<div class="header">
				<div>
					<h1>會員專區</h1>
				</div>
			</div>
			<div class="body">

			</div>
			<div class="footer">
				<ul class="Category">
					<li><a href="member_edit.php">會員資料修改</a></li>
					<li><a href="my_cart.php">我的購物車</a></li>
					<li><a href="my_orders.php">我的訂單</a></li>
				</ul>
				<div id="OrderForm">
					<h1>商品資訊</h1>

						<table id="order-tables">
            	<thead>
            		<tr>
            			<th width="15%">商品圖片</th>
            			<th width="30%">商品名稱</th>
									<th width="10%" class="price">單價</th>
            			<th width="10%" class="quantity">數量</th>
            			<th width="10%" class="subtotal">小計</th>
            		</tr>
            	</thead>
              <tbody>
							<?php
									$sumtotal=0;
									for ($i=0; $i < count($_SESSION['Cart']); $i++) {
								?>
                <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
									<td data-title="商品圖片">
											<a href=""><img src="../../uploads/products/<?php echo $_SESSION['Cart'][$i]['picture']; ?>" alt="" width="200" height="150"></a>
									</td>
									<td class="cart_description" data-title="商品名稱">
											<h4><?php echo $_SESSION['Cart'][$i]['name'];?></h4>
									</td>
                  <td data-title="單價">$NT <?php echo $_SESSION['Cart'][$i]['price']; ?></td>
                  <td data-title="數量"><?php echo $_SESSION['Cart'][$i]['Quantity']; ?></td>
									<td data-title="小計">$NT <?php $subtotal=$_SESSION['Cart'][$i]['price'] * $_SESSION['Cart'][$i]['Quantity']; echo $subtotal; ?></td>
                </tr>
							<?php $sumtotal+=$subtotal; } ?>
								<tr>
									<td colspan="4" style="text-align: right;font-weight:bold;">運費</td>
									<td style="text-align: left;font-weight:bold;">$NT<?php if($sumtotal>1000) $shipping=0; else $shipping=150; echo $shipping;?></td>
								</tr>
								<tr>
									<td colspan="4" style="text-align: right;font-weight:bold;">總金額</td>
									<td style="text-align: left;font-weight:bold;">$NT <?php echo $sumtotal; ?></td>
								</tr>
              </tbody>
            </table>
						<hr>
						<h1>訂購資訊</h1>
						<div id="OrderForm">
							<div class="col-md-12">
		            <form class="form-horizontal" role="form" action="order_success.php" method="post">
		              <input type="hidden" class="form-control" name="MM_insert" value="AddForm">
		              <div class="form-group">
		                <div class="col-sm-2">
		                  <label for="OrderName" class="control-label">訂購人</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="OrderName" name="orderName" value="<?php echo $member['name'] ?>" required>
		                </div>
		              </div>
									<div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Name" class="control-label">收件者</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Name" name="name" value="<?php echo $member['name'] ?>" required>
		                </div>
		              </div>
									<div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Name" class="control-label">聯絡電話</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Phone" name="phone" value="<?php echo $member['phone'] ?>" required>
		                </div>
		              </div>
		              <div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Mobile" class="control-label">行動電話</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Mobile" name="mobile" value="" required>
											<input type="hidden" name="orderNO" value="<?php echo 'SH'.date('YmdHis'); ?>">
											<input type="hidden" name="orderDate" value="<?php echo date('Y-m-d H-i-s'); ?>">
											<input type="hidden" name="memberID" value="<?php echo $member['memberID']; ?>">
											<input type="hidden" name="totalPrice" value="<?php echo $sumtotal;?>">
											<input type="hidden" name="shipping" value="<?php echo $shipping;?>">
											<input type="hidden" name="createdDate" value="<?php echo date('Y-m-d H-i-s'); ?>">
		                </div>
		              </div>
									<div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Email" class="control-label">E-mail</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Email" name="email" value="<?php echo $member['email'] ?>">
		                </div>
		              </div>
		              <div class="form-group">
		                <div class="col-sm-2">
		                  <label for="Address" class="control-label">寄送地址</label>
		                </div>
		                <div class="col-sm-10">
		                  <input type="text" class="form-control" id="Address" name="address" value="<?php echo $member['address'] ?>" required>
		                </div>
		              </div>
		              <div class="form-group">
		                <div class="col-sm-10 col-sm-offset-2 text-right">
		                  <button type="submit" class="edit-button cart">確定結帳</button>
		                </div>
		              </div>
		            </form>
		          </div>
						</div>
				</div>

			</div>
		</div>
		<?php require_once("../template/footer.php"); ?>
	</div>
</body>
</html>
