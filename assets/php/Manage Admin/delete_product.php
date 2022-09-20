<?php
    require "/xampp/htdocs/Web/WABSI-MIA/connect.php";

    $id_product = $_GET['id'];
    $delete_product = "DELETE FROM sanpham WHERE maSP ='$id_product'";
    $delete_cart = "DELETE FROM giohang WHERE ID_SanPham = '$id_product' ";
    $delete_bill = "DELETE FROM hoadon WHERE ID_SanPham = '$id_product' ";
    $delete_collect = "DELETE FROM bosuutap WHERE ID_SanPham = '$id_product'";
    $delete_feedback = "DELETE FROM phanhoi WHERE ID_SanPham = '$id_product'";

    $result_deleteBill = $conn->query($delete_bill);

    if($result_deleteBill === TRUE){
        $result_deleteCart = $conn->query($delete_cart);
        if($result_deleteCart === TRUE){
            $result_deleteCollect = $conn->query($delete_collect);
            if($result_deleteCollect === TRUE) {
                $result_feedback = $conn->query($delete_feedback);
                if($result_feedback === TRUE) {
                    $result_deleteProduct = $conn->query($delete_product);
                    if($result_deleteProduct === TRUE){
                        echo "<script> alert('Xóa sản phẩm thành công');
                        window.location.href='../manage_account.php'; </script>";
                    }
                }
            }
        }
    }
    else{
        echo "Cannot delete product here. Please try agian";
    }
?>
