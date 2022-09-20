<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
          require '/xampp/htdocs/Web/WABSI-MIA/connect.php';

          $ID_blogUser = $_GET['id_blogUser'];
          $sql_deleteBlogUser = "DELETE FROM bloguser WHERE ID_blog = '$ID_blogUser'";
          $result_deleteBlogUser = $conn->query($sql_deleteBlogUser);
          if($result_deleteBlogUser == TRUE) {
              echo "<script>alert(` Xóa bài viết thành công`);
                    location.href='../show_blog_user.php';</script>";
          }
          else {
              echo "<script>alert(` Lỗi khi xóa`);
                    location.href='../show_blog_user.php';</script>";
          }
      ?>
  </body>
</html>
