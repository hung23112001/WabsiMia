<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';
    session_start();
    if(isset($_SESSION['user'])){
        $userName =  $_SESSION['user'];
    }
    if(isset($_GET['id_cart'])){
        $id_cart = $_GET['id_cart'];
        
        $sql_infoCart = "SELECT * FROM giohang WHERE ID_gioHang = '$id_cart'";
        $result_infoCart = $conn->query($sql_infoCart);
        if($result_infoCart->num_rows>0){
            $row_infoCart = $result_infoCart->fetch_assoc();
            $id_product = $row_infoCart['ID_SanPham'];
            $id_account = $row_infoCart['ID_TaiKhoan'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Thanh toán sản phẩm</title>
    <style>
        body{
            background-color: #FFEFD5;
        }
        .form_onTop{
            position: fixed;
            inset: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .overlay{
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(255,255,255,0.4);
        } 
        h1{
            margin-top: 5px;
            text-align: center;
        }
        /* form layout */
        .layout{
            position: relative;
            width: 80% ;
            margin: 0 auto;
            background-color: #DEB887;
            border-radius: 15px;
            padding: 0 20px;
            z-index: 2;
            box-shadow: 3px 3px 5px 3px #888888;
        }
        .form_allInfo{
            width: 95%;    
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .title_info{
            font-size: 35px;
            padding-bottom: 20px;
            border-bottom: 1px solid #d3d3d3;
        }
        /*  */
        .form_infoProduct{
            width: 32%;
            padding: 10px 20px ;
        }
        .content_product p{
            font-size: 20px;
            margin: 20px 0 0;
            padding: 10px 0;
            border-bottom: 1px solid black;
        }
        /*  */
        .form_insertInfoBill{
            width: 60%;
            padding: 10px 20px 10px 0;
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        .item_formInsert{
            width: 100%;
            margin: 0 auto 15px;
            display:flex;
            align-items: center;
        }
        .item_formInsert p{
            width: 25%;
            margin: 0 0 0 10px;
            padding-right: 15px;
            font-size: 20px;
            font-weight: bold;
            text-align: end;
        }
        .item_formInsert input,
        .item_formInsert select{
            flex:1;
            padding: 12px 15px;
            font-size: 20px;
            border: 1px solid #888888;
            border-radius: 10px;
        }

        /*  */
        .submit_form{
            display:table;
            margin: 5px auto 20px 40%;
            padding: 10px 18px;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #888888;
        }
        .submit_form:hover{
            cursor: pointer;
            color: white;
            font-weight: bold;
            background-image: linear-gradient(0,#d68f60,#e28744);
        }
        /*  */
        .infoShip{
            width: 60%;
            margin: 0 auto 0 185px;
            font-size: 19px;
        }
        .infoShip table{
            width: 100%;
            text-align: center;
            background-color: #f3c890;
            border-color: white;
            box-shadow: 1px 1px 8px 1px black;
        }
        .infoShip th,
        .infoShip td{
            padding: 4px 6px;
        }
        /*  */
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
    <div class="form_onTop">
        <div class="overlay"></div>
        <div class="layout">
            <form method='post' class='form_buyProduct'>
                <div class="form_allInfo">
                    <?php
                        $sql_allInfo = "SELECT * , sanpham.soLuong as soLuongTon, giohang.soLuong as soLuongMua FROM taikhoan, sanpham, giohang
                                        WHERE (giohang.ID_gioHang = {$id_cart} and giohang.ID_TaiKhoan = taikhoan.ID and giohang.ID_SanPham = sanpham.maSP)";
                        $result_allInfo = $conn->query($sql_allInfo);
                        if($result_allInfo->num_rows>0){
                            $row_allInfo = $result_allInfo->fetch_assoc();
                            ?>
                                <div class="form_infoProduct">
                                    <?php
                                        echo "<h1 class='title_info'>Thông tin sản phẩm</h1>";
                                        echo "<div class='content_product'>";
                                            echo "<p>Tên sản phẩm: <b>{$row_allInfo['tenSP']}</b></p>";
                                            echo "<p>Mệnh: <b>{$row_allInfo['menh']}</b></p>";
                                            echo "<p>Số lượng: <b>{$row_allInfo['soLuongMua']}</b></p>";
                                            echo "<input type='text' style='display:none' name='getNumber_product' value='{$row_allInfo['soLuongTon']}'>";
                                            echo "<input type='text' style='display:none' name='getNumberBuy_product' value='{$row_allInfo['soLuongMua']}'>";
                                            
                                            echo "<p>Loại sản phẩm: <b>{$row_allInfo['loaiSP']}</b></p>";
                                            echo "<p>Loại đá: <b>{$row_allInfo['loaiDa']}</b></p>";
                                            echo "<p>Thành tiền: <b>{$row_allInfo['thanhTien']}</b> VNĐ</p>";
                                        echo "</div>";
                                    ?>
                                </div>
                                <div class="form_insertInfoBill">
                                    <?php
                                        echo "<h1 class='title_info'>Thông tin khách hàng</h1>";
                                        echo "<div class='item_formInsert'>";
                                            echo "<p>Họ và tên: </p>";
                                            echo "<input type='text' required class = 'checkNameUser_bill' name='name_customer' value='{$row_allInfo['tenTK']}'>";
                                        echo "</div>";
                                        echo "<div class='item_formInsert'>";
                                            echo "<p>Số điện thoại: </p>";
                                            echo "<input type='text' required class = 'checkNumberPhoneUser_bill' name='telephone_customer' value='{$row_allInfo['SDT']}'>";
                                        echo "</div>";
                                        echo "<div class='item_formInsert'>";
                                            echo "<p>Địa chỉ nhận: </p>";
                                            echo "<input type='text' required class = 'checkAddressUser_bill' name='address_customer' value='{$row_allInfo['diaChi']}'>";
                                        echo "</div>";
                                        echo "<div class='item_formInsert'>";
                                            $sql_infoship = "SELECT * FROM giaohang";
                                            $result_infoShip = $conn->query($sql_infoship);                                            
                                            if($result_infoShip->num_rows>0){
                                                echo "<p>Vận chuyển: </p>";
                                                echo "<select name='delivery_unit' class='delivery_unit'>";
                                                while($row_infoShip = $result_infoShip->fetch_assoc()){
                                                    echo "<option value='{$row_infoShip['ID_dvi']}-{$row_infoShip['phiGH']}-{$row_infoShip['thoigianGH']}'>{$row_infoShip['tenDvi']}</option>";
                                                }
                                                echo "</select>";
                                            }
                                        echo "</div>";

                                        echo "<input type='text' style='display:none' name='id_account' value='{$row_allInfo['ID_TaiKhoan']}'>";
                                        echo "<input type='text' style='display:none' name='id_product' value='{$row_allInfo['ID_SanPham']}'>";
                                        echo "<input type='text' style='display:none' name='id_cart' value='{$row_allInfo['ID_gioHang']}'>";
                                        echo "<input type='text' style='display:none' class='getMoney' value='{$row_allInfo['thanhTien']}' >";
                                        echo "<input type='text' style='display:none' class='money_bill' name='money_bill' >";

                                        echo "<div class=' infoShip'>";
                                            echo "<table border=1px>";
                                                echo "<tr>
                                                        <th>Thời gian dự kiến</th>
                                                        <td><span class='timeShip'></span></td>
                                                      </tr>";
                                                echo "<tr>
                                                        <th>Phí vận chuyển</th>
                                                        <td><span class='priceShip'></span> VNĐ</td>
                                                    </tr>";
                                                echo "<tr>
                                                        <th>Thành tiền</th>
                                                        <td>{$row_allInfo['thanhTien']} VNĐ</td>
                                                    </tr>";
                                                echo "<tr>
                                                        <th>Tổng tiền:</th>
                                                        <td><span class='allMoney'></span> VNĐ</td>
                                                    </tr>";
                                            echo "</table>";
                                        echo "</div>";
                                    ?>
                                </div>
                            <?php
                        }
                    ?>
                </div>
                <input type="submit" name='submit_order' class='submit_form' value='Đặt hàng'>
            </form>
            <a href='../manage_account.php?id_active=3'><i style='font-size: 2rem' class='fas fa-times icon_close'></i></a>
        </div>
    </div>

    <?php
        if(isset($_POST['submit_order'])){
            $name_customer = $_POST['name_customer'];
            $telephone_customer = $_POST['telephone_customer'];
            $address_customer = $_POST['address_customer'];
            $money_bill = $_POST['money_bill'];

            $dvi_giaoHang = $_POST['delivery_unit'];
            $all_infoShip = explode("-", $dvi_giaoHang);
            $id_ship = $all_infoShip[0];

            $id_account = $_POST['id_account'];
            $id_cart  = $_POST['id_cart'];
            $id_product = $_POST['id_product'];

            $number_current = $_POST['getNumber_product'];
            $number_buy = $_POST['getNumberBuy_product'];
            $numberUpdate_product =  intval($number_current) - intval($number_buy);
           
            $sql_insertBill = "INSERT INTO hoadon (`tenKH`,`SDT`,`diaChi`,`thanhTien`,`ID_TaiKhoan`,`ID_gioHang`,`ID_SanPham`,`ID_dvGiaoHang`) 
                            VALUES ('$name_customer','$telephone_customer','$address_customer','$money_bill','$id_account','$id_cart','$id_product','$id_ship')";
            
            $result_insertBill = $conn->query($sql_insertBill);
            if($result_insertBill == TRUE ){
                $sql_updateCart = "UPDATE giohang SET trangThai = 'Đã thanh toán' WHERE ID_gioHang = '$id_cart'";
                $result_updateCart = $conn->query($sql_updateCart);
                if($result_updateCart == TRUE){
                    $sql_updateProduct = "UPDATE sanpham SET soLuong = '$numberUpdate_product' WHERE maSP = '$id_product'";
                    $result_updateProduct = $conn->query($sql_updateProduct);
                }
                echo "<script> alert('Đặt hàng thành công.'); location.href = '../manage_account.php?id_active=3'; </script>";
            }
            else{
                echo "Error".$conn->error;
            }
        }
    ?>
    <script>

        function checkForm(){
            const checkNameUser_bill = document.querySelector('.checkNameUser_bill');
            const checkNumberPhoneUser_bill = document.querySelector('.checkNumberPhoneUser_bill');
            const checkAddressUser_bill = document.querySelector('.checkAddressUser_bill');
            const btnSubmit_buyProduct = document.querySelector('.submit_form');
            btnSubmit_buyProduct.disabled = 'true';
            checkNameUser_bill.onchange = function(){
                if(checkNameUser_bill.value.length < 6){
                    alert('Vui lòng nhập đầy đủ họ tên');
                }
            }
            checkNumberPhoneUser_bill.onchange = function(){
                if(checkNumberPhoneUser_bill.value.length < 10){
                    alert('Vui lòng nhập đầy đủ số điện thoại');
                }
            }
            checkAddressUser_bill.onchange = function(){
                if(checkAddressUser_bill.value.length < 15){
                    alert('Vui lòng nhập chi tiết địa chỉ');
                }
            }
            if((checkNameUser_bill.value.length >= 6 && checkNumberPhoneUser_bill.value.length >= 10) && checkAddressUser_bill.value.length >= 15){
                btnSubmit_buyProduct.removeAttribute('disabled');
            }
        }
        checkForm();
        document.querySelector('.form_buyProduct').onchange = checkForm;
        
        const delivery_unit = document.querySelector('.delivery_unit');
        const timeShip = document.querySelector('.timeShip');
        const priceShip = document.querySelector('.priceShip');
        const getMoney = document.querySelector('.getMoney');
        const allMoney = document.querySelector('.allMoney');

        function update_infoShip(){
            var info_ship = delivery_unit.value;
            var item_infoShip = info_ship.split('-');
            var sumMoney = parseInt(getMoney.value) + parseInt(item_infoShip[1]);

            priceShip.innerHTML = `${item_infoShip[1]}`;
            timeShip.innerHTML = `${item_infoShip[2]}`;
            allMoney.innerHTML = `${sumMoney}`;
            document.querySelector('.money_bill').value = sumMoney;
        }
        update_infoShip();
        delivery_unit.onchange = update_infoShip;
    </script>
</body>
</html>