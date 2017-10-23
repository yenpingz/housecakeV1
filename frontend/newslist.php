<?php
session_start();
require_once("../connection/database.php");

$limit = 2;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;
$sth = $db->query("SELECT * FROM news ORDER BY publishedDate DESC LIMIT ".$start_from.",". $limit);
$all_news = $sth->fetchAll(PDO::FETCH_ASSOC);
$totalRows = count($all_news);

$sth2 = $db->query("SELECT * FROM news WHERE newsID=4 ");
$news = $sth2->fetch(PDO::FETCH_ASSOC);

 ?>

<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>最新消息 - Cake House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>最新消息</h1>
				</div>
			</div>
			<div class="blog">
				<div class="featured">
					<ul>
						<?php foreach ($all_news as $row ){  ?>
						<li>
							<img src="../images/new-chills.png" alt="">
							<div>
								<h1><?php echo $row["title"]; ?></h1>
								<span><?php echo $row["publishedDate"]; ?></span>
								<p><?php echo mb_substr($row["content"],0,50,"utf-8")."..."; ?></p>
								<a href="news.php?newsID=<?php echo $row["newsID"]; ?>" class="more">Read More</a>
							</div>
						</li>
					<?php } ?>
					</ul>

				</div>
				<div class="sidebar">
					<h1>Recent Posts</h1>
					<img src="../images/on-diet.png" alt="">
					<h2><?php echo $news["title"]; ?></h2>
					<span><?php echo $news["publishedDate"]; ?></span>
					<p><?php echo mb_substr($news["content"],0,50,"utf-8")."..."; ?></p>
					<a href="news.php?newsID=<?php echo $news["newsID"]; ?>" class="more">Read More</a>
				</div>
			</div>

      <div class="section">
        <div class="container">
          <?php  if($totalRows > 0){
             $sth = $db->query("SELECT * FROM news ORDER BY PublishedDate DESC ");
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

		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
