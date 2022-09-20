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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel ='stylesheet' href="../css/CSS_allPage.css">
    <link rel ='stylesheet' href="../css/CSS_blog_user.css">
    <style media="screen">
        #navigation{
            padding: 40px 0 0 0;
        }
        #body_info{
            min-height:100px;
            display: flex;
        }
        section{
            background-color: whitesmoke;
            width: 25%;
        }
        .menu_section_one{
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-direction: column;
        }
        .item_menu_one{
            width: 90%;
            margin: 10px 0;
            padding: 14px 20px 10px;
            border-bottom: 1px solid #88888888;
        }
        .item_menu_one button{
            border: none;
            outline: none;
            background-color: transparent;
            padding: 8px 12px;
            font-size: 2rem;
        }
        aside{
            width: 75%;
            background-color: #FFCC9999;
            margin-left: 0px;
        }
        section{
            width: 25%;
            left: 0;
            top: 70px;
        }
        .all-question{
            font-size: 150%;
            line-height: 30px;
            letter-spacing: 2px;
        }
        .item-question{
            background: white;
            border-radius: 10px;
            padding: 10px 45px 25px;
            width: 75%;
            min-height: 100px;
            margin: 20px auto;
        }
        .question-and-answer{
            margin-top: 5px;
            padding-left: 25px;
            width: 100%;
            min-height: 30px;
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
      <div class="all-question">
        <div class="item-question">
            <div class="question-and-answer">
                <h3 style="text-align:center; padding: 0 8px; font-size: 2rem">Tôi có thể mua hàng mà không cần tạo tài khoản trên website không? </h3>
                <p style="text-align: justify; letter-spacing: 1.5px;"> Quý khách tạo đơn hàng trực tiếp trên website lựa chọn hình thức đặt hàng ngay không tạo tài khoản. Và khi tạo tài khoản sẽ giúp quý khách tích điểm và nhận chương trình khuyến mãi định kỳ đến từ Mia.  </p>
            </div>
        </div>
        <div class="item-question">
            <div class="question-and-answer">
                <h3 style="text-align:center; padding: 0 8px; font-size: 2rem">Tôi đã tạo đơn hàng trên website nhưng sau đó không muốn đặt hàng nữa thì phải làm sao để hủy đơn hàng? </h3>
                <p style="text-align: justify; letter-spacing: 1.5px;">Để hủy đơn hàng, Quý khách hàng vui lòng liên hệ hotline 0123.456.789 trước 18h hàng ngày để được hỗ trợ trực tiếp.
                  Trường hợp đổi sản phẩm, Quý khách hàng vui lòng gửi sản phẩm cho Mia trong vòng 03 ngày làm việc; trong điều kiện sản phẩm được giữ nguyên hộp, tag và chưa qua sử dụng.  </p>
            </div>
        </div>
        <div class="item-question">
            <div class="question-and-answer">
                <h3 style="text-align:center; padding: 0 8px; font-size: 2rem">Sau thời gian bao lâu kể từ khi đặt hàng thì tôi có thể nhận được hàng? </h3>
                <p style="text-align: justify; letter-spacing: 1.5px;">Mia miễn phí giao hàng toàn quốc. Khi phát sinh đơn hàng Mia sẽ xử lý trong vòng 1h và gửi chuyển phát nhanh thời gian từ 2 – 5 ngày là quý khách nhận được sản phẩm.  </p>
            </div>
        </div>
      </div>





    </aside>
  </div>
</div>

<!-- footer -->
    <?php
        require_once "../Main/footer.php";
        require_once "../Main/form.php";
    ?>
</body>
</html>
