<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';

    $id = $_GET['id_blog'];
    $query = "DELETE from blogweb where ID_blog='$id'";
    if(mysqli_query($conn,$query)){
        echo "<script> alert('Xóa blog thành công'); window.location.href='../manage_account.php' </script>";
    }
    else{
        echo "<script> alert('Lỗi xóa blog'); </script>";
    }
?>
