<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';
    session_start();

    if(isset($_POST['submit_sign-up'])){
        $register_name = $_POST['register_name'];
        $register_password = $_POST['register_password'];
        $register_telephone = $_POST['register_telephone'];
        $register_address = $_POST['register_address'];
        $registerGender = $_POST['registerGender'];

        if($_FILES['register_avatar']['size'] == 0 ){
            if($registerGender == "Nam"){
                $register_avatar = 'default_avatar_male.jpg';
            }
            else{
                $register_avatar = 'default_avatar_female.jpg';
            }
        }
        else{
            $file = $_FILES['register_avatar'];
            $register_avatar = $file['name'];
            move_uploaded_file($file['tmp_name'],'./img/img-avatar/'.$register_avatar);
        }

        $all_user = "SELECT * FROM taikhoan";
        $result_user = $conn->query($all_user);
        if($result_user->num_rows>0){
            $check_sdt = 0;
            while($row = $result_user->fetch_assoc()){
                if($register_telephone == $row['SDT']){
                    $check_sdt+=1;
                    break;
                }
            }
            if($check_sdt > 0){
                echo "<script>
                        alert('Số điện thoại này đã có người đăng kí');
                    </script>";
            }
            else{
                $insert_user = "INSERT INTO taikhoan (`tenTK`,`matKhau`,`SDT`,`diaChi`,`gioiTinh`,`avatar`)
                        VALUES ('$register_name','$register_password','$register_telephone','$register_address','$registerGender','$register_avatar')";
                $result_insert = $conn->query($insert_user);
                if($result_insert == TRUE){
                    echo "<script>
                            alert('Đăng kí tài khoản thành công. Vui lòng đăng nhập lại.');
                        </script>";
                }
                else{
                    echo "<script>
                            alert('Lỗi đăng kí. Vui lòng thử lại.');
                        </script>";
                }
            }
        }
    }
    if(isset($_POST['submit_sign-in'])){
        $number_mobile = $_POST['user_number-mobile'];
        $password = $_POST['user_password'];

        $sql_user = "SELECT * FROM taikhoan WHERE SDT ='$number_mobile' and matKhau = '$password'";
        $result_user = $conn->query($sql_user);
        if($result_user ->num_rows>0){
            $rowInfoUser = $result_user->fetch_assoc();
            $_SESSION['user'] = $rowInfoUser['tenTK'];
            $_SESSION['avatar'] = $rowInfoUser['avatar'];
                header("Location: ./index.php");
        }
        else{
            echo "<script> alert('Tài khoản mật khẩu không chính xác'); </script>";
        }
    }
    if(isset($_POST['submit_logout']) || isset($_POST['submit_signOut']) ){
        if(isset($_SESSION['user']) || isset($_SESSION['avatar'])){
            unset($_SESSION['user']);
            unset($_SESSION['avatar']);
        }
    }
    if(isset($_SESSION['user'])){
        $userName =  $_SESSION['user'];
        $avatar = $_SESSION['avatar'];
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Wabsi Mia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="./img/img-all/logo_web.jpg"/>
    <link rel ='stylesheet' href="./assets/css/CSS_allPage.css">
    <link rel="stylesheet" href="./assets/css/CSS_index.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/slick.js"></script>
</head>
<body>

    <?php
        if(isset($userName)){
            ?>
            <script>
                document.addEventListener('DOMContentLoaded',function(){
                    document.querySelector('.navbar_profile').onclick = function(){
                        window.location.href = './assets/php/manage_account.php';
                    };
                    document.querySelector('.navbar_security').onclick = function(){
                        window.location.href = './assets/php/manage_account.php?id_active=1';
                    };
                    document.querySelector('.navbar_help').onclick = function(){
                        window.location.href = './assets/php/contact.php';
                    };
                    <?php
                        if($userName != "Admin"){
                            echo "document.querySelector('#show_cart').onclick = function(){
                                window.location.href = './assets/php/manage_account.php?id_active=2';
                            };";
                        }
                    ?>
                });
            </script>
            <?php
        }
        else{
            ?>
                <script src="./js/formAccount_JS.js"></script>
            <?php
        }
    ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <header>
            <div class="item__header header--left">
                <div class="img__header">
                    <img src="./assets/img/img-all/logo_header.jpg" class= "logo-header" alt="">
                </div>
                <div class="menu__navbar">
                    <ul class="menu__navbar--list">
                        <li class="item_menu">
                            <a href="./index.php" class="link_menu">Trang chủ</a>
                        </li>
                        <li class="item_menu">
                            <a href="./assets/php/introduce.php" class="link_menu">Giới thiệu</a>
                        </li>
                        <li class="item_menu menu-hidden">
                            <a href="./assets/php/product_news.php" class="link_menu">Sản phẩm</a>
                            <ul class="menu__navbar--hidden menu_product" style='width:190px'>
                                <li class="item_menu-hidden"><a href="./assets/php/product_news.php" class="link_menu-hidden">Sản phẩm mới</a></li>
                                <li class="item_menu-hidden"><a href="./assets/php/product_mia.php" class="link_menu-hidden">Vòng đá Mia</a></li>

                            </ul>
                        </li>
                        <li class="item_menu menu-hidden">
                            <a href="./assets/php/blog.php" class="link_menu">Blog</a>
                            <?php
                                if(isset($userName)){
                                    echo "<ul class='menu__navbar--hidden menu_blog'>";
                                        echo "<li class='item_menu-hidden'><a href='./assets/php/blog.php' class='link_menu-hidden'>Blog tin tức</a></li>";
                                        echo "<li class='item_menu-hidden'><a href='./assets/php/blog_user_question.php' class='link_menu-hidden'>Blog cá nhân</a></li>";
                                    echo "</ul>";
                                }
                            ?>
                        </li>
                        <li class="item_menu">
                            <a href="./assets/php/contact.php" class="link_menu">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="item__header header--right">
                <?php
                    if(isset($userName) && $userName != "Admin"){
                        echo "<div id='show_cart' class='icons icon_header-shopping'>";
                    }
                    else{
                        echo "<div class='icons icon_header-shopping'>";
                    }
                            echo "<i class='fas icon-circle fa-shopping-cart'></i>";
                        echo "</div>";
                ?>
                <div class="icons icon_header-bell">
                    <i class="fas icon-circle fa-bell"></i>
                </div>
                <?php
                    if(isset($userName)){
                        echo "<div id ='show_info_pageHome' class='icons icon_header-signed'>";
                            echo "<img src='./img/img-avatar/{$avatar}' class='icons_avatarUser'>";
                            echo "<ul class='menu_navbarUser'>";
                                echo "<li class='item_navbarUser navbar_profile'>";
                                    echo "<i class='fas fa-user-circle'></i>";
                                    echo "<p>Hồ sơ</p>";
                                echo "</li>";
                                echo "<li class='item_navbarUser navbar_security'>";
                                    echo "<i class='fas fa-user-shield'></i>";
                                    echo "<p>Bảo mật</p>";
                                echo "</li>";
                                echo "<li class='item_navbarUser navbar_help'>";
                                    echo "<i class='fas fa-question-circle'></i>";
                                    echo "<p>Trợ giúp</p>";
                                echo "</li>";
                                echo "<li class='item_navbarUser navbar_logOut'>";
                                    echo "<i class='fas fa-sign-out-alt'></i>";
                                    echo "<label for='submit_logOut'>Đăng xuất</label>";
                                echo "</li>";
                            echo "</ul>";
                            echo "<form action ='./index.php' method='post' style='display:none'>";
                                echo "<input type='submit' name='submit_logout' id='submit_logOut'>";
                            echo "</form>";
                        echo "</div>";
                    }
                    else{
                        echo "<div class='icons icon_header-account icon_header_noUser'>";
                            echo "<i class='fas icon-circle fa-user-alt'></i>";
                            echo "<ul class='menu_navbarUser'>";
                                echo "<li class='item_navbarUser navbar_signUp'>";
                                    echo "<i class='fas fa-user-plus'></i>";
                                    echo "<p>Đăng kí</p>";
                                echo "</li>";
                                echo "<li class='item_navbarUser navbar_signIn'>";
                                    echo "<i class='fas fa-sign-in-alt'></i>";
                                    echo "<p>Đăng nhập</p>";
                                echo "</li>";
                            echo "</ul>";
                        echo "</div>";
                    }
                ?>
            </div>
    </header>

    <div id="container">
        <!-- slide  -->
        <div style='margin-top:35px;'class="container__img">
            <img src="./img/img-index/pic-1.jpg" alt="background">
            <img src="./img/img-index/pic-3.jpg" alt="background">
        </div>
        <!-- content -->
        <div class="container__content">
            <!-- 4 Img destiny -->
            <div class="container__content--item content__top col-11">
                <img src="./img/img-index/bracelet_1.jpg" alt="Ảnh">
                <img src="./img/img-index/bracelet_2.jpg" alt="Ảnh">
                <img src="./img/img-index/bracelet_3.jpg" alt="Ảnh">
                <img src="./img/img-index/bracelet_4.jpg" alt="Ảnh">
            </div>
            <!-- Banner -->
            <div class="container__content--item content__center--top col-11">
                <div class="item--banner banner-side">
                    <img src="./img/img-index/pic-hover-one.jpg"  alt="logo_both-side">
                </div>
                <div class="item--banner banner-center">
                    <img src="./img/img-index/logo-big.jpg" alt="logo_website">
                </div>
                <div class="item--banner banner-side">
                    <img src="./img/img-index/pic-hover-two.jpg" alt="logo_both-side">
                </div>
            </div>
            <!-- Product News -->
            <div class="container__content--item content__center--bottom col-12">
                <div class ="all__product--title">
                    <a href="" class='item-title'>Bán chạy nhất</a>
                    <a href="" class='item-title'>Mới nhất</a>
                    <a href="" class='item-title'>Đặc biệt</a>
                </div>
                <div class="all__product--img col-11">
                    <div class="product--img-item col-12">
                        <img src="./img/img-index/bracelet_6.jpg" alt="Ảnh">
                        <img src="./img/img-index/bracelet_7.jpg" alt="Ảnh">
                        <img src="./img/img-index/bracelet_8.jpg" alt="Ảnh">
                        <img src="./img/img-index/bracelet_9.jpg" alt="Ảnh">
                    </div>
                    <div class="product--img-item col-12">
                        <img src="./img/img-index/bracelet_10.jpg" alt="Ảnh">
                        <img src="./img/img-index/bracelet_11.jpg" alt="Ảnh">
                        <img src="./img/img-index/bracelet_12.jpg" alt="Ảnh">
                        <img src="./img/img-index/bracelet_13.jpg" alt="Ảnh">
                    </div>
                </div>
            </div>
            <!-- Content... -->
            <div class="container__content--item content__bottom col-12">
                <div class="content__bottom--img col-6">
                    <img src="./img/img-index/kim.jpg" alt="Ảnh">
                    <img src="./img/img-index/moc.jpg" alt="Ảnh">
                    <img src="./img/img-index/tho.jpg" alt="Ảnh">
                    <img src="./img/img-index/thuy.jpg" alt="Ảnh">
                    <img src="./img/img-index/hoa.jpg" alt="Ảnh">
                    <img src="./img/img-index/img-web.jpg" alt="Ảnh">
                </div>
                <div class="content__bottom--content col-4">
                    <h3>Ngũ hành</h3>
                    <p>Vòng đá phong thủy theo ngũ hành (Kim, Thủy, Mộc, Hỏa, Thổ) là những chiếc vòng được làm từ chính những viên đá có sẵn trong tự nhiên, chúng được xem là những vật phẩm có khả năng đem lại những may mắn cho con người. Mang đến tài lộc, thịnh vượng, phù trợ cho con người trong công việc cũng như cuộc sống. Đặc biệt sẽ giúp những người kinh doanh, buôn bán thuận lợi hơn trong con đường công danh sự nghiệp.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <div class="item-footer footer-1 col-5">
            <ul class="ul-footer">
                <li class="li-footer"><a href="#"><img class="logo-full" src="./img/img-all/logo_footer.jpg" alt=""></a></li>
                <li class="li-footer"><i class="fa fa-map-marker" aria-hidden="true"></i> Số 258,Nhuệ Giang, Tân Hội, H.Đan Phượng, TP Hà Nội</li>
                <li class="li-footer"><i class="fa fa-phone-square" aria-hidden="true"></i> 0964444989</li>
                <li class="li-footer"><i class="fa fa-envelope-open" aria-hidden="true"></i> wabsimiastore@gmail.com</li>
            </ul>
        </div>
        <div class="item-footer footer-2 col-3">
            <h4>SẢN PHẨM</h4>
            <ul class="ul-footer">
                <li class="li-footer"><a href="./assets/php/product_destiny.php">Vòng Đá Phong Thủy</a></li>
                <li class="li-footer"><a href="./assets/php/product_fashion.php">Vòng Đá Thời Trang</a></li>
            </ul>
        </div>
        <div class="item-footer footer-3 col-4">
            <h4>HỖ TRỢ</h4>
            <ul class="ul-footer">
                <li class="li-footer"><a href="#">Chính sách bán hàng</a></li>
                <li class="li-footer"><a href="#">Chính sách bảo mật</a></li>
                <li class="li-footer"><a href="#">Hướng dẫn mua hàng</a></li>
                <li class="li-footer"><a href="#">Giao nhận và thanh toán</a></li>
                <li class="li-footer"><a href="#">Chính sách bảo hành và đổi trả</a></li>
            </ul>
        </div>
    </div>

    <div class="form__user">
        <div class="form__overlay"></div>
        <div class="form__layout">
            <div class="form__sign-in">
                <div class="form_layout-heading">
                    <h2>Đăng nhập</h2>
                </div>
                <div class="form_layout-input">
                    <form action="" method='post'>
                        <input type="text" required name = 'user_number-mobile' class="item_form-input" placeholder="Số điện thoại">
                        <input type="password" required name = 'user_password' class="item_form-input" placeholder="Mật khẩu">
                        <input type="submit" required name = 'submit_sign-in' class="item_form-input submit_account" value="Đăng nhập">
                    </form>
                </div>
                <div class="form_layout-policy">
                    <p style='margin:10px 0'>
                        <a href="#">Quên mật khẩu</a>
                    </p>
                    <p style='margin:10px 0'>
                        Bạn chưa có tài khoản?
                        <a id="click_sign-up" href="#">Đăng ký</a>
                    </p>
                </div>
                <div class="form_layout-social">
                    <a class="link_social" href="https://facebook.com/tranhung18.it">
                        <i class="fab fa-facebook"></i>
                        <p>Kết nối với facebook</p>
                    </a>
                    <a class="link_social" href="https://google.com">
                        <i class="fab fa-google"></i>
                        <p>Kết nối với Google</p>
                    </a>
                </div>
            </div>
            <div class="form__sign-up">
                <div class="form_layout-heading">
                    <h2>Đăng ký</h2>
                </div>
                <div class="form_layout-input">
                    <form class='form_registerAccount' enctype='multipart/form-data' action="" method='post'>
                        <input type="text" name = 'register_name' required id= 'register_name' class="item_form-input" placeholder="Nhập tên của bạn">
                        <span class='notification_register span_registerName' title='Vui lòng nhập đầy đủ họ tên'></span>
                        <input type="password" name = 'register_password' required id = 'register_password' class="item_form-input" placeholder="Tạo mật khẩu">
                        <span class='notification_register span_registerPass' title='Mật khẩu phải lớn hơn 6 kí tự, bao gồm chữ cái in hoa, in thường và kí tự đặc biệt'></span>
                        <progress max="100" value="0" class="meterPass"></progress>
                        <input type="tel" name = 'register_telephone' required id='register_phoneNumber' class="item_form-input"  placeholder="Nhập số điện thoại">
                        <span class='notification_register span_phoneNumber' title='Số điện thoại phải lớn hơn 9 chữ số'></span>
                        <div class="gender_avatarUser">
                            <div class="genderUser">
                                <p class="title_genderAvatar">Giới tính <span class="notification_genderAvatar" title='Hãy chọn đúng giới tính của bạn'><i style='font-size: 1.3rem;color: #606770;' class="fas fa-question-circle"></i></span></p>
                                <div class="gender_user">
                                    <div class="item_genderUser">
                                        <p style='margin:0'>Nam</p>
                                        <input type="radio" class='item_formGender' name='registerGender' value='Nam'>
                                    </div>
                                    <div class="item_genderUser">
                                        <p style='margin:0'>Nữ</p>
                                        <input type="radio" class='item_formGender' name='registerGender' value='Nữ'>
                                    </div>
                                </div>
                            </div>
                            <div class="avatarUser">
                                <p class="title_genderAvatar">Ảnh đại diện</p>
                                <div class="avatar_user">
                                    <input type="file"  id='input_fileAvatar' name='register_avatar' class='item_avatarUser'>
                                </div>
                            </div>
                        </div>
                        <input type="text" name = 'register_address' class='item_form-input' placeholder="Nhập địa chỉ">

                        <input type="submit" name='submit_sign-up' id='submit_RegisterAccount' class="item_form-input submit_account" value="Đăng ký">
                    </form>
                </div>
                <div class="form_layout-policy">
                    <p>
                        Bằng cách đăng ký, bạn đồng ý với
                        <a href="#">Điều khoản dịch vụ</a>,<a href="#"> Chính sách bảo mật</a>
                        của chúng tôi.
                    </p>
                    <p style="margin-top:15px;">
                        Bạn đã có tài khoản?
                        <a id="click_sign-in" href="#">Đăng nhập</a>
                    </p>
                </div>
                <div class="form_layout-social">
                    <a class="link_social" href="https://facebook.com/tranhung18.it">
                        <i class="fab fa-facebook"></i>
                        <p>Kết nối với facebook</p>
                    </a>
                    <a class="link_social" href="https://google.com">
                        <i class="fab fa-google"></i>
                        <p>Kết nối với Google</p>
                    </a>
                </div>
            </div>
            <i style="font-size: 2rem" class="fas fa-times icon_close"></i>
        </div>
    </div>

    <script>
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("change_color_header", window.scrollY > 100);
        });
        function checkPass(password){
            var count = 0;
            if(password.length > 6 ){
                count +=20;
            }
            if (password.match(/[a-z]+/)) {
                count +=20;
            }
            if (password.match(/[A-Z]+/)) {
                count +=20;
            }
            if (password.match(/[0-9]+/)) {
                count +=20;
            }
            if (password.match(/[$@%*#&!]+/)) {
                count +=20;
            }
            return count;
        }

        document.addEventListener('DOMContentLoaded',function(){
            const form_registerAccount = document.querySelector('.form_registerAccount');
            var btn_registerAccount = document.querySelector('#submit_RegisterAccount');
            btn_registerAccount.disabled = true;

            function checkInputRegister(){
                var meter_pass = document.querySelector('.meterPass');
                const notification_name = document.querySelector('.span_registerName');
                const notification_pass = document.querySelector('.span_registerPass');
                const notification_phoneNumber = document.querySelector('.span_phoneNumber');
                const input_registerName = document.querySelector('#register_name');
                const input_registerPass = document.querySelector('#register_password');
                const input_registerTelephone = document.querySelector('#register_phoneNumber');

                const all_gender = document.querySelectorAll('.item_formGender');
                var checkGender = 0;
                for(var i = 0 ; i < all_gender.length ; i++){
                    if(all_gender[i].checked){
                        checkGender++;
                    }
                }
                if(checkGender == 0){
                    document.querySelector('.fa-question-circle').style.color = 'red';
                    document.querySelector('.notification_genderAvatar').setAttribute('title','Vui lòng chọn giới tính');
                }
                else{
                    document.querySelector('.fa-question-circle').style.color = '#606770';
                    document.querySelector('.notification_genderAvatar').setAttribute('title','Hãy chọn đúng giới tính của bạn');
                }

                input_registerName.onchange = function(){
                    if(input_registerName.value.length <6){
                        notification_name.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
                        input_registerName.style.border = '1.5px solid red';
                    }
                    else{
                        notification_name.innerHTML = '';
                        input_registerName.style.border = '1px solid #888888';
                    }
                }
                input_registerPass.onchange = function(){
                    var meter = checkPass(input_registerPass.value);
                    meter_pass.value = meter;
                    if(meter_pass.value == 100){
                        notification_pass.innerHTML = '';
                        input_registerPass.style.border = '1px solid #888888';
                    }
                    else{
                        notification_pass.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
                        input_registerPass.style.border = '1.5px solid red';
                    }
                }
                input_registerTelephone.onchange = function(){
                    if(input_registerTelephone.value.toString().length <10){
                        notification_phoneNumber.innerHTML = `<i class="fas fa-exclamation-circle"></i>`;
                        input_registerTelephone.style.border = '1.5px solid red';
                    }
                    else{
                        notification_phoneNumber.innerHTML = '';
                        input_registerTelephone.style.border = '1px solid #888888';
                    }
                }
                if(input_registerName.value.length >6 && meter_pass.value == 100 &&  input_registerTelephone.value.length >=10 && checkGender != 0){
                    btn_registerAccount.removeAttribute('disabled');
                }
            }
            form_registerAccount.onkeyup = checkInputRegister;
        });

    </script>
</body>
</assets/php>
