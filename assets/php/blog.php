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
    <script src="../js/jquery-3.6.0.min.js"></script>
    <style>
        #container{
            padding: 45px 0;
        }
        .all_blog{
            margin: 50px auto 20px;
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }
        .blog-item{
            padding: 20px 0;
            width: 30%;
        }
        .item-link,
        .item-link img{
            width: 100%;
        }
        .item-text p{
            width: 90%;
            margin: 10px auto;
            padding: 20px 0;
            background-color: #dd8a50;
            font-size: 1.8rem;
            color: white;
        }
    </style>
</head>
<body>
<!-- header -->
    <?php
        require_once "../Main/header.php";
    ?>
<!-- body -->
  <div id="container" class="col-12">
    <?php
        $sql = "SELECT * FROM blogweb";
        $result_show = $conn -> query($sql);

        if ($result_show -> num_rows >0) {
            echo "<div class='all_blog col-11'>";
                while ($row = $result_show -> fetch_assoc()) {
                    echo "<div class='blog-item'>";
                        echo "<div class='item-link'>";
                            echo "<a href='{$row['linkBlog']}.php'>
                              <img src ='../img/img-blog/{$row['linkAnh']}'></a>";
                        echo "</div>";
                        echo "<div class='item-text'>";
                            echo "<a href='{$row['linkBlog']}.php'><p style='text-align:center'>{$row['tieuDe']}</p></a>";
                        echo "</div>";
                    echo "</div>";
                }
            echo "</div>";
        }
        else{
            echo "<h1>Không có dữ liệu</h1>";
        }
    ?>
  </div>
<!-- footer -->
    <?php
        require_once "../Main/footer.php";
        require_once "../Main/form.php";
    ?>
</body>
</html>
