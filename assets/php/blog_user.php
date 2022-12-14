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
        <!-- Section : Ph???n n???i dung b??n tr??i -->
    <div id='body_info'>
      <section>
        <div class='menu_section_one'>
            <div class='item_menu_one'>
                <button><a href="../php/blog_user.php" style="color: black";>C??u h???i th?????ng g???p</a></button>
            </div>
            <div class='item_menu_one'>
                <button> <a href="../php/blog_user_question.php" style="color: black";>T???t c??? c??c b??i vi???t</a></button>
            </div>
            <div class='item_menu_one'>
                <button><a href="../php/show_blog_user.php" style="color: black";>B??i vi???t c???a b???n</a></button>
            </div>
        </div>
    </section>
    <!-- Aside : Ph???n n???i dung b??n ph???i-->
    <aside>
      <div class="all-question">
        <div class="item-question">
            <div class="question-and-answer">
                <h3 style="text-align:center; padding: 0 8px; font-size: 2rem">T??i c?? th??? mua h??ng m?? kh??ng c???n t???o t??i kho???n tr??n website kh??ng? </h3>
                <p style="text-align: justify; letter-spacing: 1.5px;"> Qu?? kh??ch t???o ????n h??ng tr???c ti???p tr??n website l???a ch???n h??nh th???c ?????t h??ng ngay kh??ng t???o t??i kho???n. V?? khi t???o t??i kho???n s??? gi??p qu?? kh??ch t??ch ??i???m v?? nh???n ch????ng tr??nh khuy???n m??i ?????nh k??? ?????n t??? Mia.  </p>
            </div>
        </div>
        <div class="item-question">
            <div class="question-and-answer">
                <h3 style="text-align:center; padding: 0 8px; font-size: 2rem">T??i ???? t???o ????n h??ng tr??n website nh??ng sau ???? kh??ng mu???n ?????t h??ng n???a th?? ph???i l??m sao ????? h???y ????n h??ng? </h3>
                <p style="text-align: justify; letter-spacing: 1.5px;">????? h???y ????n h??ng, Qu?? kh??ch h??ng vui l??ng li??n h??? hotline 0123.456.789 tr?????c 18h h??ng ng??y ????? ???????c h??? tr??? tr???c ti???p.
                  Tr?????ng h???p ?????i s???n ph???m, Qu?? kh??ch h??ng vui l??ng g???i s???n ph???m cho Mia trong v??ng 03 ng??y l??m vi???c; trong ??i???u ki???n s???n ph???m ???????c gi??? nguy??n h???p, tag v?? ch??a qua s??? d???ng.  </p>
            </div>
        </div>
        <div class="item-question">
            <div class="question-and-answer">
                <h3 style="text-align:center; padding: 0 8px; font-size: 2rem">Sau th???i gian bao l??u k??? t??? khi ?????t h??ng th?? t??i c?? th??? nh???n ???????c h??ng? </h3>
                <p style="text-align: justify; letter-spacing: 1.5px;">Mia mi???n ph?? giao h??ng to??n qu???c. Khi ph??t sinh ????n h??ng Mia s??? x??? l?? trong v??ng 1h v?? g???i chuy???n ph??t nhanh th???i gian t??? 2 ??? 5 ng??y l?? qu?? kh??ch nh???n ???????c s???n ph???m.  </p>
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
