<?php
    require_once("../../connection/database1.php");
    $sth = $db->query("SELECT * FROM member");
    $all_member = $sth->fetchAll(PDO::FETCH_ASSOC);

    $limit = 10;
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
    $start_from = ($page-1) * $limit;
    $sth = $db->query("SELECT * FROM member  LIMIT ".$start_from.",". $limit);
    $all_member = $sth->fetchAll(PDO::FETCH_ASSOC);
    $totalRows = count($all_member);
 ?>

<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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
          <a class="navbar-brand" href="#" contenteditable="true">Sweet House</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
          <ul class="nav navbar-nav navbar-right">
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
                <a href="#" class="active">會員管理</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a href="add.php" class="btn btn-default">新增會員</a>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>會員姓名</th>
                  <th>會員帳號</th>
                  <th>行動電話</th>
                  <th>E-mail</th>
                  <th>編輯</th>
                  <th>刪除</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($all_member as $row) { ?>
                <tr>
                  <td><?php echo $row["name"]; ?></td>
                  <td><?php echo $row["account"]; ?></td>
                  <td><?php echo $row["phone"]; ?></td>
                  <td><?php echo $row["email"]; ?></td>
                  <td><a href="edit.php?memberID=<?php echo $row["memberID"];?>">編輯</a></td>
                  <td><a href="delete.php?memberID=<?php echo $row["memberID"];?>" onclick="if(!confirm('是否刪除此筆資料？')){return false;};">刪除</a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">

        <?php  if($totalRows > 0){
           $sth = $db->query("SELECT * FROM member  ");
           $data_count = count($sth ->fetchAll(PDO::FETCH_ASSOC));
           $total_pages = ceil($data_count / $limit);
          ?>

        <div class="row">

          <div class="col-md-12 text-center">
            <ul class="pagination">
              <?php   if($page > 1){ ?>
             <li>
               <a href="list.php?page=<?php echo $page-1;?>">上一頁</a>
             </li>
             <?php }else{ ?>
               <li>
                 <a href="#">上一頁</a>
               </li>
               <?php } ?>

               <?php for ($i=1; $i<=$total_pages; $i++) { ?>
                  <li>
                    <a href="list.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                  </li>
                <?php } ?>


               <?php if($page < $total_pages){ ?>
               <li>
                 <a href="list.php?page=<?php echo $page+1;?>">下一頁</a>
               </li>
               <?php }else{ ?>
                 <li>
                   <a href="#">下一頁</a>
                 </li>
                 <?php } ?>

            </ul>
          </div>
        </div>
        <?php } ?>
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
