<?php
require_once('../../connection/database1.php');

//讀取news_category資料表的所有資料
$sql = 'select * from page';
$result = $db->query($sql);
$pages = $result->fetchAll(PDO::FETCH_ASSOC);
 ?>

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
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">頁面管理
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <?php foreach($pages as $row){ ?>
              <li><a href="../page/edit.php?pageID=<?php echo $row['pageID']; ?>"><?php echo $row['title']; ?></a></li>
            <?php } ?>
            </ul>
        </li>
        <li class="active">
          <a href="#">最新消息管理</a>
        </li>
        <li>
          <a href="#">產品管理</a>
        </li>
        <li>
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">訂單管理
            <span class="caret"></span></button>
            <ul class="dropdown-menu">

              <li><a href="../customer_order/list.php?status=0">未付款</a></li>
              <li><a href="../customer_order/list.php?status=1">已付款出貨中</a></li>
              <li><a href="../customer_order/list.php?status=2">交易完成</a></li>
              <li><a href="../customer_order/list.php?status=99">取消訂單</a></li>
            </ul>
        </li>
        <li>
          <a href="#">會員管理</a>
        </li>
        <li>
          <a href="../logout.php">登出</a>
        </li>
      </ul>
    </div>
  </div>
</div>
