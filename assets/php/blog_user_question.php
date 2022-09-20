<?php
  require '/xampp/htdocs/Web/WABSI-MIA/connect.php';
  session_start();
  if(isset($_SESSION['user'])){
      $userName =  $_SESSION['user'];
      $sql_getInfoPage = "SELECT * FROM taikhoan WHERE tenTK = '$userName'";
      $result_getInfoPage = $conn->query($sql_getInfoPage);
      if($result_getInfoPage->num_rows>0){
          $row_getInfoPage = $result_getInfoPage->fetch_assoc();
          $ID_userPage = $row_getInfoPage['ID'];
      }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../img/img-all/logo_web.jpg"/>
    <title>Wabsi Mia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel ='stylesheet' href="../css/CSS_allPage.css">
    <link rel ='stylesheet' href="../css/css_blogUser_Q.css">
    <style media="screen">
        .form_onTop{
            position: fixed;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .overlay{
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(255,255,255,0.4);
        }
        .layout{
            position: relative;
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            z-index: 2;
            box-shadow: 3px 3px 5px 3px #888888;
        }
        .form_updateCmt{
            width: 360px;
            text-align: center;
            background: #FFCC9999;
            padding: 25px;
        }
        .form_updateCmt input{
            width: 92%;
            margin: 10px auto;
            padding: 8px 12px;
            background: white;
        }
        .form_updateCmt input:last-child{
            display: table;
        }
    </style>
</head>
<body>
<!-- header -->
<?php
  require_once "../Main/header.php";
?>
<!-- body -->
  <div id="navigation" class="col-12">
    <!-- Section : Phần nội dung bên trái -->
    <section>
        <div class='menu_section_one'>
                <div class='item_menu_one'>
                    <button> <a href="./blog_user.php" style="color: black">Câu hỏi thường gặp</a></button>
                </div>
                <div class='item_menu_one'>
                    <button> <a href="./blog_user_question.php" style="color: black">Tất cả các bài viết</a></button>
                </div>
                <div class='item_menu_one'>
                    <button><a href="./show_blog_user.php" style="color: black">Bài viết của bạn </a></button>
                </div>
        </div>
    </section>
    <!-- Aside : Phần nội dung bên phải-->
    <aside>
      <div class="your-question">
          <h1 style="font-size:2.3rem; "> Bạn muốn hỏi điều gì?</h1>
          <label for="question-checkbox"  class="question-user">
              <span style='font-size: 16px;  line-height: 16px;' > Xin chào, hôm nay bạn thế nào? </span>
          </label>
          <input type="checkbox" hidden id="question-checkbox" class="question-checkbox">

          <div class="blog_question">
              <form enctype="multipart/form-data" method='post' class='form_addBlogUser' id='form_addBlogUser'>
                  <label for= 'question-checkbox'  class= 'question-close'>
                      <i class= 'fa fa-times' aria-hidden= 'true'></i>
                  </label>
                  <h1><center style = 'font-size: 27px;'>Tạo bài viết </center> </h1>
                  <?php echo "<input type ='text' style = 'display: none' name ='ID' value = '$ID_userPage'>"; ?>
                  <textarea required  class='noiDung' name='noiDung' id='noiDung' rows = '10' cols='30' style='font-size: 17px; resize: none;' placeholder='Bạn muốn giải đáp vấn đề gì?'></textarea>
                  <span id='textContent' style='font-size: 1.5rem; color: red; text-align: center;'></span>
                  <span style = 'font-size: 16px; margin: 0px 28px;'>Link ảnh</span>
                  <input required type='file' name='hinhAnh' required style = ' margin: 0 20px'> <br/>
                  <input type='submit' class='submit_question' name='New_question' value='Đăng'>
              </form>
          </div>
      </div>
      <script type="text/javascript">
          document.addEventListener('DOMContentLoaded',function(){
             var form_addBlogUser = document.querySelector('#form_addBlogUser');
             const btn_submit = document.querySelector('.submit_question');
             btn_submit.disabled = true;

             function checkInputBlog() {
                var noiDung = document.querySelector('#noiDung');
                var span_textContent = document.querySelector('#textContent');
                noiDung.onchange = function() {
                    if (noiDung.value.length < 10) {
                        span_textContent.innerHTML = 'Bạn phải nhập câu hỏi trên 10 ký tự!';
                    }
                    else{
                        span_textContent.innerHTML = '';
                      btn_submit.disabled = false;
                   }
                }
             }
             form_addBlogUser.onkeyup = checkInputBlog;
         });
      </script>
      <?php
          if(isset($_POST['New_question'])) {
              $noiDung = $_POST['noiDung'];
              $ID = $_POST['ID'];

              $file = $_FILES['hinhAnh'];
              $hinhAnh = $file['name'];
              move_uploaded_file($file['tmp_name'],'../img/img_blog_user/'.$hinhAnh);

              $add_question = "INSERT INTO bloguser(ID_taiKhoan, noiDung,hinhAnh, tuongTac) VALUES ('$ID', '$noiDung', '$hinhAnh', '0')";
              if($conn->query($add_question) == TRUE){
                  echo " <script> alert ('Đăng thành công'); </script>";
                  echo "<script> location.href='blog_user_question.php' </script>";
              }
          }
      ?>

      <div class="all-question">
          <?php
            $sql_blog_user = "SELECT * FROM bloguser, taikhoan WHERE bloguser.ID_taiKhoan = taikhoan.ID";
            $result_show_user_question = $conn -> query($sql_blog_user);
            if ($result_show_user_question-> num_rows >0) {
                $x = 0;
                $box = 0;
                while ($row_infoBlog = $result_show_user_question -> fetch_assoc()) {
                    $x = $x+1;
                    echo "<div class='item_blog'>";
                        echo "<div class= 'item-question'>";
                            echo "<div class='info-user'>";
                                echo "<img class = 'img-avatar' src ='../img/img-avatar/{$row_infoBlog['avatar']}'>";
                                echo "<div class='infoUser_content'>";
                                        echo "<h3>{$row_infoBlog['tenTK']}</h3>";
                                        echo "<p>{$row_infoBlog['ngayTao']}</p>";
                                    echo "</div>";
                            echo "</div>";
                            echo "<div class= 'question'>";
                                echo "<div class= 'question_answer'>";
                                        echo "<p class='question_content'>{$row_infoBlog['noiDung']}</p>";
                                    echo "</div>";
                                echo "<div style = 'display: flex; justify-content: center;'>";
                                        echo "<img class= 'img_blog' src='../img/img_blog_user/{$row_infoBlog['hinhAnh']}'>";
                                    echo "</div>";
                            echo "</div>";
                            echo "<div class='interactive'>";
                                $select_interactive = "SELECT * FROM tuongtac, taikhoan, bloguser
                                                    WHERE (tuongtac.ID_Blog = '{$row_infoBlog['ID_blog']}' and tuongtac.ID_Blog = bloguser.ID_blog) and
                                                    (tuongtac.ID_TaiKhoan = '$ID_userPage' and  tuongtac.ID_TaiKhoan = taikhoan.ID)";
                                $result_interactive = $conn->query($select_interactive);
                                if($result_interactive ->num_rows>0){
                                    $row_interactive = $result_interactive->fetch_assoc();
                                    echo "<p class='heart_blog'>";
                                        if($row_interactive['trangThai'] == "yes"){
                                            echo "<a href='./blog_user_question.php?dislikeBlog&id_interactive={$row_interactive['ID_tuongtac']}&idBlog={$row_infoBlog['ID_blog']}&tuongTac={$row_infoBlog['tuongTac']}'>";
                                            echo "<i class='fas fa-heart'></i>";
                                        }
                                        else{
                                            echo "<a href='./blog_user_question.php?likeBlog&id_interactive={$row_interactive['ID_tuongtac']}&idBlog={$row_infoBlog['ID_blog']}&tuongTac={$row_infoBlog['tuongTac']}'>";
                                            echo "<i class='far fa-heart'></i>";
                                        }
                                        echo "</a>";
                                        echo "<span class='number_{$x}' value='{$row_infoBlog['tuongTac']}'>{$row_infoBlog['tuongTac']}</span>";
                                    echo "</p>";
                                }
                                else{
                                    echo "<p class='heart_blog'>";
                                        echo "<a href='./blog_user_question.php?insert_likeBlog&idBlog={$row_infoBlog['ID_blog']}&tuongTac={$row_infoBlog['tuongTac']}&id_acc={$ID_userPage}'>";
                                            echo "<i class='far fa-heart'></i>";
                                        echo "</a>";
                                        echo "<span class='number_{$x}'value='{$row_infoBlog['tuongTac']}'>{$row_infoBlog['tuongTac']}</span>";
                                    echo "</p>";
                                }
                                echo "<p class='hover_comment showComment_blogNumber_{$x}' style='font-size: 1.5rem; cursor: pointer;'>Xem Bình luận</p>";
                            echo "</div>";

                            $sql_comment = "SELECT *, bloguser.noiDung as ND_blog, comment.noiDung as ND_comment FROM bloguser,taikhoan, comment
                                          WHERE (comment.ID_taikhoan = taikhoan.ID) and (comment.ID_blog = '{$row_infoBlog['ID_blog']}' and comment.ID_blog = bloguser.ID_blog)";
                            $result_comment = $conn -> query($sql_comment);

                            if ( $result_comment -> num_rows > 0) {
                                $y = $box;
                                while($row_infoCommentBlog = $result_comment -> fetch_assoc()){
                                    $y = $y +1;
                                    echo "<div class='commented commentNumber_{$x}' style='display:none'>";
                                        echo "<div class='user_comment'>";
                                            echo "<img class = 'img-avatar_comment' src ='../img/img-avatar/{$row_infoCommentBlog['avatar']}'>";
                                            echo "<div class='infoUser_comment'>";
                                                echo "<h3>{$row_infoCommentBlog['tenTK']}</h3>";
                                                echo "<p class='time-question-comment'>{$row_infoCommentBlog['ngayTao']}</p>";
                                            echo "</div>";
                                        echo "</div>";
                                        echo "<p class='content_comment'>{$row_infoCommentBlog['ND_comment']}</p>";
                                        echo "<div class='menu_comment menuComment_number_{$y}' >";
                                              echo "<i style='font-size: 1.5rem; padding: 5px; ' class='fas fa-ellipsis-v'></i>";
                                              echo "<div class='item_menuComment showBox_comment_{$box}'style='display:none'>";
                                                  if (isset($userName) && $userName == $row_infoCommentBlog['tenTK']){
                                                      echo "<a href='./Manage User/delete_comment.php?id_cmt={$row_infoCommentBlog['ID_comment']}'><p>Xóa </p></a>";
                                                      echo "<a href='./blog_user_question.php?id_edit_cmt={$row_infoCommentBlog['ID_comment']}&noiDung={$row_infoCommentBlog['noiDung']}'><p>Sửa </p></a>";
                                                  }
                                                  else{
                                                      echo "<a href=''><p>Báo cáo</p></a>";
                                                  }
                                              echo"</div>";
                                        echo "</div>";

                                        echo "<script>";
                                            echo "document.addEventListener('DOMContentLoaded',function(){";
                                                echo "var countCheck_clickBlog_{$x} = 0;";
                                                echo "document.querySelector('.showComment_blogNumber_{$x}').onclick = function(){
                                                    if(countCheck_clickBlog_{$x} %2 == 0){
                                                        document.querySelectorAll('.commented.commentNumber_{$x}').forEach((item,index) => {
                                                            item.style.display = 'block';
                                                        });
                                                        document.querySelector('.showComment_blogNumber_{$x}').innerText = 'Ẩn bình luận';
                                                    }
                                                    else{
                                                        document.querySelectorAll('.commented.commentNumber_{$x}').forEach((item,index) => {
                                                            item.style.display = 'none';
                                                        });
                                                        document.querySelector('.showComment_blogNumber_{$x}').innerText = 'Xem bình luận';
                                                    }
                                                    countCheck_clickBlog_{$x}+=1;
                                                };";
                                                echo "var countCheck_clickComment_{$y} = 0;";
                                                echo "document.querySelector('.menuComment_number_{$y}').onclick = function(){
                                                    if(countCheck_clickComment_{$y} %2 == 0){
                                                        document.querySelector('.item_menuComment.showBox_comment_{$box}').style.display = 'block';
                                                    }
                                                    else{
                                                        document.querySelector('.item_menuComment.showBox_comment_{$box}').style.display = 'none';
                                                    }
                                                    countCheck_clickComment_{$y}+=1;
                                                };";
                                            echo "});";
                                        echo "</script>";
                                        $box = $box +1;
                                    echo "</div>";
                                }
                            }
                            else {
                                echo "<p style ='margin: 10px; font-size: 1.35rem; padding-left: 15px;'>Chưa có ai bình luận. Viết bình luận đầu tiên!</p>";
                            }
                                echo "<form method='post'>";
                                    echo "<div class= 'input_rep-comment'>";
                                        echo "<input type ='text' style = 'display: none' name ='ID_taikhoan' value = '$ID_userPage'>";
                                        echo "<input type ='text' style = 'display: none' name ='ID_blog' value = '{$row_infoBlog['ID_blog']}'>";
                                        echo "<input required class= 'input-comment'name ='noiDung' type= 'text' placeholder= '&nbsp;Viết bình luận...'>";
                                        echo "<input type='submit' class= 'input-reply' name ='submit-reply' value= 'Trả lời'>";
                                    echo "</div>";
                                echo "</form>";
                        echo "</div>";
                    echo "</div>";
                }
            }
          ?>
      </div>
    </aside>
  </div>

  <?php
      if (isset($_GET['id_edit_cmt'])) {
          echo "<div class='form_onTop'>";
              echo "<div class='overlay'></div>";
              echo "<div class='layout'>";
                  echo "<form method='POST' action = './blog_user_question.php' class='form_updateCmt'>";
                      echo "<p style='font-size:1.9rem; font-weight:600'>Cập nhật bình luận<p>";
                      echo "<input type='text' name='ND_cmt' value='{$_GET['noiDung']}'>";
                      echo "<input type='text' name='ID_cmt' style= 'display:none;' value='{$_GET['id_edit_cmt']}'>";
                      echo "<input type='submit'style='width: 20%; background:#888888; cursor: pointer; color: white' name='submitCmt' value='Lưu'>";
                  echo "</form>";
                  echo "<a href='./blog_user_question.php'><i style='font-size: 23px; top: 14px; right: 15px; ' class='fas fa-times icon_close'></i></a>";
              echo "</div>";
          echo "</div>";
      }
      if (isset($_POST['submitCmt'])) {
          $ND_cmt = $_POST['ND_cmt'];
          $ID_cmt = $_POST['ID_cmt'];

          $update_cmt ="UPDATE comment SET noiDung = '$ND_cmt' WHERE ID_comment='$ID_cmt'";
          $result_updateCmt= $conn->query($update_cmt);
          if ($result_updateCmt === TRUE) {
              echo "<script> alert ('Cập nhật thành công'); ";
              echo "location.href='./blog_user_question.php'; </script>";
          }
          else {
              echo "<script> alert ('Cập nhập lỗi');";
              echo "location.href='./blog_user_question.php'; </script>";
          }
      }

      if(isset($_POST['submit-reply'])) {
          $ID_taikhoan =$_POST['ID_taikhoan'];
          $ID_blog = $_POST['ID_blog'];
          $noiDung = $_POST['noiDung'];

          $add_reply = "INSERT INTO comment(ID_taikhoan, noiDung, ID_blog) VALUES ('$ID_taikhoan', '$noiDung', '$ID_blog')";
          $result_addReply = $conn->query($add_reply);

          if($result_addReply == TRUE){
              echo "<script> location.href = './blog_user_question.php' </script>";
          }
          else{
              echo "<script> alert('no oke'); </script>";
          }
      }
      // Like Blog
      if(isset($_GET['insert_likeBlog'])){
          $id_blog = $_GET['idBlog'];
          $tuongtac = $_GET['tuongTac'];
          $id_acc = $_GET['id_acc'];

          $number_interactive = $tuongtac + 1;

          $sqlInsert_interactive = "INSERT INTO `tuongtac`(`trangThai`, `ID_TaiKhoan`, `ID_BLog`) VALUES ('yes','$id_acc','$id_blog')";
          
          $update_blog = "UPDATE bloguser SET tuongTac = '$number_interactive' WHERE ID_blog = '$id_blog'";

          if($conn->query($update_blog) == TRUE){
              if($conn->query($sqlInsert_interactive) == TRUE){
                  echo "<script> location.href = './blog_user_question.php'; </script>";
              }
              else{
                  echo "<script> alert('error'); </script>";
              }
          }
      }
      if(isset($_GET['dislikeBlog'])){
          $like_current = $_GET['tuongTac'];
          $like_news = $like_current - 1;

          $id_interactive = $_GET['id_interactive'];
          $id_blog = $_GET['idBlog'];

          $sql_updateInteractive = "UPDATE `tuongtac` SET `trangThai`='no' WHERE ID_tuongtac = '$id_interactive' ";
          $sql_updateBlogUser = "UPDATE bloguser SET tuongTac = '$like_news' WHERE ID_blog = '$id_blog'";

          if($conn->query($sql_updateInteractive) == TRUE){
              if($conn->query($sql_updateBlogUser) == TRUE){
                  echo "<script> location.href = './blog_user_question.php'; </script>";
              }
              else{
                  echo "<script> alert('error'); </script>";
              }
          }
      }
      if(isset($_GET['likeBlog'])){
          $like_current = $_GET['tuongTac'];
          $like_news = $like_current + 1;

          $id_interactive = $_GET['id_interactive'];
          $id_blog = $_GET['idBlog'];
          $sql_updateInteractive = "UPDATE `tuongtac` SET `trangThai`='yes' WHERE ID_tuongtac = '$id_interactive' ";
          $sql_updateBlogUser = "UPDATE bloguser SET tuongTac = '$like_news' WHERE ID_blog = '$id_blog'";

          if($conn->query($sql_updateInteractive) == TRUE){
              if($conn->query($sql_updateBlogUser) == TRUE){
                  echo "<script> location.href = './blog_user_question.php'; </script>";
              }
              else{
                  echo "<script> alert('error'); </script>";
              }
          }
      }
  ?>

<!-- footer -->
  <?php
      require_once "../Main/footer.php";
      require_once "../Main/form.php";
  ?>
</body>
</html>
