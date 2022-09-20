<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cập nhật đơn vị vận chuyển</title>
  </head>
  <style>
      body {
          background-color: #ffeaa7;
      }
      h1 {
          margin: 0 auto 20px;
      }
      .layout {
          width: 35%;
          background-color: #eee;
          border-radius: 15px;
          padding: 30px 20px;
          margin: 100px auto 0;
          box-shadow: 1px 1px 4px 2px #888888;
      }
      .form_update{
          display: flex;
          align-items: center;
          flex-direction: column;
      }
      .item-formUpdate{
          width: 100%;
          margin: 0 23px 8px 0;
          display: flex;
          align-items: center;
      }
      .item-formUpdate p{
          width: 250px;
          text-align: center;
          font-size: 20px;
      }
      .item-formUpdate input,
      .btn_submitUpdate{
          padding: 12px 15px;
          border: 1px solid #d3d3d3;
          border-radius: 10px;
          font-size: 17px;
      }
      .btn_submitUpdate{
          padding: 12px 20px;
          border: 0.5px solid #555;
      }
      .btn_submitUpdate:hover{
          background-image: linear-gradient(0,#d68f60,#e28744);
          color: white;
          box-shadow: 1px 1px 4px 2px #888888;
      }
  </style>
  <body>
      <?php
          require "/xampp/htdocs/Web/WABSI-MIA/connect.php";

          $ID = $_GET['id'];
          $sql_infoTransport = "SELECT * FROM giaohang WHERE ID_dvi = '$ID'";
          $result_infoTransport = $conn->query($sql_infoTransport);
          if($result_infoTransport->num_rows > 0) {
              $row_info = $result_infoTransport->fetch_assoc();

              echo "<div class='layout'>";
                  echo "<h1 style='font-size:1.8rem'><center>Cập nhật đơn vị vận chuyển</h1>";
                  echo "<form class='form_update' method='post'>";
                      echo "<div class='item-formUpdate'><p>Tên đơn vị vận chuyển </p>
                            <input type='text' name='nameTransport_news' value='{$row_info['tenDvi']}'></div>";
                      echo "<div class='item-formUpdate'><p>Phí vận chuyển </p>
                            <input type='text' name='priceTransport_news' value='{$row_info['phiGH']}'></div>";
                      echo "<div class='item-formUpdate'><p>Thời gian vận chuyển </p>
                            <input type='text' name='timeTransport_news' value='{$row_info['thoigianGH']}'></div>";
                      echo "<input type='submit' class='btn_submitUpdate' name='submit_update' value='Cập nhật'>";
                  echo "</form>";
              echo "</div>";
          }

          if(isset($_POST['submit_update'])) {
              $nameTransport_news = $_POST['nameTransport_news'];
              $priceTransport_news = $_POST['priceTransport_news'];
              $timeTransport_news = $_POST['timeTransport_news'];

              $update_transport = "UPDATE giaohang SET tenDvi = '$nameTransport_news', phiGH = '$priceTransport_news', thoigianGH = '$timeTransport_news'
                                    WHERE ID_dvi = '$ID'";
              $result_updateTransport = $conn->query($update_transport);
              if($result_updateTransport == TRUE) {
                  echo "<script>alert(` Cập nhật thành công `);
                        window.location.href='../manage_account.php?id_active=5';</script>";
              }
              else {
                  echo "<script>alert(` Lỗi khi cập nhật, hãy thử lại `);</script>";
              }
          }
       ?>
  </body>
</html>
