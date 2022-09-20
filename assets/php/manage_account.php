<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';
    session_start();
    if(isset($_SESSION['user'])){
        $userName =  $_SESSION['user'];
        $sql_getInfoPage = "SELECT * FROM taikhoan WHERE tenTK = '$userName'";
        $result_getInfoPage = $conn->query($sql_getInfoPage);
        if($result_getInfoPage->num_rows>0){
            $row_getInfoPage = $result_getInfoPage->fetch_assoc();
            $pass_userPage = $row_getInfoPage['matKhau'];
            $ID_userPage = $row_getInfoPage['ID'];
            echo "<script>var passUser = '{$pass_userPage}';</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/png" href="../img/img-all/logo_web.jpg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ='stylesheet' href="../css/CSS_allPage.css">
    <link rel="stylesheet" href="../css/manage_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/manage_js.js"></script>
    <title>Information</title>
    <style>
       .name_collect{
            width: 90%;
            margin: 20px auto 0;
            font-size: 1.85rem;
            color: white;
            background: #dd8b52;
            padding: 10px;
            border-radius: 5px;
       }
       .numberPage{
            width: 60%;
            margin: 10px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .item_numberPage{
            margin-right: 20px;
            background-color: orange;
            color:white;
            padding: 8px 15px;
            border: 1px solid #d68f60;
            border-radius: 6px;
            font-size: 1.8rem;
        }
        .item_numberPage.active_numberPage{
            color: black;
            background-color: white;
            border-color: orange;
        }

        .infoProduct-content p {
            line-height: 2.8rem;
        }
    </style>
</head>
<body>

    <script>
        document.addEventListener('DOMContentLoaded',function(){
            const sections = document.querySelectorAll('.item_section');
            const asides = document.querySelectorAll('.item_aside');
            sections.forEach((item,index) => {
                const aside_item = asides[index];
                item.onclick = function(){
                    document.querySelector('.item_aside.menu-active').classList.remove('menu-active');
                    document.querySelector('.item_section.menu-active').classList.remove('menu-active');

                    this.classList.add('menu-active');
                    aside_item.classList.add('menu-active');
                }
            });
            <?php
                if(isset($_GET['id_active'])){
                    $id_active = $_GET['id_active'];
                    echo "document.querySelector('.item_aside.menu-active').classList.remove('menu-active');";
                    echo "document.querySelector('.item_section.menu-active').classList.remove('menu-active');";

                    echo "const aside_item = asides[{$id_active}];";
                    echo "const section_item = sections[{$id_active}];";

                    echo "section_item.classList.add('menu-active');";
                    echo "aside_item.classList.add('menu-active');";
                }
            ?>
        });
    </script>
    <?php
        if(isset($userName) && $userName == "Admin"){
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    var formSearch = document.querySelector('#formSearch');
                    var inputSearch = document.querySelector('#inputSearch_blogWeb');
                    formSearch.onsubmit = function (e) {
                        if(inputSearch.value.length === 0){
                            alert('Bạn hãy nhập gì đó rồi mới tìm kiếm ');
                            e.preventDefault();
                        }
                    }
                });
            </script>
            <?php
        }
    ?>
    
    <div id='body_info'>
        <section>
            <div class='menu_section'>
                <div class='item_menu item_section menu-active'>
                    <i class='fas fa-user'></i>
                    <button>Thông tin tài khoản</button>
                </div>
                <div class='item_menu item_section'>
                    <i class='fas fa-shield-alt'></i>
                    <button>Bảo mật</button>
                </div>
                <?php
                    if(isset($userName) && $userName == "Admin"){
                        echo "<div class='item_menu item_section'>";
                            echo "<i class='fas fa-users'></i>";
                            echo "<button>Quản lí tài khoản</button>";
                        echo "</div>";
                        echo "<div class='item_menu item_section'>";
                            echo "<i class='fas fa-store'></i>";
                            echo "<button>Sản phẩm</button>";
                        echo "</div>";
                        echo "<div class='item_menu item_section'>";
                            echo "<i class='fas fa-blog'></i>";
                            echo "<button>Blog Website</button>";
                        echo "</div>";
                        echo "<div class='item_menu item_section'>";
                            echo "<i class='fas fa-shipping-fast'></i>";
                            echo "<button>Giao hàng</button>";
                        echo "</div>";
                    }
                    else{
                        ?>
                        <div class='item_menu item_section'>
                            <i class='fas fa-shopping-cart'></i>
                            <button>Giỏ hàng</button>
                        </div>
                        <div class='item_menu item_section'>
                            <i class="fas fa-money-bill-alt"></i>
                            <button>Hóa đơn</button>
                        </div>
                        <div class='item_menu item_section'>
                            <i class='fas fa-thumbs-up'></i>
                            <button>Bộ sưu tập</button>
                        </div>
                        <?php
                    }
                ?>
                <div class='item_menu backTo_pageHome'>
                    <i class='fas fa-home'></i>
                    <button>Trở về trang chủ</button>
                </div>
                <form action="../../index.php" class='item_menu' method='post'>
                    <i class='fas fa-sign-out-alt'></i>
                    <button name='submit_logout'>Đăng xuất</button>
                </form>
            </div>
        </section>
        <aside>
            <div class="item_aside content_info menu-active">
                <h1 class="title_content">Thông tin cá nhân</h1>
                <div class='show_allInfoAcc col-11'>
                    <?php
                        $select_info = "SELECT * FROM taikhoan WHERE tenTK = '$userName'";
                        $result_info = $conn->query($select_info);
                        if($result_info->num_rows>0){
                            $row_info = $result_info->fetch_assoc();
                            echo "<div class='img_info'>
                                    <img class='avatar_user' src='../img/img-avatar/{$row_info['avatar']}' alt=''>
                                </div>";
                            echo "<form action='./manage_account.php' class='form_infoAccount' method='post'>
                                    <table  class='table_info'>";
                                    echo "<input type='text' class='input_none' name='getInfo_userID' value='{$row_info['ID']}'>";
                                        echo "<tr>";
                                            echo "<td><b>ID: </b></td>";
                                            echo "<td>109845385{$row_info['ID']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Tên tài khoản: </b></td>";
                                            echo "<td>{$row_info['tenTK']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Giới tính: </b></td>";
                                            echo "<td>{$row_info['gioiTinh']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Số điện thoại: </b></td>";
                                            echo "<td>{$row_info['SDT']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Địa chỉ: </b></td>";
                                            echo "<td>{$row_info['diaChi']}</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td><b>Cập nhật lần cuối: </b></td>";
                                            echo "<td>{$row_info['ngayTao']}</td>";
                                        echo "</tr>";
                                    echo "</table>";
                                echo "<input type='submit' class='submit_form' name='submit_updateAccount' value='Cập nhật tài khoản'>";
                            echo "</form>";
                        }else{
                            echo "<h1>Bạn chưa đăng nhập</h1>";
                        }
                    ?>
                </div>
            </div>
            <div class="item_aside content_security">
                <h1 class='title_content'>Đổi mật khẩu</h1>
                <form action="" class='form_changePass' style="width: 50%;" method='post'>
                    <input type="text" class='input_none' name='ID_userChangePass' value='<?php echo $ID_userPage; ?>'>
                    <input type="password"  class='input_passOld' required placeholder='Nhập mật khẩu hiện tại'>
                    <span class='span_checkPass'></span>
                    <input type="password"  class='input_passNews' name='pass_news' required placeholder='Tạo mật khẩu mới'>
                    <span class='span_passNews'></span>
                    <progress max="100" value="0" class="meter"></progress>
                    <input type="password" class='input_re-passNews'  required placeholder='Nhập lại mật khẩu mới'>
                    <span class='span_re-passNews'></span>
                    <input type="submit" class='btn_changePass' name='submit_changePassword' value='Đổi mật khẩu'>
                </form>
            </div>
            <?php
                if(isset($userName) && $userName == "Admin"){
                    echo "<div class='item_aside content_account'>";
                        echo "<form action='./manage_account.php?id_active=2' class='formSearch' method='post'>";
                            echo "<input type='text' required class='input_textSearch' name='input_searchAccount' placeholder='Tìm kiếm tài khoản'>";
                            echo "<select name='select_typeSearch'>";
                                echo "<option value='ID'>ID</option>";
                                echo "<option value='tenTK'>Tên</option>";
                                echo "<option value='SDT'>Số điện thoại</option>";
                                echo "<option value='diaChi'>Địa chỉ</option>";
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchAccount' value='Tìm kiếm'>";
                        echo "</form>";
                        if(isset($_GET['numberPage_Account'])){
                            $page_current = $_GET['numberPage_Account'];
                            $account_start = $page_current * 4;
                            $allInfo_user = "SELECT * FROM taikhoan WHERE tenTK != 'Admin' LIMIT 4 OFFSET $account_start";
                        }
                        else if(isset($_POST['submit_searchAccount'])){
                            echo "<form action='./manage_account.php?id_active=2' class='form_addOrShow' method='post'>'";
                                echo "<input type='submit' class = 'submit_form' name='submit_showAllProduct' value='Hiển thị tất cả các tài khoản'>";
                            echo "</form>";
                            $select_typeSearch = $_POST['select_typeSearch'];
                            $data_search = $_POST['input_searchAccount'];
                            if($select_typeSearch == "ID"){
                                echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các tài khoản có ID: $data_search </h1>";
                                $allInfo_user = "SELECT * FROM taikhoan  WHERE $select_typeSearch = '{$data_search}'";
                            }
                            else{
                                if($select_typeSearch == "tenTK"){
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các tài khoản có tên: $data_search </h1>";
                                }
                                else if($select_typeSearch == "SDT"){
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các tài khoản có số điện thoại: $data_search </h1>";
                                }
                                else if($select_typeSearch == "diaChi"){
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các tài khoản có địa chỉ: $data_search </h1>";
                                }
                                $allInfo_user = "SELECT * FROM taikhoan  WHERE $select_typeSearch LIKE '%{$data_search}%'";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Thông tin tất cả các tài khoản</h1>";
                            $allInfo_user = "SELECT * FROM taikhoan WHERE tenTK != 'Admin' LIMIT 4 OFFSET 0";
                        }
                        $resultInfo_allUser = $conn->query($allInfo_user);
                        if($resultInfo_allUser ->num_rows>0){
                            while($row_info = $resultInfo_allUser->fetch_assoc()){
                                echo "<div class='item_info Account'>";
                                    echo "<div class='infoAccount_img'>";
                                        echo "<img src='../img/img-avatar/{$row_info['avatar']}'>";
                                    echo "</div>";
                                    echo "<div class='infoAccount-content'>";
                                        echo "<p><b>ID:</b> {$row_info['ID']}</p>";
                                        echo "<p><b>Tên tài khoản:</b> {$row_info['tenTK']}</p>";
                                        echo "<p><b>Giới tính:</b> {$row_info['gioiTinh']}</p>";
                                        echo "<p><b>Số điện thoại:</b> {$row_info['SDT']}</p>";
                                        echo "<p><b>Địa chỉ:</b> {$row_info['diaChi']}</p>";
                                        echo "<p><b>Ngày tạo:</b> {$row_info['ngayTao']}</p>";
                                    echo "</div>";
                                    echo "<a href='./Manage Admin/delete_account.php?id={$row_info['ID']}' class='btn_UpdateDelete-item'>Xóa</a>";
                                echo "</div>";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Không có dữ liệu tài khoản</h1>";
                        }
                        if(!isset($_POST['submit_searchAccount'])){
                            if(isset($_GET['numberPage_Account'])){
                                $page_currentAcc = $_GET['numberPage_Account'];
                            }
                            else{
                                $page_currentAcc = 0;
                            }

                            $numberPage_account = "SELECT COUNT(*) as sumAccount FROM taikhoan";
                            $sqlSum_Account = $conn->query($numberPage_account);
                            if($sqlSum_Account == TRUE){
                                $rowSum = $sqlSum_Account->fetch_assoc();
                                $sumAccount = $rowSum['sumAccount'];

                                $sumNumber_pageAccount = ceil($sumAccount / 4);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageAccount; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentAcc){
                                            echo "<a href='./manage_account.php?numberPage_Account=$i&id_active=2'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./manage_account.php?numberPage_Account=$i&id_active=2'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";

                    echo "<div class='item_aside content_product'>";
                        echo "<form action='./manage_account.php?id_active=3' class='formSearch' method='post'>";
                            echo "<input type='text' class='input_textSearch'required name='input_searchProduct' placeholder='Tìm kiếm sản phẩm'>";
                            echo "<select name='select_typeSearch'>";
                                echo "<option value='maSP'>Mã sản phẩm</option>";
                                echo "<option value='tenSP'>Tên sản phẩm</option>";
                                echo "<option value='gia'>Giá</option>";
                                echo "<option value='soLuong'>Số lượng</option>";
                                echo "<option value='menh'>Mệnh</option>";
                                echo "<option value='loaiSP'>Loại sản phẩm</option>";
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchProduct' value='Tìm kiếm'>";
                        echo "</form>";
                        echo "<form action='./manage_account.php?id_active=3' class='form_addOrShow' method='post'>'";
                            echo "<a href='manage_account.php?id_active=3&addProduct' class='submit_form'>Thêm sản phẩm mới</a>";
                            echo "<input type='submit' class = 'submit_form' name='submit_showAllProduct' value='Hiển thị tất cả các sản phẩm'>";
                        echo "</form>";
                        if(isset($_GET['numberPage_product'])){
                            $page_current = $_GET['numberPage_product'];
                            $product_start = $page_current * 5;
                            $all_product = "SELECT * FROM sanpham LIMIT 5 OFFSET $product_start";
                        }
                        else if(isset($_POST['submit_searchProduct'])){
                            $select_typeSearch = $_POST['select_typeSearch'];
                            $data_search = $_POST['input_searchProduct'];
                            if($select_typeSearch == "gia"){
                                echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm có giá <= $data_search VNĐ là </h1>";
                                $all_product = "SELECT * FROM sanpham  WHERE $select_typeSearch <= '{$data_search}'";
                            }
                            else if($select_typeSearch == "soLuong"){
                                echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm có số lượng: $data_search là </h1>";
                                $all_product = "SELECT * FROM sanpham  WHERE $select_typeSearch = '{$data_search}'";
                            }
                            else if($select_typeSearch == "maSP"){
                                echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm có mã: $data_search là </h1>";
                                $all_product = "SELECT * FROM sanpham  WHERE $select_typeSearch = '{$data_search}'";
                            }
                            else{
                                if($select_typeSearch == "tenSP"){
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm có tên: $data_search là </h1>";
                                }
                                else if($select_typeSearch == "menh"){
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm có mệnh: $data_search là </h1>";
                                }
                                else {
                                    echo "<h1 style='line-height: 20px;' class='title_content'>Thông tin các sản phẩm loại $data_search là </h1>";
                                }
                                $all_product = "SELECT * FROM sanpham  WHERE $select_typeSearch LIKE '%{$data_search}%'";
                            }
                        }
                        else{
                            $all_product = "SELECT * FROM sanpham LIMIT 5 OFFSET 0";
                            echo "<h1 class='title_content'>Thông tin tất cả các sản phẩm</h1>";
                        }
                        $resultInfo_allProduct = $conn->query($all_product);
                        if($resultInfo_allProduct ->num_rows>0){
                            while($rowInfo_product = $resultInfo_allProduct->fetch_assoc()){
                                echo "<div class='item_info Product'>";
                                    echo "<div class='infoProduct_img'>";
                                        echo "<img src ='../img/img-sp/{$rowInfo_product['loaiSP']}/{$rowInfo_product['anhSP']}'>";
                                    echo "</div>";
                                    echo "<div class='infoProduct-content' style='font-size:2rem'>";
                                        echo "<p><b>ID:</b> {$rowInfo_product['maSP']}</p>";
                                        echo "<p><b>Tên sản phẩm:</b> {$rowInfo_product['tenSP']}</p>";
                                        echo "<p><span style='margin-right: 5px;'><b>Số lượng:</b> {$rowInfo_product['soLuong']}</span>
                                                <i class='fas fa-arrows-alt-h'></i>
                                                <span style='margin-left: 5px;'><b>Giá:</b> {$rowInfo_product['gia']} VNĐ</span>
                                            </p>";
                                        echo "<p><b>Loại đá:</b> {$rowInfo_product['loaiDa']}</p>";
                                        echo "<p><b>Loại sản phẩm:</b> {$rowInfo_product['loaiSP']}</p>";
                                        echo "<p><b>Mệnh:</b> {$rowInfo_product['menh']}</p>";
                                    echo "</div>";
                                    echo "<div class='btn_UpdateDelete'>";
                                        echo "<a href='./manage_account.php?id={$rowInfo_product['maSP']}&id_active=3&update_product' class='btn_UpdateDelete-item'>Sửa</a>";
                                        echo "<a href='./Manage Admin/delete_product.php?id={$rowInfo_product['maSP']}' class='btn_UpdateDelete-item'>Xóa</a>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Không có dữ liệu sản phẩm</h1>";
                        }
                        if(!isset($_POST['submit_searchProduct'])){
                            if(isset($_GET['numberPage_product'])){
                                $page_currentProduct = $_GET['numberPage_product'];
                            }
                            else{
                                $page_currentProduct = 0;
                            }

                            $numberPage_product = "SELECT COUNT(*) as sumProduct FROM sanpham";
                            $sqlSum_Product = $conn->query($numberPage_product);
                            if($sqlSum_Product == TRUE){
                                $rowSum = $sqlSum_Product->fetch_assoc();
                                $sumProduct = $rowSum['sumProduct'];

                                $sumNumber_pageProduct = ceil($sumProduct / 5);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageProduct; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentProduct){
                                            echo "<a href='./manage_account.php?numberPage_product=$i&id_active=3'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./manage_account.php?numberPage_product=$i&id_active=3'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";

                    echo "<div class='item_aside content_blogWeb'>";
                        ?>
                            <form action="./manage_account.php?id_active=4" method='post' id="formSearch" class="formSearch">
                                <input type="text" class="input_textSearch"  id="inputSearch_blogWeb" name="inputSearch_blogWeb" placeholder="Tìm kiếm bài viết">
                                <select name="Type_search">
                                    <option value="ID_blog">ID Blog</option>
                                    <option value="tieuDe">Tên Blog</option>
                                </select>
                                <input type="submit" class='submit_form' name="submitSearch_blogWeb" value="Tìm kiếm">
                            </form>
                            <form action="./manage_account.php?id_active=4" method='post' class="form_addOrShow">
                                <input type="submit"  class='submit_form' name='formAdd_BlogWeb' value='Thêm blog mới'>
                                <input type="submit"  class='submit_form' name='submitShow_allBlog' value='Hiển thị tất cả các blog'>
                            </form>
                        <?php
                            echo "<div class='all_blogWeb'>";
                            if(isset($_GET['numberPage_blogWeb'])){
                                $page_current = $_GET['numberPage_blogWeb'];
                                $blogWeb_start = $page_current * 3;
                                $show_blog = "SELECT * FROM blogweb LIMIT 3 OFFSET $blogWeb_start";
                                echo "<h1 class='title_allBlog'>Thông tin tất cả các blog</h1>";
                            }
                            else if(isset($_POST['submitSearch_blogWeb'])){
                                $Type_search = $_POST['Type_search'];
                                $data_search = $_POST['inputSearch_blogWeb'];
                                echo "<h1 class='title_allBlog'>Thông tin tất cả các blog tìm kiếm</h1>";
                                $show_blog = "SELECT * FROM blogweb WHERE $Type_search LIKE '%{$data_search}%'" ;
                            }
                            else{
                                echo "<h1 class='title_allBlog'>Thông tin tất cả các blog</h1>";
                                $show_blog = "SELECT * FROM blogweb LIMIT 3 OFFSET 0";
                            }
                            $resultInfo_Blog = $conn->query($show_blog);
                            if ($resultInfo_Blog ->num_rows > 0){
                                while ($rowInfo_blog =$resultInfo_Blog -> fetch_assoc()) {
                                    echo "<div class= 'item_infoBlog'>";
                                    echo "<div class= 'item_infoBlog-img col-5'>";
                                        echo "<img src ='../img/img-blog/{$rowInfo_blog['linkAnh']}' >";
                                    echo "</div>";

                                    echo "<div class='item_infoBlog-content col-6'>";
                                        echo "<p><b>Tên Blog: </b> {$rowInfo_blog['tieuDe']} </p>";
                                        echo "<p><b>Ngày tạo: </b> {$rowInfo_blog['ngayTao']} </p>";
                                        echo "<p><b>Link ảnh: </b> {$rowInfo_blog['linkAnh']} </p>";
                                        echo "<p><b>Link blog: </b> {$rowInfo_blog['linkBlog']} </p>";
                                    echo "</div>";

                                    echo "<div class='btn_UpdateDelete'>";
                                        echo "<a href='./Manage Admin/update_blog.php?id_blog={$rowInfo_blog['ID_blog']}' class='btn_UpdateDelete-item'>Sửa</a></br>";
                                        echo "<a href='./Manage Admin/delete_blog.php?id_blog={$rowInfo_blog['ID_blog']}' class='btn_UpdateDelete-item'>Xóa</a>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                            else{
                                echo "<script> alert('Không tìm thấy kết quả phù hợp'); </script>";
                            }
                            if(!isset($_POST['submitSearch_blogWeb'])){
                                if(isset($_GET['numberPage_blogWeb'])){
                                    $page_currentBlogWeb = $_GET['numberPage_blogWeb'];
                                }
                                else{
                                    $page_currentBlogWeb = 0;
                                }

                                $numberPage_blogWeb = "SELECT COUNT(*) as sumBlogWeb FROM blogweb";
                                $sqlSum_blogWeb = $conn->query($numberPage_blogWeb);
                                if($sqlSum_blogWeb == TRUE){
                                    $rowSum = $sqlSum_blogWeb->fetch_assoc();
                                    $sumBlogWeb = $rowSum['sumBlogWeb'];

                                    $sumNumber_pageBlogWeb = ceil($sumBlogWeb / 3);
                                    echo "<div class='numberPage'>";
                                        for($i = 0; $i <$sumNumber_pageBlogWeb; $i++){
                                            $number = $i +1;
                                            if($i == $page_currentBlogWeb){
                                                echo "<a href='./manage_account.php?numberPage_blogWeb=$i&id_active=4'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                            }
                                            else{
                                                echo "<a href='./manage_account.php?numberPage_blogWeb=$i&id_active=4'><p class='item_numberPage'>{$number}</p></a>";
                                            }
                                        }
                                    echo "</div>";
                                }
                            }
                    echo "</div>";

                    echo "<div class='item_aside content_ship'>";
                        echo "<form action='./manage_account.php?id_active=5' class='formSearch' method='post'>";
                            echo "<input type='text' class='input_textSearch' required name='dataSearch' placeholder='Tìm kiếm đơn vị vận chuyển'>";
                            echo "<select name='typeSearch'>";
                                echo "<option value='ID_dvi'>Mã đơn vị vận chuyển</option>";
                                echo "<option value='tenDvi'>Tên đơn vị vận chuyển</option>";
                                echo "<option value='phiGH'>Phí vận chuyển</option>";;
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchTransport' value='Tìm kiếm'>";
                        echo "</form>";
                        echo "<form action='./manage_account.php?id_active=5' class='form_addOrShow' method='post'>";
                            echo "<a href='./Manage Admin/add_transport.php' class='submit_form'>Thêm đơn vị vận chuyển mới</a>";
                            echo "<input type='submit' class='submit_form' name='submit_showTransport' value='Hiển thị các đơn vị vận chuyển'>";
                        echo "</form>";
                        //show all transport
                        if(isset($_GET['numberPage_Transport'])){
                           $page_current = $_GET['numberPage_Transport'];
                           $transport_start = $page_current * 3;
                           $sql_infoTransport = "SELECT * FROM giaohang LIMIT 3 OFFSET $transport_start";
                        }
                        else if(isset($_POST['submit_searchTransport'])) {
                            $dataSearch = $_POST['dataSearch'];
                            $typeSearch = $_POST['typeSearch'];
                            if($typeSearch == 'phiGH') {
                                echo "<h1 class='title_content'>Thông tin đơn vị vận chuyển có phí <= $dataSearch</h1>";
                                $sql_infoTransport = "SELECT * FROM giaohang WHERE $typeSearch <= '$dataSearch'";
                            }
                            else {
                                if($typeSearch == 'ID_dvi') {
                                    echo "<h1 class='title_content'>Thông tin đơn vị vận chuyển có ID = $dataSearch</h1>";
                                }
                                else{
                                    echo "<h1 class='title_content'>Thông tin đơn vị vận chuyển có chứa kí tự: '$dataSearch'</h1>";
                                }
                                $sql_infoTransport = "SELECT * FROM giaohang WHERE $typeSearch LIKE '%{$dataSearch}%'";
                            }
                        }
                        else{
                            $sql_infoTransport = "SELECT * FROM giaohang LIMIT 3 OFFSET 0";
                            echo "<h1 class='title_content'>Thông tin các đơn vị vận chuyển</h1>";
                        }
                        $resultInfo_allTransport = $conn->query($sql_infoTransport);
                        if($resultInfo_allTransport -> num_rows > 0) {
                            while($row_infoTransport = $resultInfo_allTransport->fetch_assoc()) {
                                echo "<div class='item_infoTransport'>";
                                    echo "<div class='infoTransport-content col-8'>";
                                        echo "<p><b>ID đơn vị vận chuyển:</b> {$row_infoTransport['ID_dvi']}</p>";
                                        echo "<p><b>Tên đơn vị vận chuyển:</b> {$row_infoTransport['tenDvi']}</p>";
                                        echo "<p><b>Phí vận chuyển:</b> {$row_infoTransport['phiGH']}</p>";
                                        echo "<p><b>Thời gian vận chuyển:</b> {$row_infoTransport['thoigianGH']}</p>";
                                    echo "</div>";
                                    echo "<div class='btn_UpdateDelete col-4'>";
                                        echo "<a href='./Manage Admin/delete_transport.php?id={$row_infoTransport['ID_dvi']}' class='btn_UpdateDelete-item'>Xóa</a>";
                                        echo "<a href='./Manage Admin/update_transport.php?id={$row_infoTransport['ID_dvi']}' class='btn_UpdateDelete-item'>Sửa</a>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                        else {
                            echo "<h1 class='title_content'>Không tìm thấy dữ liệu đơn vị vận chuyển</h1>";
                        }
                        if(!isset($_POST['submit_searchTransport'])){
                            if(isset($_GET['numberPage_Transport'])){
                                $page_currentTrans = $_GET['numberPage_Transport'];
                            }
                            else{
                                $page_currentTrans = 0;
                            }

                            $numberPage_transport = "SELECT COUNT(*) as sumTransport FROM giaohang";
                            $sqlSum_Transport = $conn->query($numberPage_transport);
                            if($sqlSum_Transport == TRUE){
                                $rowSum = $sqlSum_Transport->fetch_assoc();
                                $sumTransport = $rowSum['sumTransport'];

                                $sumNumber_pageTransport = ceil($sumTransport / 3);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageTransport; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentTrans){
                                            echo "<a href='./manage_account.php?numberPage_Transport=$i&id_active=5'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./manage_account.php?numberPage_Transport=$i&id_active=5'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";
                }
                else{
                    echo "<div class='item_aside content_cart'>";
                        echo "<form action='./manage_account.php?id_active=2' method='post' class='formSearch'>";
                            echo "<input type='text' required class='input_textSearch' name='input_searchCart' placeholder='Tìm kiếm giỏ hàng'>";
                            echo "<select name='select_typeSearch'>";
                                echo "<option value='tenSP'>Tên sản phẩm</option>";
                                echo "<option value='soLuong'>Số lượng</option>";
                                echo "<option value='thanhTien'>Thành tiền</option>";
                                echo "<option value='trangThai'>Trạng thái</option>";
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchCart' value='Tìm kiếm'>";
                        echo "</form>";
                        echo "<form action='./manage_account.php?id_active=2' class='form_addOrShow' method='post'>";
                            echo "<a href='./product_news.php' class='submit_form'>Thêm giỏ hàng mới</a>";
                            echo "<input type='submit' class = 'submit_form' name='submit_showAllCart' value='Hiển thị tất cả các sản phẩm trong giỏ hàng'>";
                        echo "</form>";

                        if(isset($_GET['numberPage_cart'])){
                            $page_current = $_GET['numberPage_cart'];
                            $cart_start = $page_current * 4;
                            $allInfo_Cart = "SELECT *, sanpham.soLuong as soLuongTon, giohang.soLuong as soLuongMua
                            FROM giohang, sanpham WHERE (ID_taikhoan = '$ID_userPage' AND maSP = ID_SanPham) LIMIT 4 OFFSET $cart_start";
                        }
                        else if(isset($_POST['submit_searchCart'])){
                            $input_searchCart = $_POST['input_searchCart'];
                            $select_typeSearch = $_POST['select_typeSearch'];
                            if($select_typeSearch == "tenSP"){
                                echo "<h1 class='title_content' style='font-size: 2.2rem'>Thông tin các sản phẩm trong giỏ hàng có tên $input_searchCart</h1>";
                                $allInfo_Cart = "SELECT *, sanpham.soLuong as soLuongTon, giohang.soLuong as soLuongMua
                                      FROM giohang,sanpham WHERE (sanpham.{$select_typeSearch} LIKE '%{$input_searchCart}%' AND maSP = ID_SanPham) and giohang.ID_TaiKhoan = '{$ID_userPage}'";
                            }
                            else if($select_typeSearch == "thanhTien" || $select_typeSearch == 'soLuong'){
                                if($select_typeSearch == "thanhTien"){
                                    echo "<h1 class='title_content' style='font-size: 2.2rem'>Thông tin các sản phẩm trong giỏ hàng có thành tiền = $input_searchCart</h1>";
                                }else{
                                    echo "<h1 class='title_content' style='font-size: 2.2rem'>Thông tin các sản phẩm trong giỏ hàng có số lượng = $input_searchCart</h1>";
                                }
                                $allInfo_Cart = "SELECT *, sanpham.soLuong as soLuongTon, giohang.soLuong as soLuongMua
                                    FROM giohang,sanpham WHERE (giohang.{$select_typeSearch} = '$input_searchCart' AND maSP = ID_SanPham) and giohang.ID_TaiKhoan = '{$ID_userPage}'";
                            }
                            else{
                                echo "<h1 class='title_content' style='font-size: 2.2rem'>Thông tin các sản phẩm trong giỏ hàng có trạng thái $input_searchCart</h1>";
                                $allInfo_Cart = "SELECT *, sanpham.soLuong as soLuongTon, giohang.soLuong as soLuongMua
                                    FROM giohang,sanpham WHERE (giohang.{$select_typeSearch} LIKE '%{$input_searchCart}%' AND maSP = ID_SanPham) and giohang.ID_TaiKhoan = '{$ID_userPage}' ";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Thông tin các sản phẩm trong giỏ hàng của bạn</h1>";
                            $allInfo_Cart = "SELECT *, sanpham.soLuong as soLuongTon, giohang.soLuong as soLuongMua
                                        FROM giohang, sanpham WHERE (ID_taikhoan = '$ID_userPage' AND maSP = ID_SanPham) LIMIT 4 OFFSET 0";
                        }
                        $resultInfo_allCart = $conn->query($allInfo_Cart);
                        if($resultInfo_allCart->num_rows>0){
                            while($rowInfoCart = $resultInfo_allCart->fetch_assoc()){
                                echo "<div class='item_info Cart'>";
                                    echo "<div class='infoCart_img'>";
                                        echo "<img src='../img/img-sp/{$rowInfoCart['loaiSP']}/{$rowInfoCart['anhSP']}'>";
                                    echo "</div>";
                                    echo "<form class='infoCart_content col-7' method='post'>";
                                        echo "<div class='all_infoCart'>";
                                            echo "<h3>{$rowInfoCart['tenSP']}</h3>";
                                            echo "<p>Mã sản phẩm: <b>SP00584-sp-{$rowInfoCart['ID_SanPham']}</b></p>";
                                            echo "<p>Đơn giá: <b>{$rowInfoCart['donGia']} VNĐ</b></p>";
                                            echo "<p>Số lượng sản phẩm: <b>{$rowInfoCart['soLuongMua']}</b></p>";
                                            echo "<p>Thành tiền: <b>{$rowInfoCart['thanhTien']} VNĐ</b></p>";
                                            echo "<p>Trạng thái: <b>{$rowInfoCart['trangThai']}</b></p>";

                                            echo "<input type='text' class='input_none' name='soLuongTon' value='{$rowInfoCart['soLuongTon']}'>";
                                            echo "<input type='text' class='input_none' name='ID_gioHang' value='{$rowInfoCart['ID_gioHang']}'>";
                                            echo "<input type='text' class='input_none' name='donGia' value='{$rowInfoCart['donGia']}'>";
                                            echo "<input type='text' class='input_none' name='soLuongMua' value='{$rowInfoCart['soLuongMua']}'>";
                                            echo "<input type='text' class='input_none' name='thanhTien' value='{$rowInfoCart['thanhTien']}'>";
                                        echo "</div>";
                                        echo "<div class='all_btnCart'>";
                                            echo "<a class='btn_UpdateDelete-item' href='./Manage User/delete_cart.php?id={$rowInfoCart['ID_gioHang']}'>Xóa</a>";
                                            if($rowInfoCart['trangThai'] == 'Đã thanh toán'){
                                                echo "<a class='btn_UpdateDelete-item' href='./details.php?id={$rowInfoCart['ID_SanPham']}&loai={$rowInfoCart['loaiSP']}'>Mua lại</a>";
                                                echo "<a class='btn_UpdateDelete-item' href='./details.php?id={$rowInfoCart['maSP']}&loai={$rowInfoCart['loaiSP']}&createFeedback'>Đánh giá</a>";
                                            }else{
                                                echo "<input class='btn_UpdateDelete-item' type='submit' name='submit_updateCart' value='Sửa'>";
                                                echo "<a class='btn_UpdateDelete-item' href='./Manage User/buyProduct_cart.php?id_cart={$rowInfoCart['ID_gioHang']}'>Mua ngay</a>";
                                            }
                                        echo "</div>";
                                    echo "</form>";
                                echo "</div>";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Không tìm thấy sản phẩm trong giỏ hàng</h1>";
                        }
                        if(!isset($_POST['submit_searchCart'])){
                            if(isset($_GET['numberPage_cart'])){
                                $page_currentCart = $_GET['numberPage_cart'];
                            }
                            else{
                                $page_currentCart = 0;
                            }

                            $numberPage_cart = "SELECT COUNT(*) as sumCart FROM giohang WHERE ID_TaiKhoan ='$ID_userPage'";
                            $sqlSum_Cart = $conn->query($numberPage_cart);
                            if($sqlSum_Cart == TRUE){
                                $rowSum = $sqlSum_Cart->fetch_assoc();
                                $sumCart = $rowSum['sumCart'];

                                $sumNumber_pageCart = ceil($sumCart / 4);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageCart; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentCart){
                                            echo "<a href='./manage_account.php?numberPage_cart=$i&id_active=2'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./manage_account.php?numberPage_cart=$i&id_active=2'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";

                    echo "<div class='item_aside content_bill'>";
                        echo "<form action='./manage_account.php?id_active=3' method='post' class='formSearch'>";
                            echo "<input type='text' required class='input_textSearch' name='input_searchBill' placeholder='Tìm kiếm đơn hàng'>";
                            echo "<select name='select_typeSearch'>";
                                echo "<option value='tenSP'>Tên sản phẩm</option>";
                                echo "<option value='thanhTien'>Tổng số tiền</option>";
                                echo "<option value='diaChi'>Địa chỉ</option>";
                                echo "<option value='tenDvi'>Đơn vị vận chuyển</option>";
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchBill' value='Tìm kiếm'>";
                        echo "</form>";
                        echo "<form action='./manage_account.php?id_active=3' class='form_addOrShow' method='post'>";
                            echo "<a href='./manage_account.php?id_active=2' class='submit_form'>Thanh toán hóa đơn tại giỏ hàng</a>";
                            echo "<input type='submit' class = 'submit_form' name='submit_showAllBill' value='Hiển thị tất cả đơn hàng đã mua'>";
                        echo "</form>";

                        if(isset($_GET['numberPage_bill'])){
                            $page_current = $_GET['numberPage_bill'];
                            $bill_start = $page_current * 3;
                            $allInfo_bill = "SELECT *, giohang.soLuong as soLuongMua, hoadon.thanhTien as tongTien, hoadon.SDT as SDTMua, hoadon.tenKH as tenKHMua, hoadon.diaChi as diaChiNhan
                                        FROM giohang,hoadon, sanpham, taikhoan, giaohang
                                        WHERE (hoadon.ID_TaiKhoan = '$ID_userPage' AND hoadon.ID_TaiKhoan = taikhoan.ID)
                                        and (hoadon.ID_SanPham = sanpham.maSP)
                                        and (hoadon.ID_dvGiaoHang = giaohang.ID_dvi)
                                        and (hoadon.ID_giohang = giohang.ID_gioHang) LIMIT 3 OFFSET $bill_start";
                        }
                        else if(isset($_POST['submit_searchBill'])){
                            $input_searchBill = $_POST['input_searchBill'];
                            $select_typeSearch = $_POST['select_typeSearch'];
                            if($select_typeSearch == "thanhTien"){
                                echo "<h1 class='title_content'>Thông tin các hóa đơn có tổng thanh toán = $input_searchBill</h1>";
                                $allInfo_bill = "SELECT *, giohang.soLuong as soLuongMua, hoadon.thanhTien as tongTien, hoadon.SDT as SDTMua, hoadon.tenKH as tenKHMua, hoadon.diaChi as diaChiNhan
                                FROM hoadon,sanpham,giohang,giaohang WHERE hoadon.{$select_typeSearch} = '$input_searchBill' AND sanpham.maSP = hoadon.ID_SanPham AND (giohang.ID_gioHang = hoadon.ID_gioHang AND hoadon.ID_dvGiaoHang = giaohang.ID_dvi)";
                            }
                            else{
                                if($select_typeSearch == "tenSP"){
                                    echo "<h1 class='title_content'>Thông tin các hóa đơn có tên sản phẩm: $input_searchBill</h1>";
                                }else if($select_typeSearch == "tenDvi"){
                                    echo "<h1 class='title_content'>Thông tin các hóa đơn có đơn vị vận chuyển: $input_searchBill</h1>";
                                }else{
                                    echo "<h1 class='title_content'>Thông tin các hóa đơn có địa chỉ: $input_searchBill</h1>";
                                }
                                $allInfo_bill = "SELECT *, giohang.soLuong as soLuongMua, hoadon.thanhTien as tongTien, hoadon.SDT as SDTMua, hoadon.tenKH as tenKHMua, hoadon.diaChi as diaChiNhan
                                FROM sanpham, hoadon,giohang ,giaohang WHERE $select_typeSearch LIKE '%{$input_searchBill}%' AND sanpham.maSP = hoadon.ID_SanPham AND (giohang.ID_gioHang = hoadon.ID_gioHang AND hoadon.ID_dvGiaoHang = giaohang.ID_dvi)";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Thông tin các hóa đơn đã mua</h1>";
                            $allInfo_bill = "SELECT *, giohang.soLuong as soLuongMua, hoadon.thanhTien as tongTien, hoadon.SDT as SDTMua, hoadon.tenKH as tenKHMua, hoadon.diaChi as diaChiNhan
                                        FROM giohang,hoadon, sanpham, taikhoan, giaohang
                                        WHERE (hoadon.ID_TaiKhoan = '$ID_userPage' AND hoadon.ID_TaiKhoan = taikhoan.ID)
                                        and (hoadon.ID_SanPham = sanpham.maSP)
                                        and (hoadon.ID_dvGiaoHang = giaohang.ID_dvi)
                                        and (hoadon.ID_giohang = giohang.ID_gioHang) LIMIT 3 OFFSET 0";
                        }
                        $resultInfo_allBill = $conn->query($allInfo_bill);
                        if($resultInfo_allBill->num_rows > 0) {
                            while($row_infoBill = $resultInfo_allBill->fetch_assoc()) {
                                echo "<div class='item_info Bill'>";
                                    echo "<div class='infoBill_img'>";
                                        echo "<img src='../img/img-sp/{$row_infoBill['loaiSP']}/{$row_infoBill['anhSP']}'>";
                                    echo "</div>";
                                    echo "<div class='infoBill_content'>";
                                        echo "<h3>Tên sản phẩm: {$row_infoBill['tenSP']}</h3>";
                                        echo "<p>Đơn giá: <b>{$row_infoBill['donGia']} VNĐ</b></p>";
                                        echo "<p><span style='margin-right: 15px;'>Số lượng: <b>{$row_infoBill['soLuongMua']}</b></span>
                                                <i style='font-size:1.5rem' class='fas fa-arrows-alt-h'></i>
                                                <span style='margin-left: 15px;'>Tổng tiền: <b>{$row_infoBill['tongTien']}</b></span>
                                            </p>";
                                        echo "<p>Đơn vị vận chuyển: <b>{$row_infoBill['tenDvi']}</b></p>";
                                        echo "<p>Tên người nhận: <b>{$row_infoBill['tenKHMua']}</b></p>";
                                        echo "<p>SDT: <b>{$row_infoBill['SDTMua']}</b></p>";
                                        echo "<p>Địa chỉ: <b>{$row_infoBill['diaChiNhan']}</b></p>";
                                    echo "</div>";
                                    echo "<div class='all_btnBill'>";
                                        echo "<a class='btn_UpdateDelete-item' href='./Manage User/delete_bill.php?id={$row_infoBill['maHD']}'>Xóa</a>";
                                        echo "<a class='btn_UpdateDelete-item' href='./details.php?id={$row_infoBill['maSP']}&loai={$row_infoBill['loaiSP']}&createFeedback'>Đánh giá</a>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                        else{
                            echo "<h1 class='title_content'>Bạn chưa mua sản phẩm nào</h1>";
                        }
                        if(!isset($_POST['submit_searchBill'])){
                            if(isset($_GET['numberPage_bill'])){
                                $page_currentBill = $_GET['numberPage_bill'];
                            }
                            else{
                                $page_currentBill = 0;
                            }

                            $numberPage_bill = "SELECT COUNT(*) as sumBill FROM hoadon WHERE ID_TaiKhoan ='$ID_userPage'";
                            $sqlSum_Bill = $conn->query($numberPage_bill);
                            if($sqlSum_Bill == TRUE){
                                $rowSum = $sqlSum_Bill->fetch_assoc();
                                $sumBill = $rowSum['sumBill'];

                                $sumNumber_pageBill = ceil($sumBill / 3);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageBill; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentBill){
                                            echo "<a href='./manage_account.php?numberPage_bill=$i&id_active=3'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./manage_account.php?numberPage_bill=$i&id_active=3'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";

                    echo "<div class='item_aside content_collect'>";
                        echo "<form action='./manage_account.php?id_active=4' class='formSearch' method='post'>";
                            echo "<input type='text' class='input_textSearch' required name='data_search' placeholder='Nhập tên bộ sưu tập'>";
                            echo "<select name='select_typeSearch'>";
                                echo "<option value='tenSP'>Tên sản phẩm</option>";
                                echo "<option value='tenBST'>Tên bộ sưu tập</option>";
                                echo "<option value='gia'>Giá sản phẩm</option>";
                            echo "</select>";
                            echo "<input type='submit' class='submit_form' name='submit_searchCollection' value='Tìm kiếm'>";
                        echo "</form>";
                        echo "<form action='./manage_account.php?id_active=4' class='form_addOrShow' method='post'>";
                            echo "<a href='./product_news.php' class='submit_form'>Thêm sản phẩm mới vào bộ sưu tập</a>";
                            echo "<input type='submit' class='submit_form' name='submit_showCollection' value='Hiển thị thông tin các sản phẩm trong bộ sưu tập'>";
                        echo "</form>";
                        if(isset($_GET['numberPage_Collect'])) {
                            $page_current = $_GET['numberPage_Collect'];
                            $collect_start = $page_current * 3;
                            $allInfo_Collection = "SELECT * FROM bosuutap, sanpham WHERE ID_TaiKhoan = '$ID_userPage'
                                                  and bosuutap.ID_SanPham = sanpham.maSP LIMIT 3 OFFSET $collect_start";
                        }
                        else if(isset($_POST['submit_searchCollection'])) {
                            $select_typeSearch = $_POST['select_typeSearch'];
                            $data_Collection = $_POST['data_search'];
                            if($select_typeSearch == 'gia') {
                                $allInfo_Collection = "SELECT * FROM bosuutap, sanpham WHERE $select_typeSearch <= '$data_Collection'
                                                        and bosuutap.ID_SanPham = sanpham.maSP and ID_TaiKhoan = '$ID_userPage'";
                                echo "<h1 class='title_content'>Sản phẩm có giá <= {$data_Collection} trong BST</h1>";
                            }
                            else {
                                if($select_typeSearch == 'tenBST') {
                                    $allInfo_Collection = "SELECT * FROM bosuutap, sanpham WHERE tenBST = '$data_Collection'
                                                            and bosuutap.ID_SanPham = sanpham.maSP and ID_TaiKhoan = '$ID_userPage'";
                                    echo "<h1 class='title_content'>Bộ sưu tập $data_Collection</h1>";
                                }
                                else {
                                    $allInfo_Collection = "SELECT * FROM bosuutap, sanpham WHERE $select_typeSearch LIKE '%{$data_Collection}%'
                                                            and bosuutap.ID_SanPham = sanpham.maSP and ID_TaiKhoan = '$ID_userPage'";
                                    echo "<h1 class='title_content'>Tên sản phẩm chứa ký tự '{$data_Collection}' trong BST</h1>";
                                }
                            }
                        }
                        else{
                            $allInfo_Collection = "SELECT * FROM bosuutap, sanpham WHERE bosuutap.ID_SanPham = sanpham.maSP
                                                    and ID_TaiKhoan = '$ID_userPage' LIMIT 3 OFFSET 0";
                            echo "<h1 class='title_content'>Thông tin bộ sưu tập của bạn</h1>";
                        }
                        $resultInfo_Collection = $conn->query($allInfo_Collection);
                        if($resultInfo_Collection -> num_rows > 0) {
                            echo "<div class='collection'>";
                                while($row_infoCollection = $resultInfo_Collection->fetch_assoc()){
                                    echo "<div class='item-collect'>";
                                        echo "<a href='../php/details.php?id={$row_infoCollection['maSP']}&loai={$row_infoCollection['loaiSP']}'>
                                                    <img src='../img/img-sp/{$row_infoCollection['loaiSP']}/{$row_infoCollection['anhSP']}' class='img-collect'></a>";
                                        echo "<h1 class='name_collect'>{$row_infoCollection['tenBST']}</h1>";
                                        echo "<div class='content-collect'>";
                                            echo "<h3>{$row_infoCollection['tenSP']}</h3>";
                                            echo "<div class='detail-collect'>";
                                                echo "<a href='../php/details.php?id={$row_infoCollection['maSP']}&loai={$row_infoCollection['loaiSP']}' style='color: red'>Giá: {$row_infoCollection['gia']}</a>";
                                                echo "<a href='./Manage User/delete_itemCollection.php?id={$row_infoCollection['maSP']}&id_user={$ID_userPage}' class='btn_delete'>Xóa</a>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                            }
                            echo "</div>";
                        }
                        else {
                            echo "<h1 class='title_content'>Không có dữ liệu</h1>";
                        }
                        if(!isset($_POST['submit_searchCollection'])){
                            if(isset($_GET['numberPage_Collect'])){
                                $page_currentCollect = $_GET['numberPage_Collect'];
                            }
                            else{
                                $page_currentCollect = 0;
                            }

                            $numberPage_collect = "SELECT COUNT(*) as sumProduct FROM bosuutap, sanpham
                                                  WHERE bosuutap.ID_SanPham = sanpham.maSP and ID_TaiKhoan = '$ID_userPage'";
                            $sqlSum_Collect = $conn->query($numberPage_collect);
                            if($sqlSum_Collect == TRUE){
                                $rowSum = $sqlSum_Collect->fetch_assoc();
                                $sumCollect = $rowSum['sumProduct'];

                                $sumNumber_pageCollect = ceil($sumCollect / 3);
                                echo "<div class='numberPage'>";
                                    for($i = 0; $i <$sumNumber_pageCollect; $i++){
                                        $number = $i +1;
                                        if($i == $page_currentCollect){
                                            echo "<a href='./manage_account.php?numberPage_Collect=$i&id_active=4'><p class='item_numberPage active_numberPage'>{$number}</p></a>";
                                        }
                                        else{
                                            echo "<a href='./manage_account.php?numberPage_Collect=$i&id_active=4'><p class='item_numberPage'>{$number}</p></a>";
                                        }
                                    }
                                echo "</div>";
                            }
                        }
                    echo "</div>";
                }
            ?>
        </aside>
    </div>

    <?php
        // Update Account
        if(isset($_POST['submit_updateAccount'])){
            $idAccount_update = $_POST['getInfo_userID'];
            $getInfo = "SELECT * FROM taikhoan WHERE ID = '$idAccount_update'";
            $result_getInfo = $conn->query($getInfo);
            if($result_getInfo -> num_rows>0){
                $row_getInfo = $result_getInfo->fetch_assoc();
                echo "<div class='form_onTop'>";
                    echo "<div class='overlay'></div>";
                    echo "<div class='layout' style='min-width:500px;box-shadow:1px 1px 8px 1px black'>";
                        echo "<h1 class='title_content'>Cập nhật tài khoản</h1>";
                        echo "<form enctype='multipart/form-data'  method='post' class='form_updateAccount'>";
                            echo "<input type='text' class='input_none' name='ID_user' value='{$row_getInfo['ID']}'>";
                            echo "<p>Cập nhật tên mới</p>";
                            echo "<input type='text' required name='nameUser_news' value='{$row_getInfo['tenTK']}'>";
                            echo "<p>Cập nhật địa chỉ mới</p>";
                            echo "<input type='text' required name='addressUser_news' value='{$row_getInfo['diaChi']}'>";
                            echo "<p>Cập nhật ảnh đại diện mới</p>";
                            echo "<input style='display:none' type='text' name='avatarUser_old' value='{$row_getInfo['avatar']}'>";
                            echo "<input style='background-color:white' type='file' name='avatarUser_news'>";
                            echo "<input type='submit' name='submitForm_updateAccount' class='submit_form'>";
                        echo "</form>";
                        echo "<a href='./manage_account.php'><i style='font-size: 2.1rem' class='fas fa-times icon_close'></i></a>";
                    echo "</div>";
                echo "</div>";
            }
        }
        // submit update acc
        if(isset($_POST['submitForm_updateAccount'])){
            $nameUser_news = $_POST['nameUser_news'];
            $addressUser_news = $_POST['addressUser_news'];
            $id_user = $_POST['ID_user'];

            if($_FILES['avatarUser_news']['size'] == 0 || $_FILES['avatarUser_news']['error'] > 0 ){
                $avatarUser_news = $_POST['avatarUser_old'];
            }
            else {
                $file = $_FILES['avatarUser_news'];
                $avatarUser_news = $file['name'];
                move_uploaded_file($file['tmp_name'],'../img/img-avatar/'.$avatarUser_news);
            }

            $sqlUpdate_account = "UPDATE taikhoan SET tenTK ='$nameUser_news' , diaChi = '$addressUser_news', avatar = '$avatarUser_news' WHERE ID = '$id_user'";
            $result_updateAccount  = $conn->query($sqlUpdate_account);
            if($result_updateAccount == TRUE){
                $_SESSION['avatar'] = $avatarUser_news;
                echo "<script> alert('Cập nhật tài khoản thành công'); window.location.href='./manage_account.php'; </script>";
            }
            else{
                echo "<script> alert('Lỗi cập nhật. Vui lòng thử lại'); window.location.href='./manage_account.php'; </script>";
            }
        }
        // Change Password
        if(isset($_POST['submit_changePassword'])){
            $ID_userChangePass = $_POST['ID_userChangePass'];
            $passNews = $_POST['pass_news'];

            $sql_changePass = "UPDATE taikhoan SET matKhau = '$passNews' WHERE ID = '$ID_userChangePass'";
            $result_changePass = $conn->query($sql_changePass);
            if($result_changePass == TRUE){
                echo "<script>alert('Thay đổi mật khẩu thành công');</script>";
            }
        }
        // Update cart
        if(isset($_POST['submit_updateCart'])){
            $ID_gioHang = $_POST['ID_gioHang'];
            $donGia = $_POST['donGia'];
            $soLuong = $_POST['soLuongMua'];
            $thanhTien = $_POST['thanhTien'];
            $soLuongTon = $_POST['soLuongTon'];

            echo "<div class='form_onTop'>";
                echo "<div class='overlay'></div>";
                echo "<div class='layout layout_updateCart'>";
                    echo "<form action='./Manage User/update_cart.php' class='form_updateCart col-12' method='post'>";
                        echo "<h1 style='font-size: 2.3rem;'>Cập nhật số lượng</h1>";
                        echo "<input type='number' min='1' max='{$soLuongTon}' class= 'getNumber_cart' name='numberCart_news' value='{$soLuong}'>";
                        echo "<p style='font-size: 1.8rem;'>Đơn giá: <b>{$donGia} VNĐ</b></p>";
                        echo "<p style='font-size: 1.8rem;'>Thành tiền: <span style='font-weight:bold' class='show_resultPrice'>{$thanhTien} VNĐ</span></p>";
                        echo "<input type='submit' class='submit_form' name='submitForm_updateAccount' value='Cập nhật'>";

                        echo "<input type='number' class='input_none' name='ID_gioHang' value='{$ID_gioHang}'>";
                        echo "<input type='number' class='input_none getPrice' value='{$donGia}'>";
                        echo "<input type='number' class='input_none getResult_price' name='resultPrice_news' value='{$thanhTien}'>";
                    echo "</form>";
                    echo "<a href='./manage_account.php?id_active=2'><i style='font-size: 2rem' class='fas fa-times icon_close'></i></a>";
                echo "</div>";
            echo "</div>";
            ?>
                <script>
                    document.addEventListener("DOMContentLoaded",function(){
                        var unitPrice = document.querySelector('.getPrice').value;
                        const inputNumber_cart = document.querySelector('.getNumber_cart');
                        inputNumber_cart.onchange = function(){
                            if(document.querySelector('.getNumber_cart').value == document.querySelector('.getNumber_Cart').getAttribute('max')){
                                alert('Số lượng sản phẩm còn lại đã tối đa');
                            }
                            var resultPrice = unitPrice * document.querySelector('.getNumber_cart').value;
                            document.querySelector('.show_resultPrice').innerHTML = `${resultPrice} VNĐ`;
                            document.querySelector('.getResult_price').value = resultPrice;
                        }
                    });
                </script>
            <?php
        }
        //  Add product
        if(isset($_GET['addProduct'])){
            ?>
                <div class="form_onTop">
                    <div class="overlay"></div>
                    <div class="layout layout_addProduct">
                        <h1>Thêm dữ liệu cho sản phẩm mới</h1>
                        <form enctype="multipart/form-data" action="" class='formAdd formProduct_AddorUpdate' method='post'>
                            <input type="text" required class='name_product checkName_product' name='name_Product' placeholder='Nhập tên cho sản phẩm'>
                            <input type="number" required class='price_product checkPrice_product' name='price_Product' min='1000' placeholder='Nhập giá sản phẩm'>
                            <input type="number" required class='number_product checkNumber_product' name='number_Product' min='1' placeholder='Nhập số lượng sản phẩm'>
                            <input type="text" required name='typeSone_Product' placeholder='Nhập loại đá của sản phẩm'>
                            <div class="typeProduct">
                                <p class="title_inputDestiny">Nhập loại sản phẩm</p>
                                <select name="type_Product" >
                                    <option value="Phong thủy">Phong thủy</option>
                                    <option value="Thời trang">Thời trang</option>
                                </select>
                            </div>
                            <div class="destinyProduct">
                                <p class="title_inputDestiny">Nhập mệnh sản phẩm</p>
                                <select name="destiny_Product" >
                                    <option value="Kim">Kim</option>
                                    <option value="Thủy">Thủy</option>
                                    <option value="Hỏa">Hỏa</option>
                                    <option value="Mộc">Mộc</option>
                                    <option value="Thổ">Thổ</option>
                                </select>
                            </div>
                            <input style='background-color: white' class ='img_product' type="file" required name='img_Product'>
                            <input style='width:50%' type="submit" class='btn_submitAdd addProduct btnFormProduct' name='submit_addProduct' value='Thêm sản phẩm'>
                        </form>
                        <a href='./manage_account.php?id_active=3'><i style='font-size: 23px' class='fas fa-times icon_close'></i></a>
                    </div>
                </div>
            <?php
        }
        // Submit addProduct
        if(isset($_POST['submit_addProduct'])){
            $name_Product = $_POST['name_Product'];
            $price_Product = $_POST['price_Product'];
            $type_Product = $_POST['type_Product'];
            $number_Product = $_POST['number_Product'];
            $typeSone_Product = $_POST['typeSone_Product'];
            $destiny_Product = $_POST['destiny_Product'];

            $img_Product = $_FILES['img_Product'];
            $insert_imgProduct = $img_Product['name'];
            if($type_Product == "Mới nhất"){
                move_uploaded_file($img_Product['tmp_name'],'../img/img-sp/Mới nhất/'.$insert_imgProduct);
            }
            else{
                move_uploaded_file($img_Product['tmp_name'],'../img/img-sp/Thời trang/'.$insert_imgProduct);
            }

            $insert_product = "INSERT INTO `sanpham` (`tenSP`,`gia`,`soLuong`,`loaiSP`,`loaiDa`,`menh`,`anhSP`)
                        VALUES ('$name_Product', '$price_Product','$number_Product', '$type_Product','$typeSone_Product','$destiny_Product', '$insert_imgProduct')";
            $result_insert = $conn->query($insert_product);
            if($result_insert == TRUE){
                echo "<script> alert('Thêm sản phẩm thành công');
                window.location.href='./manage_account.php?id_active=3'; </script>";
            }
            else{
                echo "<script> alert('Lỗi thêm sản phẩm, vui lòng thử lại sau'); </script>";
            }
        }
        // update product
        if(isset($_GET['update_product'])){
            $id_product = $_GET['id'];
            $getInfo_product = "SELECT * FROM sanpham WHERE maSP = '$id_product'";
            $reuslt_infoProduct = $conn->query($getInfo_product);
            if($reuslt_infoProduct->num_rows>0){
                $row_infoProduct = $reuslt_infoProduct->fetch_assoc();
            ?>
                <div class="form_onTop">
                    <div class="overlay"></div>
                    <div class="layout layout_updateProduct">
                        <h1>Cập nhật sản phẩm có id <?php echo $row_infoProduct['maSP']; ?></h1>
                        <form enctype="multipart/form-data" method='post'  class='formUpdateProduct formProduct_AddorUpdate' >
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật tên sản phẩm</p>
                                <input required type="text" name='nameProduct_news' class='checkName_product' value='<?php echo $row_infoProduct['tenSP']; ?>'>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật giá sản phẩm</p>
                                <input required type="number" class='checkPrice_product' name='priceProduct_news' min='1000' value='<?php echo $row_infoProduct['gia']; ?>'>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật số lượng sản phẩm</p>
                                <input required type="number" class='checkNumber_product' name='numberProduct_news' min='1' value='<?php echo $row_infoProduct['soLuong']; ?>'>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật loại đá</p>
                                <input required type="text" name='typeSoneProduct_news' value='<?php echo $row_infoProduct['loaiDa']; ?>'>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật loại sản phẩm</p>
                                <select name="typeProduct_news" >
                                    <?php
                                        if($row_infoProduct['loaiSP'] == "Thời trang"){
                                            echo "<option value='Thời trang'>Thời trang</option>";
                                            echo "<option value='Phong thủy'>Phong thủy</option>";
                                        }
                                        else{
                                            echo "<option value='Phong thủy'>Phong thủy</option>";
                                            echo "<option value='Thời trang'>Thời trang</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật mệnh</p>
                                <?php
                                    $arr_destiny = array('Kim','Thủy','Hỏa','Mộc','Thổ');
                                    echo "<select name='destinyProduct_news'>";
                                            echo "<option value='{$row_infoProduct['menh']}'>{$row_infoProduct['menh']}</option>";
                                            for($i = 0 ; $i< sizeof($arr_destiny) ;$i = $i+1){
                                                if($arr_destiny[$i] != $row_infoProduct['menh']){
                                                    echo "<option value='$arr_destiny[$i]'>$arr_destiny[$i]</option>";
                                                }
                                            }
                                    echo "</select>";
                                ?>
                            </div>
                            <div class="item_formUpdateProduct">
                                <p>Cập nhật ảnh sản phẩm</p>
                                <input style='display:none'  type="text" name='imgProduct_old' value='<?php echo $row_infoProduct['anhSP']; ?>'>
                                <input style='background-color:white' type="file" name='imgProduct_news' >
                            </div>
                            <input type="submit" class='submit_updateProduct btnFormProduct' name='submit_updateProduct' value='Cập nhật'>
                        </form>
                        <a href='./manage_account.php?id_active=3'><i style='font-size: 25px' class='fas fa-times icon_close'></i></a>
                    </div>
                </div>
            <?php
            }

        }
        if(isset($_POST['submit_updateProduct'])){
            $nameProduct_news = $_POST['nameProduct_news'];
            $priceProduct_news = $_POST['priceProduct_news'];

            $typeProduct_news = $_POST['typeProduct_news'];
            $numberProduct_news = $_POST['numberProduct_news'];
            $typeSoneProduct_news = $_POST['typeSoneProduct_news'];
            $destinyProduct_news = $_POST['destinyProduct_news'];

            if($_FILES['imgProduct_news']['size'] == 0 || $_FILES['imgProduct_news']['error'] > 0 ){
                $imgProduct_news = $_POST['imgProduct_old'];
            }
            else{
                $img_Product = $_FILES['imgProduct_news'];
                $imgProduct_news = $img_Product['name'];
                if($typeProduct_news == "Mới nhất"){
                    move_uploaded_file($img_Product['tmp_name'],'../img/img-sp/Mới nhất/'.$imgProduct_news);
                }
                else{
                    move_uploaded_file($img_Product['tmp_name'],'../img/img-sp/Thời trang/'.$imgProduct_news);
                }
            }

            $update_product = "UPDATE `sanpham`
                                SET `tenSP` = '$nameProduct_news', `gia` = '$priceProduct_news',`soLuong` = '$numberProduct_news', `loaiSP` = '$typeProduct_news',
                                    `loaiDa` = '$typeSoneProduct_news',`menh` = '$destinyProduct_news', `anhSP` = '$imgProduct_news'
                                WHERE `maSP` ='$id_product' ";
            $result_update = $conn->query($update_product);
            if($result_update == TRUE){
                echo "<script> alert('Cập nhật sản phẩm thành công');
                window.location.href='./manage_account.php?id_active=3'; </script>";
            }
            else{
                echo "<script> alert('Lỗi cập nhật. Vui lòng thử lại!!'); </script>";
            }
        }
        // Blog Web
        // Form Add Blog
        if(isset($_POST['formAdd_BlogWeb'])){
            ?>
                <div class="form_onTop">
                    <div class="overlay"></div>
                    <div class="layout layout_addBlogWeb">
                        <form enctype="multipart/form-data" action="" method='post' class='formAdd_BlogWeb'>
                            <h1>Tạo blog mới</h1>
                            <p>Tiêu đề</p>
                            <input type="text" required name='titleBlog_insert' placeholder="Tạo tiêu đề cho blog">
                            <p>Link ảnh</p>
                            <input style='background-color:white' type="file" required name='linkImgBlog_insert'>
                            <p>Link blog</p>
                            <input type="text" required name='linkBlog_insert' placeholder="Nhập link cho blog">
                            <p>Trạng Thái</p>
                            <input required type='text' name='statusBlog_insert'  placeholder="Nhập trạng thái blog">
                            <input type='submit' class='submit_addBlog' name='submitAdd_blogWeb' value='Thêm blog'>
                            <a href='./manage_account.php?id_active=4'><i style='font-size: 23px' class='fas fa-times icon_close'></i></a>
                        </form>
                    </div>
                </div>
            <?php
        }
        // submit add blog
        if(isset($_POST['submitAdd_blogWeb'])) {
            $tieuDe = $_POST['titleBlog_insert'];
            $linkBlog = $_POST['linkBlog_insert'];
            $trangThai = $_POST['statusBlog_insert'];

            $img_Product = $_FILES['linkImgBlog_insert'];
            $linkAnh = $img_Product['name'];
            move_uploaded_file($img_Product['tmp_name'],'../img/img-blog/'.$linkAnh);


            $additional = "INSERT INTO blogweb(tieuDe,linkAnh,linkBlog,trangThai) VALUES ('$tieuDe', '$linkAnh','$linkBlog', '$trangThai')";

            if(mysqli_query($conn, $additional)){
                    echo " <script> alert ('Thêm Blog thành công');";
                    echo "window.location.href='./manage_account.php?id_active=4' </script>";
                }
        }
        // Script Product add or update
        if(isset($_GET['addProduct']) || isset($_GET['update_product'])){
            ?>
                <script>
                    document.addEventListener('DOMContentLoaded',function(){
                        var btn_addProduct = document.querySelector('.btnFormProduct');
                        var price_product = document.querySelector('.checkPrice_product');
                        var number_product = document.querySelector('.checkNumber_product');
                        var name_product = document.querySelector('.checkName_product');
                        function checkForm_addProduct(){
                            btn_addProduct.disabled = true;
                            price_product.onchange = function(){
                                if(price_product.value <= 1000){
                                    price_product.style.border = '1.5px solid red';
                                    alert('Giá sản phẩm phải lớn hơn 1000');
                                }
                                else{
                                    price_product.style.border = 'none';
                                }
                            }
                            name_product.onchange = function(){
                                if(name_product.value.length < 8){
                                    name_product.style.border = '1.5px solid red';
                                    alert('Tên sản phẩm phải chứa ít nhất 8 kí tự');
                                }
                                else{
                                    name_product.style.border = 'none';
                                }
                            }
                            number_product.onchange = function(){
                                if(number_product.value <= 1){
                                    number_product.style.border = '1.5px solid red';
                                    alert('Số lượng sản phẩm thêm vào phải lớn hơn 1');
                                }
                                else{
                                    number_product.style.border = 'none';
                                }
                            }
                            if(price_product.value >1000 && name_product.value.length>= 8 && number_product.value >1){
                                btn_addProduct.disabled = false;
                            }
                        }
                        document.querySelector('.formProduct_AddorUpdate').onkeyup = checkForm_addProduct;
                    });
                </script>
            <?php
        }
    ?>
</body>
</html>
