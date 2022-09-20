<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
          require '/xampp/htdocs/Web/WABSI-MIA/connect.php';

          $ID_comment = $_GET['id_cmt'];
          $sql_deleteComment = "DELETE FROM comment WHERE ID_comment = '$ID_comment'";
          $result_deleteComment = $conn->query($sql_deleteComment);
          if($result_deleteComment == TRUE) {
              echo "<script>alert(` Xóa comment thành công`);
                    location.href='../blog_user_question.php';</script>";
          }
          else {
              echo "<script>alert(` Lỗi khi xóa`);
                    location.href='../blog_user_question.php';</script>";
          }
      ?>
  </body>
</html>
