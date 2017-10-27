<?php
require_once("../../connection/database1.php");

$sql= "INSERT INTO member
				(account,
				password,
				phone,
				createdDate) VALUES (
				:account,
				:password,
				:phone,
				:createdDate)";
	$sth = $db ->prepare($sql);
	$sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
	$sth ->bindParam("password", $_POST['password'], PDO::PARAM_STR);
	$sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
	$sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
	$sth -> execute();

			$to = "yan20170726@gmail.com";
  		$header  = 'Content-type: text/html; charset=iso-8859-1'."\r\n";
  		$header .= "From: yan20170726@gmail.com";
  		$subject = "[Cake House] 加入會員確認信";
  		$body    = "您已經加入 [Cake House] 會員確認,<br><br>";
  		$body   .= "連結在此<a href='http://120.124.165.116/c/no19/housecakeV1/apply_success.php'></a>";
  		mail($to, $subject, $body, $header);
 ?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cake House-會員申請</title>
	<?php require_once("../template/files2.php"); ?>
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
				<div id="MemberForm">
					<h2>申請會員成功!</h2>
					<p>
						您已成功加入會員，請至 <a href="member_login.php">登入頁</a>，登入您的帳號，方可進行購物。
					</p>
				</div>
			</div>
		</div>
		<?php require_once("../template/footer.php"); ?>
	</div>
</body>
</html>
