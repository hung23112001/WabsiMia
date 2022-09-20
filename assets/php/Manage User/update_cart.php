<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';

    if(isset($_POST['submitForm_updateAccount'])){
        $ID = $_POST['ID_gioHang'];
        $soLuong = $_POST['numberCart_news'];
        $thanhTien = $_POST['resultPrice_news'];
    
        $sql_update = "UPDATE giohang SET soLuong = '$soLuong', thanhTien = '$thanhTien' WHERE ID_gioHang = '$ID'";
        $result_update = $conn->query($sql_update);
        if($result_update == TRUE) {
            echo "<script> alert('Cập nhật giỏ hàng thành công'); location.href='../manage_account.php?id_active=2'; </script>";
        }
        else {
            echo "Vui lòng thử lại sau";
        }
    }
?>