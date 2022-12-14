<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';
    session_start();
    if(isset($_SESSION['user'])){
        $userName =  $_SESSION['user'];
        $sql_getInfoPage = "SELECT * FROM taikhoan WHERE tenTK = '$userName'";
        $result_getInfoPage = $conn->query($sql_getInfoPage);
        if($result_getInfoPage->num_rows>0){
            $row_getInfoPage = $result_getInfoPage->fetch_assoc();
            $ID_userPage = $row_getInfoPage['ID'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../img/logo_web.jpg"/>
    <title>Wabisi Mia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel ='stylesheet' href="../css/CSS_allPage.css">
    <link rel="stylesheet" href="../css/csS_details.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/slick.js"></script>
    <style>


    </style>
</head>
<body>

    <?php
        require_once "../Main/header.php";
    ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <?php
        $maSP = $_GET['id'];
        $loaiSP = $_GET['loai'];
        $info_product = "SELECT * FROM sanpham WHERE maSP = '$maSP'";
        $result_info = $conn->query($info_product);
        if($result_info->num_rows>0){
            $rowInfoPage_product = $result_info->fetch_assoc();
    ?>

    <div id="container">
        <div class="container_top">
            <div class="container_top-section col-5">
                <div class="img_product col-12">
                    <?php
                        echo "<img src='../img/img-sp/{$loaiSP}/{$rowInfoPage_product['anhSP']}' alt='' >";
                        echo "<img src='../img/img-sp/{$loaiSP}/{$rowInfoPage_product['anhSP']}' alt='' >";
                    ?>
                </div>
            </div>
            <div class="container_top-aside col-6">
                <div class="allInfo_Product col-12">
                    <?php
                    echo "<form method='post'>";
                        echo "<h2>T??n s???n ph???m: {$rowInfoPage_product['tenSP']}</h2>";
                        echo "<p>M?? s???n ph???m: SP00584-sp-{$rowInfoPage_product['maSP']}</p>";
                        echo "<p>D??ng s???n ph???m: {$rowInfoPage_product['loaiSP']}</p>";
                        echo "<p>M???nh ph?? h???p: {$rowInfoPage_product['menh']}</p>";
                        echo "<p>????n gi??: {$rowInfoPage_product['gia']} VN??</p>";
                        echo "<p>Th??nh ti???n: <span id='show_price'>{$rowInfoPage_product['gia']} VN??</span></p>";

                        echo "<div class='add-cart col-11'>";
                            echo "<div class='number-pcs'>";
                                echo "<p>S??? l?????ng</p>";
                                echo "<input type='button' onclick='edit_number_cart(this.id)' id='tru' value='&#8722;' class='up-down_cart'>";
                                echo "<input type='number'  id='number' value='1' min='1' max ='{$rowInfoPage_product['soLuong']}' disabled>";
                                echo "<input type='button' onclick='edit_number_cart(this.id)' id='cong' value='&#43;' class='up-down_cart'>";
                            echo "</div>";

                            echo "<input type='text' style='display:none' name='donGia' id='getMoney' value ={$rowInfoPage_product['gia']}>";
                            echo "<input type='text' style='display: none' name='number_insert' id='getNumber_insert'>";
                            echo "<input type ='text' style='display:none' id='getOutMoney' value='{$rowInfoPage_product['gia']}' name='getOutMoney'>";
                            echo "<input type ='text' style='display:none' value='{$rowInfoPage_product['maSP']}' name='maSP'>";
                            if(isset($userName)){
                                echo "<input type ='text' style='display:none' value='{$ID_userPage}' name='idUser'>";
                            }

                            echo "<div class='addCart'>";
                                echo "<input type='submit' name='add_cart' value='Th??m v??o gi??? h??ng'>";
                            echo "</div>";
                        echo "</div>";

                        echo "<div class='add-collect'>";
                            echo "<div class='addCart'>";
                                echo "<input type='submit'style='padding:10px 20px; font-size: 1.7rem;' name='addCollect' value='Th??m v??o b??? s??u t???p'>";
                            echo "</div>";
                            if(isset($_POST['addCollect'])) {
                                echo "<div class='form-add'>";
                                    echo "<input type='text' class='input_nameCollect' required name='tenBST' placeholder='Nh???p t??n b??? s??u t???p'>";
                                    echo "<input type='text' style='display:none' name='id_taiKhoan' value='{$ID_userPage}'>";
                                    echo "<input type='text' style='display:none' name='id_sanPham' value='{$maSP}'>";
                                    echo "<input type='submit' class='submit_form' name='add_itemCollection' value='Th??m'>";
                                echo "</div>";
                            }
                        echo "</div>";
                    echo "</form>";
                    ?>
                </div>
            </div>
        </div>
        <div class="container_center">
            <div class="container_center-tab">
                <p class="tab_details-heading heading_active">Chi ti???t s???n ph???m</p>
                <p class="tab_details-heading ">Chi ti???t giao h??ng</p>
            </div>
            <div class="container_center-content">
                <div class="tab_details-content content_active">
                    <div class="details_contentLeft col-5">
                        <div class="details_contentItems">
                            <h4>S?? l?????c:</h4>
                            <p>????y l?? s??? k???t tinh c???a c??c ngu???n s???c m???nh trong v?? tr???. ???????c ch??? t??c b???i nh???ng ng?????i th??? t??i hoa c???a Mia, tinh th??? n??y s??? h???u v??? ngo??i ???n t?????ng. Gam m??u h???ng nh??? nh??ng, quy???n r??. Chi???c v??ng ???i di???n cho s??? ?????ng c???m v?? th???u hi???u trong t??nh y??u. K???t h???p c??ng nh???ng vi??n tr??n ??ng ??nh ng??? ?? cho s??? vi??n m??n v?? tr???n v???n. T??? ???? t???o n??n chu???i v??ng phong th???y v???i ngu???n n??ng l?????ng t??ch c???c v?? d???i d??o. </p>
                        </div>
                        <div class="details_contentItems">
                            <h4>B???o qu???n</h4>
                            <ul class="menu-content">
                                <li>Tr??nh x???t n?????c hoa ho???c keo c???ng t??c l??n v??ng tay</li>
                                <li>Lu??n c???i v??ng tay khi t???p th??? thao ho???c l??m vi???c n???ng nh???c</li>
                                <li>B???o qu???n ri??ng, kh??ng chung ?????ng v???i c??c lo???i trang s???c ???? qu?? kh??c</li>
                                <li>B???c b???ng v???i m???m, v?? cho v??o h???p</li>
                            </ul>
                        </div>
                    </div>
                    <div class="details_contentRight col-6">
                        <div class="details_contentItems">
                            <h4>T??c d???ng tinh th???n</h4>
                            <ul class="menu-content">
                                <li>L?? m???t m??n qu?? c???a t??nh y??u v?? g???n li???n v???i s??? v??nh h???ng.</li>
                                <li>???????c m???i ng?????i mang theo b??n m??nh nh?? m???t l?? b??a b???o v???</li>
                                <li>Ch???a tr???m c???m, b???o v??? con ng?????i ch???ng l???i nh???ng gi???c m?? x???u .</li>
                                <li>Gi??p gi???i tho??t n???i bu???n v?? s??? u s???u.</li>
                            </ul>
                        </div>
                        <div class="details_contentItems">
                            <h4>T??c d???ng s???c kh???e</h4>
                            <ul class="menu-content">
                                <li> T??c d???ng t??ch c???c ?????i v???i h??? ti??u ho??, h??? h?? h???p, tu???n ho??n v?? h??? th???ng mi???n d???ch</li>
                                <li>T??c ?????ng t??ch c???c t???i lu??n xa s??? 1 gi??p ch??? nh??n c???m th???y kh???e kho???n, t???nh t??o v?? tr??n ?????y sinh l???c.</li>
                                <li>Gi??p ng?????i ph??? n??? ??ang mang thai c?? t??m tr???ng tho???i m??i, ch???ng b??? tr???m c???m v?? d??? sinh n??? h??n</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab_details-content ">
                    <div class="details_contentLeft col-5">
                        <div class="details_contentItems">
                            <h4>Ch??nh s??ch giao h??ng</h4>
                            <ul class="menu-content">
                                <li>N???i th??nh: Giao t??? 1 ?????n 3 ng??y; Mi???n ph?? giao h??ng trong b??n k??nh 10km</li>
                                <li>T???nh kh??c: Giao t??? 5 ?????n 7 ng??y; 30.000 VN?? / ????n</li>
                                <li>L??u ??: Th???i gian nh???n h??ng c?? th??? thay ?????i s???m ho???c mu???n h??n t??y theo ?????a ch??? c??? th??? c???a kh??ch h??ng.</li>
                                <li>Trong tr?????ng h???p s???n ph???m t???m h???t h??ng, nh??n vi??n CSKH s??? li??n h??? tr???c ti???p v???i qu?? kh??ch ????? th??ng b??o v??? th???i gian giao h??ng.</li>
                                <li>N???u kh??ch h??ng c?? y??u c???u v??? Gi???y Ki???m ?????nh ????, ????n h??ng s??? c???ng th??m 20 ng??y ????? ho??n th??nh th??? t???c.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="details_contentRight col-6">
                        <div class="details_contentItems">
                            <h4>Ch??nh s??ch ho??n tr???</h4>
                            <ul class="menu-content">
                                <li>Ch??ng t??i ch???p nh???n ?????i / tr??? s???n ph???m ngay l??c kh??ch ki???m tra v?? x??c nh???n h??ng h??a.</li>
                                <li>Ch??ng t??i cam k???t s??? h??? tr??? v?? ??p d???ng ch??nh s??ch b???o h??nh t???t nh???t t???i Qu?? kh??ch, ?????m b???o m???i quy???n l???i Qu?? kh??ch ???????c ?????y ?????.</li>
                                <li>Nh???ng tr??nh tr???ng b???, v??? do qu?? tr??nh qu?? kh??ch s??? d???ng ch??ng t??i xin t??? ch???i ?????i h??ng.</li>
                                <li>T??y v??o t??nh h??nh th???c t??? c???a s???n ph???m , ch??ng t??i s??? c??n nh???c h??? tr??? ?????i / tr??? n???u s???n ph???m l???i ho???c c??c v???n ????? li??n quan kh??c.</li>
                                <li>Ch??ng t??i nh???n b???o h??nh d??y ??eo v??nh vi???n d??nh cho kh??ch h??ng n???u t??nh tr???ng d??y l??u ng??y b??? gi??n n???, c??? s??t v???t ???? g??y ?????t d??y trong qu?? tr??nh s??? d???ng, chi ph?? v???n chuy???n xin qu?? kh??ch vui l??ng t??? thanh to??n.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container_bottom feedback">
            <div class="title_feedback">
                <h2>????nh gi?? s???n ph???m</h2>
            </div>
            <div class="avg_starAll">
                <div class="show_starAvg">
                    <?php
                        $sql_ratioFeedback = "SELECT AVG(`danhGia`) as ratio FROM phanhoi WHERE ID_SanPham = '{$maSP}'";
                        $result_ratioFeedback = $conn->query($sql_ratioFeedback);
                        if($result_ratioFeedback -> num_rows>0){
                            $row_ratioFeedback = $result_ratioFeedback->fetch_assoc();
                            $ratio_feedback = round($row_ratioFeedback['ratio'],1);
                        }
                        echo "<p class='ratio_star'><span class='number_star'>{$ratio_feedback}</span> tr??n 5</p>";
                    ?>
                    <p class="icon_Star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </p>
                </div>
                <form method='post' class="show_chooseStar">
                    <label for="star_all">T???t c???</label>
                    <label for="star_5">5 sao</label>
                    <label for="star_4">4 sao</label>
                    <label for="star_3">3 sao</label>
                    <label for="star_2">2 sao</label>
                    <label for="star_1">1 sao</label>

                    <input type="submit" class='input_none' id='star_all' name='submit_selectiveStar' value='all'>
                    <input type="submit" class='input_none' id='star_5' name='submit_selectiveStar' value='5'>
                    <input type="submit" class='input_none' id='star_4' name='submit_selectiveStar' value='4'>
                    <input type="submit" class='input_none' id='star_3' name='submit_selectiveStar' value='3'>
                    <input type="submit" class='input_none' id='star_2' name='submit_selectiveStar' value='2'>
                    <input type="submit" class='input_none' id='star_1' name='submit_selectiveStar' value='1'>
                </form>
            </div>
            <div class='all_feedback'>
                <?php
                    if(isset($_POST['submit_selectiveStar']) && $_POST['submit_selectiveStar'] != 'all') {
                        $evaluate = $_POST['submit_selectiveStar'];
                        $sql_showAllFeedback = "SELECT *, phanhoi.ngayTao as ngayDanhGia FROM phanhoi, taikhoan, sanpham
                                                WHERE ID_TaiKhoan = taikhoan.ID and (ID_SanPham = '{$maSP}' and phanhoi.ID_SanPham = sanpham.maSP)
                                                and danhGia = '$evaluate'";
                    }
                    else {
                        $sql_showAllFeedback = "SELECT *, phanhoi.ngayTao as ngayDanhGia FROM phanhoi, taikhoan, sanpham
                                                WHERE ID_TaiKhoan = taikhoan.ID and (ID_SanPham = '{$maSP}' and phanhoi.ID_SanPham = sanpham.maSP)";
                    }
                    $result_showAllFeedback = $conn->query($sql_showAllFeedback);
                    if($result_showAllFeedback ->num_rows>0){
                        $count_itemFeedback = 0;
                        while($row_showAllFeedback = $result_showAllFeedback->fetch_assoc()){
                            $count_itemFeedback += 1;
                            echo "<div class='item_userFeedback'>";
                                echo "<div class='info_userFeedback'>";
                                    echo "<div class='infoUser_avatar'>";
                                        echo "<img src='../img/img-avatar/{$row_showAllFeedback['avatar']}' alt=''>";
                                    echo "</div>";
                                    echo "<div class='infoUser_name-evaluate '>";
                                        echo "<p class='infoUser_name'>{$row_showAllFeedback['tenTK']}</p>";
                                        echo "<p class='evaluate_star infoUser_evaluate_{$count_itemFeedback}' name='number_Star'></p>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class='content_userFeedback'>";
                                    echo "<p class='content_feedback'>{$row_showAllFeedback['noiDung']}</p>";
                                    echo "<p class='time_feedback'>{$row_showAllFeedback['ngayDanhGia']}</p>";
                                echo "</div>";
                                echo "<div class='menu_contentFeedback count_menuFeedback_{$count_itemFeedback}'>";
                                    echo "<i style='font-size: 1.5rem' class='fas fa-ellipsis-v'></i>";
                                    echo "<div class='item_menuFeedback count_botsFeedback_{$count_itemFeedback}'>";
                                    if(isset($userName) && $userName == $row_showAllFeedback['tenTK']){
                                        echo "<a href='./Manage User/delete_feedback.php?id_fb={$row_showAllFeedback['ID_FB']}&id={$maSP}&loai={$loaiSP}'><p class='menu_remove'>X??a</p></a>";
                                        echo "<a href='./details.php?id_fb={$row_showAllFeedback['ID_FB']}&id={$maSP}&loai={$loaiSP}&updateFeedback'><p class='menu_edit'>S???a</p></a>";
                                    }
                                    else{
                                        echo "<a href=''><p class='menu_report'>B??o c??o</p></a>";
                                    }
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                            ?>
                                <script>
                                    var count_clickBotFeedback = 0;
                                    document.querySelector('.count_menuFeedback_<?php echo $count_itemFeedback; ?>').onclick = function(){
                                        if(count_clickBotFeedback %2 == 0){
                                            document.querySelector('.item_menuFeedback.count_botsFeedback_<?php echo $count_itemFeedback; ?>').style.display = 'block';
                                            count_clickBotFeedback++;
                                        }
                                        else{
                                            document.querySelector('.item_menuFeedback.count_botsFeedback_<?php echo $count_itemFeedback; ?>').style.display = 'none';
                                            count_clickBotFeedback++;
                                        }
                                    }
                                    var numberStar = <?php  echo $row_showAllFeedback['danhGia']; ?>;
                                    var starY = "<i class='fas fa-star'></i>";
                                    var starN = "<i class='far fa-star'></i>";
                                    document.querySelector('.infoUser_evaluate_<?php echo $count_itemFeedback;?>').innerHTML = starY.repeat(numberStar).concat(starN.repeat(5-numberStar));
                                </script>
                            <?php
                        }
                    }
                    else{
                        echo "<h1 class='notification_feedback'>Ch??a c?? ????nh gi?? n??o</h1>";
                    }
                ?>
            </div>
        </div>
    </div>

    <?php
        }
        if(isset($_POST['add_cart'])){
            if(!isset($userName)){
                echo "<script> alert('Vui l??ng ????ng nh???p ????? mua s???n ph???m'); </script>";
            }
            else{
                $donGia = $_POST['donGia'];
                $soLuong = $_POST['number_insert'];
                $thanhTien = $_POST['getOutMoney'];
                $idProduct =$_POST['maSP'];
                $idUser = $_POST['idUser'];

                $insert_cart = "INSERT INTO giohang (donGia,soLuong,thanhTien,ID_TaiKhoan,ID_SanPham,trangThai)
                VALUES ('$donGia','$soLuong','$thanhTien','$idUser','$idProduct','Ch??a thanh to??n')"   ;
                $result_insert = $conn->query($insert_cart);
                if($result_insert == TRUE){
                    echo "<script> alert('Th??m v??o gi??? h??ng th??nh c??ng'); </script>";
                }
                else{
                    echo "<script> alert('Vui l??ng th??? l???i...'); </script>";
                }
            }
        }
        require_once "../Main/footer.php";
        require_once "../Main/form.php";

        //add item collection
        if(isset($_POST['add_itemCollection'])) {
            if(!isset($userName)) {
                echo "<script> alert('Vui l??ng ????ng nh???p ????? th???c hi???n thao t??c n??y'); </script>";
            }
            else {
                $all_collect = "SELECT COUNT(*) as demSP FROM bosuutap WHERE ID_SanPham = '$maSP' and ID_TaiKhoan = '$ID_userPage'";
                $result = $conn->query($all_collect);
                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if($row['demSP'] >= 1) {
                        echo "<script>alert(` S???n ph???m n??y ???? c?? trong BST c???a b???n`);
                                location.href='./manage_account.php?id_active=4'</script>";
                    }
                    else {
                        $tenBST = $_POST['tenBST'];
                        $ID_TaiKhoan = $_POST['id_taiKhoan'];
                        $ID_SanPham = $_POST['id_sanPham'];

                        $sql_addCollect = "INSERT INTO bosuutap(tenBST, ID_TaiKhoan, ID_SanPham) VALUES ('$tenBST', '$ID_TaiKhoan', '$ID_SanPham')";
                        $result_addCollect = $conn->query($sql_addCollect);
                        if($result_addCollect == TRUE) {
                            echo "<script>alert(` Th??m th??nh c??ng`);</script>";
                        }
                        else {
                            echo "<script>alert(` L???i khi th??m, vui l??ng th??? l???i`);</script>";
                        }
                    }
                }
            }
        }
        if(isset($_GET['createFeedback']) || isset($_GET['updateFeedback'])) {
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form_Feedback = document.querySelector('.form_createFeedback');
                    const btn_submitFeedback = document.querySelector('.submit_sendFeedback');
                    btn_submitFeedback.disabled = true;

                    function checkInputFeedback() {
                        const input_textContent = document.querySelector('.textContent_sendFeedback');
                        const span_textContent = document.querySelector('#span_textContent');
                        const starFeedback = document.querySelector('#starFeedback');
                        const span_starFeedback = document.querySelector('#span_starFeedback');

                        input_textContent.onchange = function() {
                            if(input_textContent.value.length < 20) {
                                span_textContent.innerHTML = '????nh gi?? v???i ????? d??i t???i thi???u 20 k?? t???!!!';
                                span_textContent.style.color = 'red';
                            }
                            else {
                                span_textContent.innerHTML = '';
                                btn_submitFeedback.disabled = false;
                            }
                        }
                    }
                    checkInputFeedback();
                    form_Feedback.onkeyup = checkInputFeedback;

                    // Selective
                    const item_star = document.querySelectorAll('.itemStar');
                    //  arr = [th??? div1, th??? divr2]
                    const sendStar_feedback = document.querySelector('.star_sendFeedback');
                    const sendContent_feedback = document.querySelector('.textContent_sendFeedback');

                    var star_yes = "<i class='fas fa-star'></i>";
                    var star_no = "<i class='far fa-star'></i>";
                    item_star.forEach((item,index) => {
                        item.onclick = function(){
                            sendStar_feedback.value = index+1;
                            for(var i = 0; i<5 ;i++){
                                // click v??o ng??i sao th??? 2 th?? index  = 1

                                // n???u i nh??? h??n index th?? inner sao tr???ng
                                if(i > index){
                                    item_star[i].innerHTML = star_no;
                                }
                                // n???u i nh??? h??n index th?? inner sao ?????
                                else{
                                    item_star[i].innerHTML = star_yes;
                                }
                            }
                            if(sendStar_feedback.value < 4){
                                sendContent_feedback.setAttribute("placeholder","H??y chia s??? nh???ng ??i???u b???n ch??a h??i l??ng v??? s???n ph???m n??y nh??!");
                            }
                            else{
                                sendContent_feedback.setAttribute("placeholder","H??y chia s??? nh???ng g?? b???n th??ch v??? s???n ph???m n??y nh??!");
                            }
                        }
                    });
                });
            </script>
            <?php
        }
        //feedback

        if(isset($_GET['createFeedback'])){
            if(!isset($userName)) {
                echo "<script>alert(`Vui l??ng ????ng nh???p ????? th???c hi???n thao t??c n??y`);</script>";
            }
            else {
                $all_feedback = "SELECT COUNT(*) as demFb FROM phanhoi WHERE ID_SanPham = '$maSP' and ID_TaiKhoan = '$ID_userPage'";
                $result_feedback = $conn->query($all_feedback);
                if($result_feedback ->num_rows > 0) {
                    $row = $result_feedback->fetch_assoc();
                    if($row['demFb'] >= 1) {
                        echo "<script>alert(` B???n ???? ????nh gi?? s???n ph???m n??y!`);
                                location.href='./manage_account.php?id_active=3'</script>";
                    }
                    else {
                ?>
                <div class="form_onTop">
                    <div class="overlay"></div>
                    <div class="layout">
                        <form action="./details.php?id=<?php echo "{$maSP}&loai={$loaiSP}";?>" method="post" class="form_createFeedback">
                            <h1 class="title_createFeedback">????nh gi?? s???n ph???m</h1>
                            <div class="infoAll_product">
                                <?php
                                    echo "<div class='infoProduct_img'>";
                                        echo "<img src='../img/img-sp/{$loaiSP}/{$rowInfoPage_product['anhSP']}' alt=''>";
                                    echo "</div>";
                                    echo "<div class='infoProduct_content'>";
                                        echo "<p><b>{$rowInfoPage_product['tenSP']}</b></p>";
                                        echo "<p>Ph??n lo???i: {$rowInfoPage_product['loaiSP']}</p>";
                                        echo "<p>M???nh ph?? h???p: {$rowInfoPage_product['menh']}</p>";
                                        echo "<input type='text' class='input_none' name='Id_taiKhoan' value={$ID_userPage}>";
                                        echo "<input type='text' class='input_none' name='Id_sanPham' value={$maSP}>";
                                    echo "</div>";
                                ?>
                            </div>
                            <div class="send_feedback">
                                <div class="send_starFeedback">
                                    <p class='contentStar_feedback'>Vui l??ng ????nh gi?? m???c ????? h??i l??ng c???a b???n:</p>
                                    <div class="allStar_feedback">
                                          <div class="itemStar">
                                              <i class='far fa-star'></i>
                                          </div>
                                          <div class="itemStar">
                                              <i class='far fa-star'></i>
                                          </div>
                                          <div class="itemStar">
                                              <i class='far fa-star'></i>
                                          </div>
                                          <div class="itemStar">
                                              <i class='far fa-star'></i>
                                          </div>
                                          <div class="itemStar">
                                              <i class='far fa-star'></i>
                                          </div>
                                      </div>
                                    <input type="text" class="input_none star_sendFeedback" name='send_starFeedback' value='0'>
                                </div>
                                <textarea name="send_contentFeedback" required class="textContent_sendFeedback" cols="50" rows="8" placeholder="H??y ????? l???i nh???ng ????nh gi?? cho s???n ph???m n??y nh??"></textarea>
                            </div>
                            <span id="span_textContent" style="font-size:1.7rem; margin-bottom:10px;"></span>
                            <input type="submit" name='submit_sendFeedback' class='submit_sendFeedback' value='G???i ????nh gi??'>
                            <?php
                                echo "<a href='./details.php?id={$maSP}&loai={$loaiSP}'><i style='font-size: 23px' class='fas fa-times icon_close'></i></a>";
                            ?>
                        </form>
                    </div>
                </div>
                <?php
                    }
                }
            }
        }
        //add feedback
        if(isset($_POST['submit_sendFeedback'])) {
            $danhGia = $_POST['send_starFeedback'];
            $noiDung = $_POST['send_contentFeedback'];
            $Id_taiKhoan = $_POST['Id_taiKhoan'];
            $Id_sanPham = $_POST['Id_sanPham'];
            $sql_addFeedback = "INSERT INTO phanhoi(noiDung, ID_TaiKhoan, ID_SanPham, danhGia) VALUES('$noiDung', '$Id_taiKhoan', '$Id_sanPham', '$danhGia')";
            $result_addFeedback = $conn->query($sql_addFeedback);
            if($result_addFeedback == TRUE) {
                echo "<script>alert(` B???n ???? g???i ????nh gi?? th??nh c??ng`);
                      location.href='./details.php?id={$maSP}&loai={$loaiSP}';</script>";
            }
            else {
                echo "<script>alert(` L???i khi g???i, vui l??ng th??? l???i`);</script>";
            }
        }
        //update feedback
        if(isset($_GET['updateFeedback'])) {
            $id_fb = $_GET['id_fb'];
            $sql = "SELECT * FROM phanhoi WHERE ID_FB = '$id_fb'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            ?>
            <div class="form_onTop">
                <div class="overlay"></div>
                <div class="layout">
                    <form action="./details.php?id=<?php echo "{$maSP}&loai={$loaiSP}";?>" method="post" class="form_createFeedback">
                        <h1 class="title_createFeedback">C???p nh???t ????nh gi?? c???a b???n</h1>
                        <div class="send_feedback">
                            <div class="send_starFeedback">
                                <div class="allStar_feedback">
                                <?php
                                    $starYes = $row['danhGia'];
                                    $starNo = 5 - $starYes;
                                    for($x = 0; $x<5; ) {
                                        if($x >= $starYes) {
                                            echo "<div class='itemStar'>
                                                    <i class='far fa-star'></i>
                                                  </div>";
                                        }
                                        else {
                                            echo "<div class='itemStar'>
                                                    <i class='fas fa-star'></i>
                                                  </div>";
                                        }
                                        $x = $x+1;
                                    }
                                ?>
                                </div>
                                <input type='text' class='input_none' name='ID_fb' value='<?php echo $id_fb;?>'>
                                <input type="text" class="input_none star_sendFeedback" name='update_starFeedback' value='<?php echo $row['danhGia'];?>'>
                            </div>
                            <textarea name="update_contentFeedback" class="textContent_sendFeedback" cols="50" rows="8" value='<?php echo $row['noiDung']; ?>' placeholder="H??y ????? l???i nh???ng ????nh gi?? cho s???n ph???m n??y nh??"><?php echo $row['noiDung']; ?></textarea>
                        </div>
                        <span id="span_textContent" style="font-size:1.7rem; margin-bottom:10px;"></span>
                        <input type="submit" name='submit_updateFeedback' class='submit_sendFeedback' value='C???p nh???t'>
                        <?php
                            echo "<a href='./details.php?id={$maSP}&loai={$loaiSP}'><i style='font-size: 23px' class='fas fa-times icon_close'></i></a>";
                        ?>
                    </form>
                </div>
            </div>
            <?php
            }
        }
        if(isset($_POST['submit_updateFeedback'])) {
            $ID_fb = $_POST['ID_fb'];
            $noi_dung = $_POST['update_contentFeedback'];
            $danh_gia = $_POST['update_starFeedback'];

            $sql_updateFeedback = "UPDATE phanhoi SET noiDung = '$noi_dung', danhGia = '$danh_gia' WHERE ID_FB = '$ID_fb'";
            $result_updateFeedback = $conn->query($sql_updateFeedback);
            if($result_updateFeedback == TRUE) {
                echo "<script>alert(` C???p nh???t th??nh c??ng`);
                      location.href='./details.php?id={$maSP}&loai={$loaiSP}';</script>";
            }
            else {
                echo "Error";
            }
        }
    ?>
    <script>
        function edit_number_cart(id){
            var money = document.querySelector('#getMoney').value;
            var resultMoney ;
            if(id == "tru"){
                if(document.querySelector('#number').value == 1){
                    alert('Vui l??ng ch???n ??t nh???t m???t s???n ph???m');
                }
                else{
                    --document.querySelector("#number").value;
                    resultMoney = document.querySelector("#number").value*money;
                    document.querySelector("#show_price").innerHTML = `${resultMoney} VN??`;
                }
            }
            else{
                if(document.querySelector('#number').value == document.querySelector('#number').getAttribute('max')){
                    resultMoney = document.querySelector("#number").value*money;
                    document.querySelector("#show_price").innerHTML = `${resultMoney} VN??`;
                    alert('S??? l?????ng s???n ph???m ???? t???i ??a');
                }
                else{
                    ++document.querySelector("#number").value;
                    resultMoney = document.querySelector("#number").value*money;
                    document.querySelector("#show_price").innerHTML = `${resultMoney} VN??`;
                }
            }
                document.querySelector('#getNumber_insert').value = document.querySelector('#number').value;
                document.querySelector('#getOutMoney').value = resultMoney;
        };
        document.addEventListener("DOMContentLoaded",function(){
            // Tab detail product
            document.querySelector('#getNumber_insert').value = document.querySelector('#number').value;
            const headings = document.querySelectorAll('.tab_details-heading');
            const contents = document.querySelectorAll('.tab_details-content');

            headings.forEach((heading,index)=> {
                var content_current = contents[index];
                heading.onclick = function(){
                    document.querySelector('.tab_details-heading.heading_active').classList.remove('heading_active');
                    document.querySelector('.tab_details-content.content_active').classList.remove('content_active');

                    this.classList.add('heading_active');
                    content_current.classList.add('content_active');
                }
            });
        });
    </script>
    

</body>
</html>
