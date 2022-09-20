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
                        echo "<h2>Tên sản phẩm: {$rowInfoPage_product['tenSP']}</h2>";
                        echo "<p>Mã sản phẩm: SP00584-sp-{$rowInfoPage_product['maSP']}</p>";
                        echo "<p>Dòng sản phẩm: {$rowInfoPage_product['loaiSP']}</p>";
                        echo "<p>Mệnh phù hợp: {$rowInfoPage_product['menh']}</p>";
                        echo "<p>Đơn giá: {$rowInfoPage_product['gia']} VNĐ</p>";
                        echo "<p>Thành tiền: <span id='show_price'>{$rowInfoPage_product['gia']} VNĐ</span></p>";

                        echo "<div class='add-cart col-11'>";
                            echo "<div class='number-pcs'>";
                                echo "<p>Số lượng</p>";
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
                                echo "<input type='submit' name='add_cart' value='Thêm vào giỏ hàng'>";
                            echo "</div>";
                        echo "</div>";

                        echo "<div class='add-collect'>";
                            echo "<div class='addCart'>";
                                echo "<input type='submit'style='padding:10px 20px; font-size: 1.7rem;' name='addCollect' value='Thêm vào bộ sưu tập'>";
                            echo "</div>";
                            if(isset($_POST['addCollect'])) {
                                echo "<div class='form-add'>";
                                    echo "<input type='text' class='input_nameCollect' required name='tenBST' placeholder='Nhập tên bộ sưu tập'>";
                                    echo "<input type='text' style='display:none' name='id_taiKhoan' value='{$ID_userPage}'>";
                                    echo "<input type='text' style='display:none' name='id_sanPham' value='{$maSP}'>";
                                    echo "<input type='submit' class='submit_form' name='add_itemCollection' value='Thêm'>";
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
                <p class="tab_details-heading heading_active">Chi tiết sản phẩm</p>
                <p class="tab_details-heading ">Chi tiết giao hàng</p>
            </div>
            <div class="container_center-content">
                <div class="tab_details-content content_active">
                    <div class="details_contentLeft col-5">
                        <div class="details_contentItems">
                            <h4>Sơ lược:</h4>
                            <p>Đây là sự kết tinh của các nguồn sức mạnh trong vũ trụ. Được chế tác bởi những người thợ tài hoa của Mia, tinh thể này sở hữu vẻ ngoài ấn tượng. Gam màu hồng nhẹ nhàng, quyến rũ. Chiếc vòng ại diện cho sự đồng cảm và thấu hiểu trong tình yêu. Kết hợp cùng những viên tròn óng ánh ngụ ý cho sự viên mãn và trọn vẹn. Từ đó tạo nên chuỗi vòng phong thủy với nguồn năng lượng tích cực và dồi dào. </p>
                        </div>
                        <div class="details_contentItems">
                            <h4>Bảo quản</h4>
                            <ul class="menu-content">
                                <li>Tránh xịt nước hoa hoặc keo cứng tóc lên vòng tay</li>
                                <li>Luôn cởi vòng tay khi tập thể thao hoặc làm việc nặng nhọc</li>
                                <li>Bảo quản riêng, không chung đụng với các loại trang sức đá quý khác</li>
                                <li>Bọc bằng vải mềm, và cho vào hộp</li>
                            </ul>
                        </div>
                    </div>
                    <div class="details_contentRight col-6">
                        <div class="details_contentItems">
                            <h4>Tác dụng tinh thần</h4>
                            <ul class="menu-content">
                                <li>Là một món quà của tình yêu và gắn liền với sự vĩnh hằng.</li>
                                <li>Được mọi người mang theo bên mình như một lá bùa bảo vệ</li>
                                <li>Chữa trầm cảm, bảo vệ con người chống lại những giấc mơ xấu .</li>
                                <li>Giúp giải thoát nỗi buồn và sự u sầu.</li>
                            </ul>
                        </div>
                        <div class="details_contentItems">
                            <h4>Tác dụng sức khỏe</h4>
                            <ul class="menu-content">
                                <li> Tác dụng tích cực đối với hệ tiêu hoá, hệ hô hấp, tuần hoàn và hệ thống miễn dịch</li>
                                <li>Tác động tích cực tới luân xa số 1 giúp chủ nhân cảm thấy khỏe khoắn, tỉnh táo và tràn đầy sinh lực.</li>
                                <li>Giúp người phụ nữ đang mang thai có tâm trạng thoải mái, chống bị trầm cảm và dễ sinh nở hơn</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab_details-content ">
                    <div class="details_contentLeft col-5">
                        <div class="details_contentItems">
                            <h4>Chính sách giao hàng</h4>
                            <ul class="menu-content">
                                <li>Nội thành: Giao từ 1 đến 3 ngày; Miễn phí giao hàng trong bán kính 10km</li>
                                <li>Tỉnh khác: Giao từ 5 đến 7 ngày; 30.000 VNĐ / đơn</li>
                                <li>Lưu ý: Thời gian nhận hàng có thể thay đổi sớm hoặc muộn hơn tùy theo địa chỉ cụ thể của khách hàng.</li>
                                <li>Trong trường hợp sản phầm tạm hết hàng, nhân viên CSKH sẽ liên hệ trực tiếp với quý khách để thông báo về thời gian giao hàng.</li>
                                <li>Nếu khách hàng có yêu cầu về Giấy Kiểm Định Đá, đơn hàng sễ cộng thêm 20 ngày để hoàn thành thủ tục.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="details_contentRight col-6">
                        <div class="details_contentItems">
                            <h4>Chính sách hoàn trả</h4>
                            <ul class="menu-content">
                                <li>Chúng tôi chấp nhận đổi / trả sản phẩm ngay lúc khách kiểm tra và xác nhận hàng hóa.</li>
                                <li>Chúng tôi cam kết sẽ hỗ trợ và áp dụng chính sách bảo hành tốt nhất tới Quý khách, đảm bảo mọi quyền lợi Quý khách được đầy đủ.</li>
                                <li>Những trình trạng bể, vỡ do quá trình quý khách sử dụng chúng tôi xin từ chối đổi hàng.</li>
                                <li>Tùy vào tình hình thực tế của sản phẩm , chúng tôi sẽ cân nhắc hỗ trợ đổi / trả nếu sản phẩm lỗi hoặc các vấn đề liên quan khác.</li>
                                <li>Chúng tôi nhận bảo hành dây đeo vĩnh viễn dành cho khách hàng nếu tình trạng dây lâu ngày bị giãn nở, cọ sát vớt đá gây đứt dây trong quá trình sử dụng, chi phí vận chuyển xin quý khách vui lòng tự thanh toán.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container_bottom feedback">
            <div class="title_feedback">
                <h2>Đánh giá sản phẩm</h2>
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
                        echo "<p class='ratio_star'><span class='number_star'>{$ratio_feedback}</span> trên 5</p>";
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
                    <label for="star_all">Tất cả</label>
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
                                        echo "<a href='./Manage User/delete_feedback.php?id_fb={$row_showAllFeedback['ID_FB']}&id={$maSP}&loai={$loaiSP}'><p class='menu_remove'>Xóa</p></a>";
                                        echo "<a href='./details.php?id_fb={$row_showAllFeedback['ID_FB']}&id={$maSP}&loai={$loaiSP}&updateFeedback'><p class='menu_edit'>Sửa</p></a>";
                                    }
                                    else{
                                        echo "<a href=''><p class='menu_report'>Báo cáo</p></a>";
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
                        echo "<h1 class='notification_feedback'>Chưa có đánh giá nào</h1>";
                    }
                ?>
            </div>
        </div>
    </div>

    <?php
        }
        if(isset($_POST['add_cart'])){
            if(!isset($userName)){
                echo "<script> alert('Vui lòng đăng nhập để mua sản phẩm'); </script>";
            }
            else{
                $donGia = $_POST['donGia'];
                $soLuong = $_POST['number_insert'];
                $thanhTien = $_POST['getOutMoney'];
                $idProduct =$_POST['maSP'];
                $idUser = $_POST['idUser'];

                $insert_cart = "INSERT INTO giohang (donGia,soLuong,thanhTien,ID_TaiKhoan,ID_SanPham,trangThai)
                VALUES ('$donGia','$soLuong','$thanhTien','$idUser','$idProduct','Chưa thanh toán')"   ;
                $result_insert = $conn->query($insert_cart);
                if($result_insert == TRUE){
                    echo "<script> alert('Thêm vào giỏ hàng thành công'); </script>";
                }
                else{
                    echo "<script> alert('Vui lòng thử lại...'); </script>";
                }
            }
        }
        require_once "../Main/footer.php";
        require_once "../Main/form.php";

        //add item collection
        if(isset($_POST['add_itemCollection'])) {
            if(!isset($userName)) {
                echo "<script> alert('Vui lòng đăng nhập để thực hiện thao tác này'); </script>";
            }
            else {
                $all_collect = "SELECT COUNT(*) as demSP FROM bosuutap WHERE ID_SanPham = '$maSP' and ID_TaiKhoan = '$ID_userPage'";
                $result = $conn->query($all_collect);
                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if($row['demSP'] >= 1) {
                        echo "<script>alert(` Sản phẩm này đã có trong BST của bạn`);
                                location.href='./manage_account.php?id_active=4'</script>";
                    }
                    else {
                        $tenBST = $_POST['tenBST'];
                        $ID_TaiKhoan = $_POST['id_taiKhoan'];
                        $ID_SanPham = $_POST['id_sanPham'];

                        $sql_addCollect = "INSERT INTO bosuutap(tenBST, ID_TaiKhoan, ID_SanPham) VALUES ('$tenBST', '$ID_TaiKhoan', '$ID_SanPham')";
                        $result_addCollect = $conn->query($sql_addCollect);
                        if($result_addCollect == TRUE) {
                            echo "<script>alert(` Thêm thành công`);</script>";
                        }
                        else {
                            echo "<script>alert(` Lỗi khi thêm, vui lòng thử lại`);</script>";
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
                                span_textContent.innerHTML = 'Đánh giá với độ dài tối thiểu 20 ký tự!!!';
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
                    //  arr = [thẻ div1, thẻ divr2]
                    const sendStar_feedback = document.querySelector('.star_sendFeedback');
                    const sendContent_feedback = document.querySelector('.textContent_sendFeedback');

                    var star_yes = "<i class='fas fa-star'></i>";
                    var star_no = "<i class='far fa-star'></i>";
                    item_star.forEach((item,index) => {
                        item.onclick = function(){
                            sendStar_feedback.value = index+1;
                            for(var i = 0; i<5 ;i++){
                                // click vào ngôi sao thứ 2 thì index  = 1

                                // nếu i nhỏ hơn index thì inner sao trắng
                                if(i > index){
                                    item_star[i].innerHTML = star_no;
                                }
                                // nếu i nhỏ hơn index thì inner sao đỏ
                                else{
                                    item_star[i].innerHTML = star_yes;
                                }
                            }
                            if(sendStar_feedback.value < 4){
                                sendContent_feedback.setAttribute("placeholder","Hãy chia sẻ những điều bạn chưa hài lòng về sản phẩm này nhé!");
                            }
                            else{
                                sendContent_feedback.setAttribute("placeholder","Hãy chia sẻ những gì bạn thích về sản phẩm này nhé!");
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
                echo "<script>alert(`Vui lòng đăng nhập để thực hiện thao tác này`);</script>";
            }
            else {
                $all_feedback = "SELECT COUNT(*) as demFb FROM phanhoi WHERE ID_SanPham = '$maSP' and ID_TaiKhoan = '$ID_userPage'";
                $result_feedback = $conn->query($all_feedback);
                if($result_feedback ->num_rows > 0) {
                    $row = $result_feedback->fetch_assoc();
                    if($row['demFb'] >= 1) {
                        echo "<script>alert(` Bạn đã đánh giá sản phẩm này!`);
                                location.href='./manage_account.php?id_active=3'</script>";
                    }
                    else {
                ?>
                <div class="form_onTop">
                    <div class="overlay"></div>
                    <div class="layout">
                        <form action="./details.php?id=<?php echo "{$maSP}&loai={$loaiSP}";?>" method="post" class="form_createFeedback">
                            <h1 class="title_createFeedback">Đánh giá sản phẩm</h1>
                            <div class="infoAll_product">
                                <?php
                                    echo "<div class='infoProduct_img'>";
                                        echo "<img src='../img/img-sp/{$loaiSP}/{$rowInfoPage_product['anhSP']}' alt=''>";
                                    echo "</div>";
                                    echo "<div class='infoProduct_content'>";
                                        echo "<p><b>{$rowInfoPage_product['tenSP']}</b></p>";
                                        echo "<p>Phân loại: {$rowInfoPage_product['loaiSP']}</p>";
                                        echo "<p>Mệnh phù hợp: {$rowInfoPage_product['menh']}</p>";
                                        echo "<input type='text' class='input_none' name='Id_taiKhoan' value={$ID_userPage}>";
                                        echo "<input type='text' class='input_none' name='Id_sanPham' value={$maSP}>";
                                    echo "</div>";
                                ?>
                            </div>
                            <div class="send_feedback">
                                <div class="send_starFeedback">
                                    <p class='contentStar_feedback'>Vui lòng đánh giá mức độ hài lòng của bạn:</p>
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
                                <textarea name="send_contentFeedback" required class="textContent_sendFeedback" cols="50" rows="8" placeholder="Hãy để lại những đánh giá cho sản phẩm này nhé"></textarea>
                            </div>
                            <span id="span_textContent" style="font-size:1.7rem; margin-bottom:10px;"></span>
                            <input type="submit" name='submit_sendFeedback' class='submit_sendFeedback' value='Gửi đánh giá'>
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
                echo "<script>alert(` Bạn đã gửi đánh giá thành công`);
                      location.href='./details.php?id={$maSP}&loai={$loaiSP}';</script>";
            }
            else {
                echo "<script>alert(` Lỗi khi gửi, vui lòng thử lại`);</script>";
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
                        <h1 class="title_createFeedback">Cập nhật đánh giá của bạn</h1>
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
                            <textarea name="update_contentFeedback" class="textContent_sendFeedback" cols="50" rows="8" value='<?php echo $row['noiDung']; ?>' placeholder="Hãy để lại những đánh giá cho sản phẩm này nhé"><?php echo $row['noiDung']; ?></textarea>
                        </div>
                        <span id="span_textContent" style="font-size:1.7rem; margin-bottom:10px;"></span>
                        <input type="submit" name='submit_updateFeedback' class='submit_sendFeedback' value='Cập nhật'>
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
                echo "<script>alert(` Cập nhật thành công`);
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
                    alert('Vui lòng chọn ít nhất một sản phẩm');
                }
                else{
                    --document.querySelector("#number").value;
                    resultMoney = document.querySelector("#number").value*money;
                    document.querySelector("#show_price").innerHTML = `${resultMoney} VNĐ`;
                }
            }
            else{
                if(document.querySelector('#number').value == document.querySelector('#number').getAttribute('max')){
                    resultMoney = document.querySelector("#number").value*money;
                    document.querySelector("#show_price").innerHTML = `${resultMoney} VNĐ`;
                    alert('Số lượng sản phẩm đã tối đa');
                }
                else{
                    ++document.querySelector("#number").value;
                    resultMoney = document.querySelector("#number").value*money;
                    document.querySelector("#show_price").innerHTML = `${resultMoney} VNĐ`;
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
