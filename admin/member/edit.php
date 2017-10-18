<?php
   require_once("../../connection/database.php");
   if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){

     if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){

      //取得檔名
      $path = $_FILES['picture']['name'];
      //取得副檔名
      $ext = pathinfo($path, PATHINFO_EXTENSION);
      //重新命名, 2位數加時間
      $filename = rand(10,100).date('His').".".$ext;
      move_uploaded_file($_FILES['picture']['tmp_name'],"../../uploads/members/".$filename);   // 搬移上傳檔案

    }else{
      $filename = $_POST['picture1'];

    }


      $sql= "UPDATE member SET
                picture = :picture,
                phone = :phone,
                email = :email,
                address = :address,
                updatedDate = :updatedDate WHERE memberID=:memberID";
      $sth = $db ->prepare($sql);
      $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
      $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
      $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
      $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
      $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
      $sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
      $sth -> execute();
      header('Location: list.php');
    }
    $sth = $db->query("SELECT * FROM member WHERE memberID=".$_GET['memberID']);
    $member = $sth->fetch(PDO::FETCH_ASSOC);

 ?>




<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/validator.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="..\css\admin.css" rel="stylesheet" type="text/css">
  </head><body>
    <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sweet House</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#">頁面管理</a>
            </li>
            <li>
              <a href="#">最新消息管理</a>
            </li>
            <li>
              <a href="#">產品管理</a>
            </li>
            <li>
              <a href="#">訂單管理</a>
            </li>
            <li class="active">
              <a href="#">會員管理</a>
            </li>
            <li>
              <a href="#">登出</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">會員管理</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li>
                <a href="#">主控台</a>
              </li>
              <li>
                <a href="#">會員管理</a>
              </li>
              <li class="active">新增一筆</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" data-toggle="validator" action="edit.php" method="post">

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="picture" class="control-label">會員照片</label>
                </div>
                <div class="col-sm-10">
                  <img src="../../uploads/members/<?php echo $member['picture']; ?>"><?php echo $member['picture']; ?>
                  <input type="file" class="form-control" id="picture" name="picture">
                  <?php echo $member['picture']; ?>
                  <input type="hidden" name="picture1" value="<?php echo $member['picture']; ?>">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="name" class="control-label">會員姓名</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $member['name'] ?>" data-error="" required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="account" class="control-label">帳號</label>
                </div>
                <div class="col-sm-10">
                  <label for="account"   class="control-label"><?php echo $member['account'] ?></label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="phone" class="control-label">電話</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $member['phone'] ?>"  required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="email" class="control-label">Email</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $member['email'] ?>"  required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="address" class="control-label">地址</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" name="address" value="<?php echo $member['address'] ?>"  required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="memberID" value="<?php echo $member['memberID'] ?>">
                  <input type="hidden" name="MM_update" value="UPDATE">
                  <input type="hidden" name="updatedDate" value="<?php echo date('Y-m-d H-i-s'); ?>">
                  <button type="submit" class="btn btn-primary">送出</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="section section-primary">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>聖保羅廚房</h1>
            <p contenteditable="true">版權所有 © 2016 &nbsp; St Paul Kitchen All Right Reserved.</p>
          </div>
        </div>
      </div>
    </footer>

</body></html>
