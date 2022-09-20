<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';

    $ID = $_GET['id'];
    $sql_deleteCart = "DELETE FROM giohang WHERE ID_gioHang = '$ID'";
    $sql_deleteBill = "DELETE FROM hoadon WHERE ID_gioHang = '$ID'";

    if($conn->query($sql_deleteBill) == TRUE) {
        if($conn->query($sql_deleteCart) == TRUE){
            echo "<script> alert('Xóa giỏ hàng thành công'); 
                    location.href='../manage_account.php?id_active=2'
                </script>";
        }
    }
?>