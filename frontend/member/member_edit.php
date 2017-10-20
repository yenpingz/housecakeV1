<?php
   require_once("../../connection/database.php");
	 if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){
      $sql= "UPDATE member SET
                name = :name,
                birthday = :birthday,
                phone = :phone,
                email = :email,
                address = :address,
                updatedDate = :updatedDate WHERE memberID=:memberID";
      $sth = $db ->prepare($sql);
      $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
      $sth ->bindParam(":birthday", $_POST['birthday'], PDO::PARAM_STR);
      $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
      $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
      $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
      $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
      $sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
      $sth -> execute();
      header('Location: member_edit.php?memberID='.$_POST['memberID']);
    }
		$sth = $db->query("SELECT * FROM member WHERE memberID=".$_GET['memberID']);
    $member = $sth->fetch(PDO::FETCH_ASSOC);

 ?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-會員資料修改</title>
	<?php require_once("../template/files2.php"); ?>
  <script type="text/javascript">
  $( function() {
    $( "#birthday" ).datepicker({
        dateFormat: "yy-mm-dd"
      });
  });
  </script>
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
				<div id="MemberForm">
					<h1>會員資料修改</h1>
					<form class="form-horizontal" role="form" action="member_edit.php" method="post" data-toggle="validator">
						<input type="hidden" name="MM_update" value="EditForm">

						<table>
								<tr>
									<th>帳號：</th>
									<td><?php echo $member['account']; ?></td>
								</tr>
								<tr>
									<th>姓名：</th>
									<td>
										<input type="text" name="name" value="<?php echo $member['name']; ?>">
										<div class="help-block with-errors"></div>
									</td>
								</tr>
								<tr>
									<th>性別：</th>
									<td>
										<input type="radio" name="Gender" value="0" checked="true"> 男
										<input type="radio" name="Gender" value="1" > 女
									</td>
								</tr>
                <tr>
									<th>生日：</th>
									<td><input type="input" class="form-control" id="birthday" name="birthday" value="<?php echo $member['birthday']; ?>"></td>
								</tr>
								<tr>
									<th>EMAIL：</th>
									<td><input type="email" name="email" value="<?php echo $member['email']; ?>"></td>
								</tr>
								<tr>
									<th>行動電話：</th>
									<td><input type="text" name="phone" value="<?php echo $member['phone']; ?>"></td>
								</tr>
								<tr>
									<th>地址：</th>
									<td><input type="text" name="address" value="<?php echo $member['address']; ?>"></td>
								</tr>
								<tr>
									<input type="hidden" name="memberID" value="<?php echo $member['memberID'] ?>">
                  <input type="hidden" name="MM_update" value="UPDATE">
									<input type="hidden" name="updatedDate" value="<?php echo date('Y-m-d H-i-s'); ?>">
									<td colspan="2" align="center"><input type="submit" value="更新資料" id="submit" ></td>
								</tr>
						</table>
					</form>

				</div>

			</div>
		</div>
		<?php require_once("../template/footer.php"); ?>
	</div>
</body>
</html>
