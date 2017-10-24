<?php
   require_once("../../connection/database.php");
   if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){
      $sql= "UPDATE customer_order SET status =:status,
                updatedDate = :updatedDate WHERE customer_orderID=:customer_orderID";
      $sth = $db ->prepare($sql);

      $sth ->bindParam(":status", $_POST['status'], PDO::PARAM_STR);
      $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
      $sth ->bindParam(":customer_orderID", $_POST['customer_orderID'], PDO::PARAM_INT);
      $sth -> execute();

      header('Location: list.php?status='.$_POST['status']);
    }
    $sth = $db->query("SELECT * FROM customer_order WHERE customer_orderID=".$_GET['ID']);
    $orderone = $sth->fetch(PDO::FETCH_ASSOC);

 ?>

<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/validator.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../tinymce/skins/lightgray/skin.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/js/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="..\css\admin.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery-ui/jquery-ui.js"></script>
    <script type="text/javascript">
    $( function() {
      $( "#updatedDate" ).datepicker({
          dateFormat: "yy-mm-dd"
        });
    } );
      //textarea
      tinymce.init({
          selector: 'textarea',
          height: 500,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help'
          ],
          toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
          content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css']
        });
    </script>

  </head><body>
    <?php include_once("../template/nav.php") ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">訂單編輯</h1>
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
                <a href="#">訂單編輯</a>
              </li>
            
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
                  <label for="updatedDate" class="control-label">訂單日期</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $orderone['orderDate']; ?>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="title" class="control-label">訂單編號</label>
                </div>
                <div class="col-sm-10">
                  <?php echo $orderone['orderNO']; ?>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="title" class="control-label">訂單狀態</label>
                </div>
                <div class="col-sm-10">
                    <input type="radio" name="status" value="0" <?php if($orderone['status']==0) echo "checked"; ?>>未付款
                    <input type="radio" name="status" value="1" <?php if($orderone['status']==1) echo "checked"; ?>>已付款出貨中
                    <input type="radio" name="status" value="2" <?php if($orderone['status']==2) echo "checked"; ?>>交易完成
                    <input type="radio" name="status" value="99" <?php if($orderone['status']==99) echo "checked"; ?>>取消訂單
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-2">
                  <label for="title" class="control-label">訂購人</label>
                </div>
                <div class="col-sm-10">
                    <?php  echo $orderone['name']; ?>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="customer_orderID" value="<?php echo $orderone['customer_orderID'] ?>">
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
