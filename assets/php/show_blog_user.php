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
    <link rel ='stylesheet' href="../css/CSS_blog_user.css">

    <style media="screen">
        section{
            width: 25%;
            left: 0;
            top: 70px;
        }
        .show_all_blogUser{
            font-size: 150%;
            line-height: 30px;
            letter-spacing: 0.5px;
        }
        .item-show_all_blogUser{
            background: white;
            border-radius: 10px;
            padding: 10px 45px 25px;
            width: 75%;
            min-height: 100px;
            margin: 20px auto;
        }
        .item_show_blog{
            margin-top: 5px;
            padding-left: 25px;
            width: 100%;
            min-height: 30px;
        }
        .info-user{
            height: 60px;
            display: flex;
        }
        .info-user h3{
            height: 30px;
            font-size: 2rem;
            margin-top: 8px;
            margin-bottom: 0;
            margin-left: 15px;
        }
        .img-avatar{
            border-radius: 50%;
            margin-top: 5px;
            width: 50px;
            height: 50px;
        }
        .time-question{
            color: rgb(49, 49, 207);
            padding-left: 60px;
            margin: -30px 0 5px 0;
            font-size: 1.3rem;
        }
        .question{
            background: #EEEEEE80;
            padding: 5px 0px;
            margin-top: 15px;
        }
        .question-answer{
            margin-top: 5px;
            padding-left: 40px;
            width: 100%;
            min-height: 30px;
            line-height: 1.4em;
        }
        .img_blog{
            width: 35%;
            margin: 10px 280px;
        }
        .interactive{
            width: 100%;
            display: flex;
            justify-content: space-between;
            background: floralwhite;
            padding: 8px 10px;
        }
        .commented{
            margin: 8px 40px;
            padding: 10px;
            width: 85%;
            border-bottom: 1px solid #88888888;
            position: relative;
        }
        .img-avatar_comment{
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .time-question-comment{
            color: rgb(49, 49, 207);
            padding-left: 60px;
            margin: -30px 0px 15px -9px;
            font-size: 1.2rem;
        }
        .user_comment{
            display: flex;
        }
        .input_rep-comment{
            min-height: 35px;
            margin: 16px 20px 0;
        }
        .input-comment , .input-reply{
            height: 35px;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .input-comment{
            width: 78%;
            float: left;
        }
        .input-reply{
            width: 20%;
            float: right;
        }
        .input-reply:hover{
            font-size: 100%;
            font-weight: bold;
        }
        .menu_Blog{
            position: absolute;
            left: 110rem;
        }
        .item_menuBlog{
            width: 60px;
            padding: 3px;
            font-size: 1.2rem;
            position: absolute;
            background: #d3d3d380;
            text-align: center;
            left: 12px;
        }
        .item_menuComment{
            position: absolute;
            right: 6px;
            top: 15px;
            background: #d3d3d380;
            text-align: center;
        }
        .item_menuBlog, p {
            margin: 1px 0 ;
        }
        .menu_remove, .menu_remove1{
            border-bottom: 0.5px solid #88888880;
        }
        .menu_edit{
            padding-top: 1px;
        }
        .menu_remove:hover, .menu_edit:hover{
            font-size: 100%;
            font-weight: bold;
            background-color: #ffcc9960;
            padding: 3px;
            color: black;
        }
        .menu_Comment{
            top:15px;
            right: 10px;
        }
        .item_menuComment{
            padding: 0px 8px;
            top: 3px;
            right: 22px;
        }
        .menu_remove1:hover, .menu_edit1:hover{
            padding: 5px 5px;
            background-color: #ffcc9960;
            color: black;
            font-weight: 400;
        }
        .form-onTop{
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
        .form_updateBlog{
            width: 460px;
            text-align: center;
            background: #FFCC9999;
            padding: 25px;
        }
        .form_updateBlog input{
            width: 95%;
            margin: 10px auto;
            padding: 12px 15px;
            background: white;
        }
        .form_updateBlog input:last-child{
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
    <div id='body_info'>
      <section>
        <div class='menu_section_one'>

                  <div class='item_menu_one'>
                      <button><a href="../php/blog_user.php" style="color: black";>Câu hỏi thường gặp</a></button>
                  </div>
                  <div class='item_menu_one'>
                      <button> <a href="../php/blog_user_question.php" style="color: black";>Tất cả các bài viết</a></button>
                  </div>
                  <div class='item_menu_one'>
                      <button><a href="../php/show_blog_user.php" style="color: black";>Bài viết của bạn</a></button>
                  </div>

        </div>
      </section>
    <!-- Aside : Phần nội dung bên phải-->
      <aside>
          <div class="show_all_blogUser">
              <?php
                  $sql_show_blog_user= "SELECT * FROM bloguser, taikhoan WHERE bloguser.ID_taiKhoan = '$ID_userPage' and bloguser.ID_taiKhoan = taikhoan.ID";
                  $result_show_blog_user = $conn -> query($sql_show_blog_user);

                  $y = 1;
                  if ($result_show_blog_user -> num_rows >0) {
                      while ($row_show_blog = $result_show_blog_user -> fetch_assoc()) {
                          $y = $y + 1;
                            echo "<div class='item-show_all_blogUser'>";
                                echo "<div class='item_show_blog'>";
                                    echo "<div class='info-user'>";
                                        echo "<img class = 'img-avatar' src ='../img/img-avatar/{$row_show_blog['avatar']}'>";
                                        echo "<h3>{$row_show_blog['tenTK']}</h3>";
                                        echo "<div class='menu_Blog count_menuBlog_{$y}'>";
                                            echo "<i style='font-size: 1.5rem; position: absolute; padding: 5px; ; margin-top: 7px;' class='fas fa-ellipsis-v'></i>";
                                            echo "<div style='display:none' class='item_menuBlog count_botsblog_{$y}'>";
                                                if(isset($userName) && $userName == $row_show_blog['tenTK']){
                                                    echo "<a href='./Manage User/delete_blogUser.php?id_blogUser={$row_show_blog['ID_blog']}'><p class='menu_remove'>Xóa </p></a>";
                                                    echo "<a href='./show_blog_user.php?id_editBlog={$row_show_blog['ID_blog']}&noiDung={$row_show_blog['noiDung']}'><p class='menu_edit'>Sửa </p></a>";
                                                }
                                                else{
                                                    echo "<a href=''><p class='menu_report'>Báo cáo</p></a>";
                                                }
                                            echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "<p class='time-question'>{$row_show_blog['ngayTao']}</p>";
                                echo "</div>";
                                echo "<div class= 'question'>";
                                    echo "<div class= 'question-answer'>";
                                        echo "<p style = 'font-size: 1.6rem; margin: 20px -5px 0px 0px;'>{$row_show_blog['noiDung']}</p>";
                                    echo "</div>";
                                    echo "<div style = 'display: flex; justify-content: center;'>";
                                        echo "<img class= 'img_blog' src='../img/img_blog_user/{$row_show_blog['hinhAnh']}'>";
                                    echo "</div>";
                                echo"</div>";
                                echo "<div class='interactive'>";
                                    echo "<p style='margin-left: 16px;'>
                                            <span class='icon'style='font-size: 1.4rem; '><i class='far fa-heart'></i></span>
                                            <span class='number'style='font-size: 1.4rem; 'value='{$row_show_blog['tuongTac']}'>{$row_show_blog['tuongTac']}</span>
                                        </p>";
                                echo "</div>";
                                echo "<script>";
                                    echo "document.addEventListener('DOMContentLoaded',function(){";
                                        echo "var countCheck_clickBlog_{$y} = 0;";
                                        echo "document.querySelector('.count_menuBlog_{$y}').onclick = function(){
                                            if(countCheck_clickBlog_{$y} %2 == 0){
                                                document.querySelector('.item_menuBlog.count_botsblog_{$y}').style.display = 'block';
                                            }
                                            else{
                                                document.querySelector('.item_menuBlog.count_botsblog_{$y}').style.display = 'none';
                                            }
                                            countCheck_clickBlog_{$y}+=1;
                                        };";
                                    echo "});";
                                echo "</script>";
                            echo "</div>";
                      }
                  }
                  else{
                      echo "<h1>Không có dữ liệu</h1>";
                  }
                  //UPDATE BLOG
                  if (isset($_GET['id_editBlog'])) {
                      echo "<div class='form-onTop'>";
                          echo "<div class='overlay'></div>";
                          echo "<div class='layout'>";
                              echo "<form method='POST' action = './show_blog_user.php' class='form_updateBlog'>";
                                  echo "<p style='font-size:2.2rem; font-weight:600; text-align:center; margin: 10px 0px;'> Cập nhật bài viết của bạn</p>";
                                  echo "<input type='text' name='ID_blog' style= 'display:none;' value='{$_GET['id_editBlog']}'>";
                                  echo "<input type='text' style='width: 100%; padding: 15px 20px ; border: 1px solid #88888880; margin: 15px 0px; font-size:1.75rem' name='ND_blog' value='{$_GET['noiDung']}'>";
                                  echo "<input type='submit' style='width: 20%; font-weight: 600; background:#888888; border: 1px solid #88888880; cursor: pointer; color: white' name='submit_updateBlog' value='Lưu'>";
                              echo "</form>";
                              echo "<a href='./show_blog_user.php'><i style='font-size: 23px; top: 22px; right: 23px; ' class='fas fa-times icon_close'></i></a>";
                          echo "</div>";
                      echo "</div>";
                  }
                  if (isset($_POST['submit_updateBlog'])) {
                      $ND_blog = $_POST['ND_blog'];
                      $ID_blog = $_POST['ID_blog'];
                      $update_Blog ="UPDATE bloguser SET noiDung = '$ND_blog' WHERE ID_blog='$ID_blog'";
                      $result_updateBlog= $conn->query($update_Blog);
                      if ($result_updateBlog === TRUE) {
                          echo "<script> alert ('Cập nhật thành công'); ";
                          echo "location.href='./show_blog_user.php'; </script>";
                      }
                      else {
                          echo "<script> alert ('Cập nhập lỗi');";
                          echo "location.href='./show_blog_user.php'; </script>";
                      }
                  }
              ?>
          </div>
      </aside>
    </div>
  </div>
  <?php
      if(isset($_POST['submit-reply'])) {
          $ID_taikhoan =$_POST['ID_taikhoan'];
          $ID_blog = $_POST['ID_blog'];
          $noiDung = $_POST['noiDung'];

          $add_reply = "INSERT INTO comment(ID_taikhoan, noiDung, ID_blog) VALUES ('$ID_taikhoan', '$noiDung', '$ID_blog')";
          $result_addReply = $conn->query($add_reply);
          if($result_addReply == TRUE){
              // echo " <script> alert ('Đã gửi bình luận thành công'); </script>";
              echo "<script> location.href = './show_blog_user.php' </script>";
          }
          else{
              echo "<script> alert('no oke'); </script>";
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
