<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="./img/img-all/logo_web.jpg"/>
    <title>Wabsi Mia</title>
    <link rel="stylesheet" href="../css/CSS_allPage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <style>
        .content {
            text-align: center;
        }
        .content-item ul,
        h1,h2{
          text-align: center;
        }
        p{
          line-height: 2.6rem;
        }
        .nav-header{
          margin: 135px auto 20px;
          text-align: center;
        }
        .nav-header img{
          width: 90%;
          height: 90%;
        }
        .nav-header h1{
          font-size: 3rem;
          margin: 50px auto;
        }
        .content-body{
          margin: 30px auto;
        }
        .content-item{
          width: 50%;
          margin: 40px auto;
          border-radius: 25px;
          border: 1px dashed #888888;
          padding: 15px 30px;
        }
        .content-item h2{
          display:table;
          margin:20px auto 30px;
          font-size: 2.5rem;
          padding: 25px 40px;
          border-radius: 8px;
          color:white;
          background-color: #e08849;
          border-bottom: 1px solid #888888;
        }
        .content-item li{
          line-height: 3rem;
          letter-spacing: 1px;
          font-size: 1.8rem;
        }
    </style>
    </style>
</head>
<body>
<!-- header -->
<?php
        require '/xampp/htdocs/Web/WABSI-MIA/connect.php';
      //   session_start();
      //   if(isset($_SESSION['user'])){
      //     $userName =  $_SESSION['user'];
      // }
        require_once "../Main/header.php";
    ?>
<!-- body -->
<div class="container col-12">
    <div class="nav-header col-11">
      <h1>Vận trình các con giáp năm 2021</h1>
      <img src="../img/img-blog/con-giap-2021.jpg" alt="">
    </div>

    <div class="content-body col-11">
      <div class="content-item">
        <h2>Vận trình tuổi TÝ 2021</h2>
          <ul>
            <li>+ Đánh giá vận trình: 6/10 điểm</li>
            <li>Tình cảm: hai thái cực, không hợp sẽ phân</li>
            <li>Sự nghiệp: thích hợp để học tập nâng cao, thận trọng trong công việc</li>
            <li>Tài vận: có thể thử đầu tư nhỏ</li>
            <li>Sức khoẻ: tinh thần dễ áp lực, cần chú ý nghĩ ngơi hợp lý.</li>
          </ul>
      </div>
      <div class="content-item">
        <h2>Vận trình tuổi SỬU 2021</h2>
          <ul>
            <li>Đánh giá vận trình: 6/10 điểm (năm bổn mệnh, phạm Thái Tuế)</li>
            <li>Tình cảm: Hơi kém, tạo hỷ sự để hoá giải</li>
            <li>Sự nghiệp: thăng trầm, nên đề phòng thị phi</li>
            <li>Tài vận: nhiều biến động, không nên đầu tư</li>
            <li>Sức khoẻ: dễ bị thương, nên tham gia hoạt động lành mạnh</li>
          </ul>
      </div>
      <div class="content-item">
        <h2>Vận trình tuổi Dần 2021</h2>
          <ul>
            <li>Đánh giá vận trình: 10/10 điểm</li>
            <li>Tình cảm: Đào hoa đang vượng, dễ thoát cảnh đơn thân</li>
            <li>Sự nghiệp: Quý nhân giúp đỡ, nhiều cơ hội thăng tiến</li>
            <li>Tài vận: trong biến động có được tiền, thích hợp phát triển những thị trường xa hơn</li>
            <li>Sức khoẻ: chú ý ăn uống, cân bằng giữa công việc và nghỉ ngơi</li>
          </ul>
      </div>
      <div class="content-item">
        <h2>Vận trình tuổi MẸO 2021</h2>
          <ul>
            <li>Đánh giá vận trình: 6/10 điểm</li>
            <li>Tình cảm: ổn định, không có nhiều sóng gió</li>
            <li>Sự nghiệp: không tốt không xấu</li>
            <li>Tài vận: bình thường, không nên ham mê đầu cơ</li>
            <li>Sức khoẻ: áp lực tinh thần lớn, lưu tâm sức khoẻ người già trong gia đình</li>
          </ul>
      </div>
      <div class="content-item">
        <h2>Vận trình tuổi THÌN 2021</h2>
          <ul>
            <li>Đánh giá vận trình: 6/10 điểm (phạm Thái Tuế)</li>
            <li>Tình cảm: đào hoa đang vượng, dễ xảy ra tình chị em</li>
            <li>Sự nghiệp: thăng tiến, đề phòng thị phi</li>
            <li>Tài vận: nhiều tranh cãi, tránh vay mượn hay bảo lãnh</li>
            <li>Sức khoẻ: cơ thể dễ bị thương</li>
          </ul>
      </div>
      <div class="content-item">
        <h2>Vận trình tuổi TỴ 2021</h2>
          <ul>
            <li>Đánh giá vận trình: 8/10 điểm</li>
            <li>Tình cảm: khá lạnh nhạt, nên bắt chuyện với đối phương nhiều hơn</li>
            <li>Sự nghiệp: vô cùng thăng tiến, đề phòng tiểu nhân</li>
            <li>Tài vận: chính tài rất vượng, đề phòng quan phi (kiện cáo, giấy tờ sai sót)</li>
            <li>Sức khoẻ: có một chút áp lực, nên tiếp thu các năng lượng tích cực</li>
          </ul>
      </div>
    </div>
</div>
        <!-- footer -->
<?php
        require_once "../Main/footer.php";
        require_once "../Main/form.php";
    ?>
</body>
</html>
