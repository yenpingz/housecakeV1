<div id="tool-bar">
  <div class="container">
  <div class="tool">
    <?php if(!isset($_SESSION['account'])){ ?>
      <a href="member/member_apply.php">加入會員</a> 。 <a href="member/member_login.php">會員登入</a> 。
    <?php }else{ ?>
      <a href="member/member_edit.php">會員專區</a> 。 <a href="member/logout.php">登出</a>
      <a href="frontend/member/member_edit.php"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a>
    <?php } ?>
  </div>
</div>
</div>
<div id="header">
  <div class="container">
    <a href="index.php" class="logo"><img src="../assets/images/logo.png" alt=""></a>

    <ul id="navigation">
      <li class="selected">
        <a href="../index.php">首頁</a>
      </li>
      <li class="menu">
        <a href="about.php?pageID=3">關於我們</a>
        <ul class="primary">
          <li>
            <a href="about.php?PageID=2">購物須知</a>
          </li>
          <li>
            <a href="about.php?PageID=3">會員條款</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="product_no_category.php">產品介紹</a>
      </li>
      <li class="menu">
        <a href="newslist.php">最新消息</a>
      </li>
      <li>
        <a href="contact.php">聯絡我們</a>
      </li>
    </ul>
    <div class="clearboth">	</div>
    </div>

</div>
