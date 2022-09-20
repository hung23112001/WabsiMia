<?php
    require "/xampp/htdocs/Web/WABSI-MIA/connect.php";

    $ID = $_GET['id'];
    $id_user = $_GET['id_user'];
    $sql_delete = "DELETE FROM bosuutap WHERE ID_SanPham = '$ID' and ID_TaiKhoan = '$id_user'";
    $result_delete = $conn->query($sql_delete);
    if($result_delete == TRUE) {
        echo "<script>alert(`Xóa thành công`);
              window.location.href='../manage_account.php?id_active=4';</script>";
    }
    else {
        echo "<script> alert(` Lỗi khi xóa. Vui lòng thử lại `);</script>";
    }
?>
