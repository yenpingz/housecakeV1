<?php
session_start();
$is_existed = "false";
if(isset($_SESSION['Cart']) && $_SESSION['Cart'] != null){
  for ($i=0; $i < count($_SESSION['Cart']) ; $i++) {
    if($_POST['productID'] == $_SESSION['Cart'][$i]['productID']){
        $is_existed = "true";
        goto_previousPage($is_existed);
    }
  }
}
if($is_existed == "false"){
  $temp['cakecategoryID'] = $_POST['cakecategoryID'];
  $temp['productID'] = $_POST['productID'];
  $temp['name'] = $_POST['name'];
  $temp['picture'] = $_POST['picture'];
  $temp['price'] = $_POST['price'];
  $temp['Quantity'] = $_POST['Quantity'];
  $_SESSION['Cart'][] = $temp;
  goto_previousPage($is_existed);
}
  function goto_previousPage($is_existed){
    $url = explode('?',$_SERVER['HTTP_REFERER']);
    $location = $url[0];
    $location.= "?productID=".$_POST['productID']."&&cakecategoryID=".$_POST['cakecategoryID'];
    $location.="&Existed=".$is_existed;
    header(sprintf('Location: %s ',$location));
  }

 ?>
