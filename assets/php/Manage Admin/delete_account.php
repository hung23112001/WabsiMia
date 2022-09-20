<?php
    require "/xampp/htdocs/Web/WABSI-MIA/connect.php";

    $id_account = $_GET['id'];


     $delete_bill = "DELETE FROM hoadon WHERE ID_TaiKhoan = '$id_account'";
    $delete_cart = "DELETE FROM giohang WHERE ID_TaiKhoan = '$id_account'"; 
    $delete_feedback = "DELETE FROM phanhoi WHERE ID_TaiKhoan = '$id_account'";
    $delete_collect = "DELETE FROM bosuutap WHERE ID_TaiKhoan = '$id_account'";

    
    if($conn->query($delete_bill) == TRUE){
        $conn->query($delete_cart);
    }
    $conn->query($delete_feedback);
    $conn->query($delete_collect);

    $sqlDelete_allIDBlog = "SELECT ID_Blog FROM bloguser WHERE ID_taiKhoan = '$id_account'";
    $result_delete_allIDBlog = $conn->query($sqlDelete_allIDBlog);
    $arrDelete_idBlog_tblInteractive = array();
    if($result_delete_allIDBlog->num_rows > 0) {
        while($row = $result_delete_allIDBlog->fetch_assoc()) {
            $arrDelete_idBlog_tblInteractive[] = $row['ID_Blog'];
        }
    }

    // xóa tương tác & bình luận
    for($i = 0 ; $i < sizeof($arrDelete_idBlog_tblInteractive); $i++){
        $sqlDelete_IDInteractive = "DELETE FROM tuongtac WHERE ID_Blog = '$arrDelete_idBlog_tblInteractive[$i]' ";
        $result_deleteInteractive = $conn->query($sqlDelete_IDInteractive);
        $sqlDelete_IDComment = "DELETE FROM comment WHERE ID_Blog = '$arrDelete_idBlog_tblInteractive[$i]' ";
        $result_deleteComment = $conn->query($sqlDelete_IDComment);
    }

    // cập nhật blog || xóa tương tác
    $sqlAll_interactiveUser = "SELECT * FROM tuongtac WHERE ID_TaiKhoan = '$id_account'";
    $result_All_interactiveUser = $conn->query($sqlAll_interactiveUser);
    if($result_All_interactiveUser->num_rows > 0) {
        while($row_updateDelete_blogInter = $result_All_interactiveUser->fetch_assoc()){                        
            if($row_updateDelete_blogInter['trangThai'] == "yes"){
                $ID_blogCurrent = $row_updateDelete_blogInter['ID_BLog'];                
                $updateInter_blogUser = $conn->query("SELECT * FROM bloguser WHERE ID_blog = '$ID_blogCurrent'");
                if($updateInter_blogUser ->num_rows>0){
                    $row_blogUpdate = $updateInter_blogUser->fetch_assoc();
                    $inter_current = intval($row_blogUpdate['tuongTac']);
                    $inter_news = $inter_current - 1 ;
                    $sqlUpdate_blog = $conn->query("UPDATE bloguser SET tuongTac = '$inter_news' WHERE ID_blog = '$ID_blogCurrent'");
                    if($sqlUpdate_blog == TRUE){
                        $delete_interactive = "DELETE FROM tuongtac WHERE ID_TaiKhoan = '$id_account'";
                        $conn->query($delete_interactive);
                    }
                }
            }
            else if($row_updateDelete_blogInter['trangThai'] == "no"){
                $delete_interactive = "DELETE FROM tuongtac WHERE ID_TaiKhoan = '$id_account'";
                $conn->query($delete_interactive);
            }
        }
    }

    // xóa bình luận
    $sqlDelete_IDCommentAcc = "DELETE FROM comment WHERE ID_taiKhoan = '$id_account' ";        
    $result_deleteCommentAcc = $conn->query($sqlDelete_IDCommentAcc);

    // xóa blog
    $delete_bloguser = "DELETE FROM bloguser WHERE ID_taiKhoan = '$id_account'";
    $conn->query($delete_bloguser);


    $delete_account = "DELETE FROM taikhoan WHERE ID ='$id_account'";
    if($conn->query($delete_account)){
        echo "<script> alert('Xóa tài khoản thành công');
                location.href = '../manage_account.php';
        </script>";
    }
  
?>
