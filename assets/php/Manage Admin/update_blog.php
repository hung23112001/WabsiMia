<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Cập nhật blog</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <style>
    body{
      margin: 0;
      padding: 0; 
    }
    .container{
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #FFEFD5;
    }
    .formUpdate_BlogWeb{
      position: relative;
      width:35%;
      background-color: #DEB887;
      margin: auto;
      text-align: left;
      border: 1px solid #88888850;
      border-radius: 8px;
      padding: 15px 30px;
      display: flex;
      flex-direction: column;
      justify-content: space-evenly;
      box-shadow: 0 2px 4px rgb(0 0 0 / 30%), 0 8px 16px rgb(0 0 0 / 30%);
    }
    h1{
      margin:15px auto 10px;
      text-align: center;
    }
    p{
      font-size: 20px;
      margin: 10px 5px;
    }
    input{
      padding: 10px 15px;
      border: 1px solid #d3d3d3;
      font-size: 16px;
      border-radius: 8px;
    }
    .submit_updateBlog{
      margin: 25px auto 0;
      padding: 10px 15px;
      border-radius: 5px;
      font-size: 16px;
      border: 1px solid #888888;
    }
    .submit_updateBlog:hover{
      cursor: pointer;
      color: white;
      font-weight: bold;
      background-image: linear-gradient(0,#d68f60,#e28744);
    }
    .icon_close{
        position: absolute;
        top:8px;
        cursor: pointer;
        right: 12px;
        color: black;
        z-index: 5;
    }
    .icon_close:hover{
        top:4px;
        right: 4px;
        color: white;
        padding: 3px 7px;
        border-radius:50%;
    }
</style>
</head>
<body>
<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';
    echo "<div class='container'>";
      $ID = $_GET['id_blog'];
      $query = "SELECT * FROM blogweb WHERE ID_blog='$ID'";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_array($result);

      echo "<form method='post' class = 'formUpdate_BlogWeb'>";
        echo "<h1>Cập nhật blog website</h1>";

        echo "<p> ID </p>";
        echo "<input readonly type='text' name='idBlog_news' value ='{$row['ID_blog']}' >";

        echo "<p> Tiêu Đề</p>";
        echo "<input required type='text' name='titleBlog_news' value ='{$row['tieuDe']}' >";

        echo "<p>Link ảnh</p>";
        echo "<input required style='background-color:white' type='file' name='imgBlog_news' value ='{$row['linkAnh']}' >";

        echo "<p>Link Blog</p>";
        echo "<input required type='text' name='linkBlog_news' value ='{$row['linkBlog']}' >";

        echo "<p>Trạng Thái</p>";
        echo "<input required type='text' name='status_news' value ='{$row['trangThai']}' >";

        echo "<input type='submit' class='submit_updateBlog' name='update_blog' value='Cập nhật blog'>";
        echo "<a href='../manage_account.php?id_active=4'><i style='font-size: 23px' class='fas fa-times icon_close'></i></a>";
      echo "</form>";
    echo "</div>";

  if(isset($_POST['update_blog'])) {
    $ID = $_POST['idBlog_news'];
    $tieuDe = $_POST['titleBlog_news'];
    $linkAnh = $_POST['imgBlog_news'];
    $linkBlog = $_POST['linkBlog_news'];
    $trangThai = $_POST['status_news'];

    $sql_update = "UPDATE blogweb SET tieuDe='$tieuDe', linkAnh='$linkAnh', linkBlog='$linkBlog', trangThai='$trangThai' WHERE ID_blog ='$ID'";
    if(mysqli_query($conn, $sql_update)){
            echo " <script> alert ('Cập nhật thành công');";
            echo " location.href='../manage_account.php' </script>";
    }
    else{
      echo " <script> alert ('Lỗi cập nhật. Vui lòng thử lại');";
      echo " location.href='../manage_account.php' </script>";

    }
}
?>
</body>
</html>
