<?php
          require "/xampp/htdocs/Web/WABSI-MIA/connect.php";

    $ID = $_GET['id'];

    $sql_deleteBill = "DELETE FROM hoadon WHERE ID_dvGiaoHang = '$ID'";
    $sql_deleteTransport = "DELETE FROM giaohang WHERE ID_dvi = '$ID'";

    $sql_allCart = "SELECT ID_gioHang FROM hoadon WHERE ID_dvGiaoHang = '$ID'";
    $result_Cart = $conn->query($sql_allCart);
    $arr_allID = array();
    if($result_Cart->num_rows > 0) {
        while($row = $result_Cart->fetch_assoc()) {
            $arr_allID[] = $row['ID_gioHang'];
        }
    }
    if($conn->query($sql_deleteBill) == TRUE) {
        for($i = 0 ; $i < sizeof($arr_allID); $i++){
            $ID_deleteCart = ($arr_allID[$i]);
            $sql_deleteCart = "DELETE FROM giohang WHERE ID_gioHang = '$ID_deleteCart' ";
            $result_deleteCart = $conn->query($sql_deleteCart);
        }
    }
    if($conn->query($sql_deleteTransport) == TRUE) {
        echo "<script>alert(`Xóa đơn vị vận chuyển thành công`);
              window.location.href='../manage_account.php?id_active=5';</script>";
    }
    else {
        echo "<script> alert(` Lỗi khi xóa. Vui lòng thử lại `);</script>";
    }

?>
