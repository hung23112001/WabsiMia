<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../img/img-all/logo_web.jpg"/>
    <title>Wabsi Mia</title>
    <link rel ='stylesheet' href="../css/CSS_allPage.css">
    <link rel="stylesheet" href="../CSS/CSS_contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <style>
      
    </style>
</head>
<body>
    <?php
        require_once "../Main/header.php";
    ?>

    <div id="container" class="col-12">
        <div class="map col-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.01733636119!2d105.7717246141582!3d21.07196979167943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134552defbed8e9%3A0x1584f79c805eb017!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBN4buPIC0gxJDhu4thIGNo4bqldA!5e0!3m2!1svi!2s!4v1634201549543!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="contact col-12">
          <div class="row col-12">
            <div class="contact-address col-6">
              <div class="section-title">
                <h5>THÔNG TIN</h5>
                <h1>Liên hệ</h1>
                <p>Đến Wabsi_Mia store để được tư vấn và xem sản phẩm trực tiếp</p>
              </div>
              <div class="address">
                <h4>Wabsi_Mia</h4>
                <li class='li_item-contact'><i class="fa fa-map-marker" aria-hidden="true"></i> Số 18, Phố Viên, P. Đức Thắng, Q. Bắc Từ Liêm, TP. Hà Nội</li>
                <li class='li_item-contact'><i class="fa fa-map-marker" aria-hidden="true"></i> Số 258, Nhuệ Giang, Tân Hội, H. Đan Phượng, TP. Hà Nội</li>
                <li class='li_item-contact'><i class="fa fa-phone-square" aria-hidden="true"></i> 0964444989</li>
                <li class='li_item-contact'><i class="fa fa-envelope-open" aria-hidden="true"></i> wabsimiastore@gmail.com</li>
              </div>
            </div>
            <div class="contact-form col-6">
              <div class="contact-input">
                <div class="item-ip col-6">
                  <input type="text" name="name" placeholder="Name">
                </div>
                <div class="item-ip col-6 ip-mail">
                  <input type="text" name="email" placeholder="Email">
                </div>
              </div>
              <div class="feedback">
                <textarea name="contact-message" rows="10" cols="40" placeholder="Message"></textarea>
              </div>
              <!-- <div class="send"> -->
                <input class="send-mess" type="submit" value="SEND MESSAGE">
              <!-- </div> -->
            </div>
          </div>
        </div>
    </div>

    <?php
        require_once "../Main/footer.php";
        require_once "../Main/form.php";
    ?>
</body>
</html>
