<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Cập nhật sản phẩm</title>
    <style>
        body{
            background-color: #FFEFD5;
        }
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

        h1{
            margin: 5px auto 10px;
            text-align: center;
        }
        /* form layout */
        .layout{
            position: relative;
            width: 50% ;
            background-color: #DEB887;
            border-radius: 15px;
            padding: 10px 30px;
            z-index: 2;
            box-shadow: 3px 3px 5px 3px #888888;
        }
        .formUpdate{
            display: flex;
            align-items: center;
            flex-direction: column;
        }   
        .item_formUpdate{
            width: 100%;
            margin: 0 auto 10px;
            display: flex;
            justify-content: space;
            align-items: center;
        }
        .item_formUpdate p{
            width: 230px;
            text-align: center;
            font-size: 18px;
        }
        .item_formUpdate input,
        .item_formUpdate select{
            flex:1;
            padding: 12px 15px;
            border: 1px solid #d3d3d3;
            border-radius: 10px;
            font-size: 15px;
        }
        .btn_submitUpdate{
            padding: 10px 16px;
            border: 1px solid #d3d3d3;
            border-radius: 10px;
            font-size: 17px;
        }
        .btn_submitUpdate:hover{
            background-image: linear-gradient(0,#d68f60,#e28744);
            color:white;
        }
        .icon_close{
            position: absolute;
            top:8px;
            cursor: pointer;
            right: 12px;
            color: black;
            z-index: 5;
        }
        .icon_close:hover{
            top:4px;
            right: 4px;
            color: white;
            background-color: var(--color-main);
            padding: 3px 7px;
            border-radius:50%;
        }
    </style>
</head>
<body>
    <?php
        require "/xampp/htdocs/Web/WABSI-MIA/connect.php";

        $id_product = $_GET['id'];
        $getInfo_product = "SELECT * FROM sanpham WHERE maSP = '$id_product'";
        $reuslt_infoProduct = $conn->query($getInfo_product);
        if($reuslt_infoProduct->num_rows>0){
            $row_infoProduct = $reuslt_infoProduct->fetch_assoc();
    ?>
        <div class="form_onTop">
            <div class="overlay"></div>
            <div class="layout">
                <h1>Cập nhật sản phẩm có id <?php echo $row_infoProduct['maSP']; ?></h1>
                <form action="" class='formUpdate' method='post'>
                    <div class="item_formUpdate">
                        <p>Cập nhật tên sản phẩm</p>
                        <input required type="text" name='nameProduct_news' value='<?php echo $row_infoProduct['tenSP']; ?>'>
                    </div>
                    <div class="item_formUpdate">
                        <p>Cập nhật giá sản phẩm</p>
                        <input required type="number" name='priceProduct_news' min='1000' value='<?php echo $row_infoProduct['gia']; ?>'>
                    </div>
                    <div class="item_formUpdate">
                        <p>Cập nhật số lượng sản phẩm</p>
                        <input required type="number" name='numberProduct_news' min='1' value='<?php echo $row_infoProduct['soLuong']; ?>'>
                    </div>
                    <div class="item_formUpdate">
                        <p>Cập nhật loại sản phẩm </p>
                        <input required type="text" name='typeProduct_news' value='<?php echo $row_infoProduct['loaiSP']; ?>'>
                    </div>
                    <div class="item_formUpdate">
                        <p>Cập nhật loại đá</p>
                        <input required type="text" name='typeSoneProduct_news' value='<?php echo $row_infoProduct['loaiDa']; ?>'>
                    </div>
                    <div class="item_formUpdate">
                        <p>Cập nhật mệnh</p>
                        <input required type="text" name='destinyProduct_news' value='<?php echo $row_infoProduct['menh']; ?>'>
                    </div>
                    <div class="item_formUpdate">
                        <p>Cập nhật ảnh sản phẩm</p>
                        <input style='background-color:white' required type="file" name='imgProduct_news' value='<?php echo $row_infoProduct['anhSP']; ?>'>
                    </div>
                    <input type="submit" class='btn_submitUpdate' name='submit_updateProduct' value='Cập nhật'>
                </form>
                <a href='../manage_account.php?id_active=3'><i style='font-size: 25px' class='fas fa-times icon_close'></i></a>
            </div>
        </div>

    <?php
        }
        if(isset($_POST['submit_updateProduct'])){
            $nameProduct_news = $_POST['nameProduct_news'];
            $priceProduct_news = $_POST['priceProduct_news'];
            $typeProduct_news = $_POST['typeProduct_news'];
            $numberProduct_news = $_POST['numberProduct_news'];
            $typeSoneProduct_news = $_POST['typeSoneProduct_news'];
            $destinyProduct_news = $_POST['destinyProduct_news'];
            $imgProduct_news = $_POST['imgProduct_news'];

            if($imgProduct_news == ""){
                echo "<script> alert('Vui lòng chọn lại ảnh sản phẩm'); window.location.href='../manage_account.php'; </script>";
            }
            else{
                $update_product = "UPDATE `sanpham` 
                                    SET `tenSP` = '$nameProduct_news', `gia` = '$priceProduct_news',`soLuong` = '$numberProduct_news', `loaiSP` = '$typeProduct_news',`loaiDa` = '$typeSoneProduct_news',`menh` = '$destinyProduct_news', `anhSP` = '$imgProduct_news'
                                    WHERE `maSP` ='$id_product' ";
                $result_update = $conn->query($update_product);
                if($result_update == TRUE){
                    echo "<script> alert('Cập nhật sản phẩm thành công'); 
                    window.location.href='../manage_account.php?id_active=3'; </script>";
                }
                else{
                    echo "<script> alert('Lỗi cập nhật. Vui lòng thử lại!!'); </script>";
                }
            }
        }
    ?>

</body>
</html>