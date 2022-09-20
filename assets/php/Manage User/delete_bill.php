<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';

    $ID = $_GET['id'];
    $sql_deleteBill = "DELETE FROM hoadon WHERE maHD = '$ID'";

    if($conn->query($sql_deleteBill) == TRUE) {
        echo "<script> alert('Xóa hóa đơn thành công'); 
                location.href='../manage_account.php?id_active=2'
            </script>";
    }
?>