<?php
    require '/xampp/htdocs/Web/WABSI-MIA/connect.php';
    session_start();
    if(isset($_SESSION['user'])){
        $userName =  $_SESSION['user'];
        $avatar = $_SESSION['avatar'];
    }
?>
<header>
    <div class="item__header header--left">
        <div class="img__header">
            <img src="../img/img-all/logo_header.jpg" class= "logo-header" alt="">
        </div>
        <div class="menu__navbar">
            <ul class="menu__navbar--list">
                <li class="item_menu">
                    <a href="../../index.php" class="link_menu">Trang chủ</a>
                </li>
                <li class="item_menu">
                    <a href="../php/introduce.php" class="link_menu">Giới thiệu</a>
                </li>
                <li class="item_menu menu-hidden">
                    <a href="../php/product_news.php" class="link_menu">Sản phẩm</a>
                    <ul class="menu__navbar--hidden menu_product" style='width:190px'>
                        <li class="item_menu-hidden"><a href="../php/product_news.php" class="link_menu-hidden">Sản phẩm mới</a></li>
                        <li class="item_menu-hidden"><a href="../php/product_mia.php" class="link_menu-hidden">Vòng đá Mia</a></li>
                    </ul>
                </li>
                <li class="item_menu menu-hidden">
                    <a href="../php/blog.php" class="link_menu">Blog</a>
                    <?php
                        if(isset($userName)){
                            echo "<ul class='menu__navbar--hidden menu_blog'>";
                                echo "<li class='item_menu-hidden'><a href='../php/blog.php' class='link_menu-hidden'>Blog tin tức</a></li>";
                                echo "<li class='item_menu-hidden'><a href='../php/blog_user_question.php' class='link_menu-hidden'>Blog cá nhân</a></li>";
                            echo "</ul>";
                        }
                    ?>
                </li>
                <li class="item_menu">
                    <a href="../php/contact.php" class="link_menu">Liên hệ</a>
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
                    echo "<img src='../img/img-avatar/{$avatar}' class='icons_avatarUser'>";
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
                    echo "<form action ='../index.php' method='post' style='display:none'>";
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

<script>
    window.addEventListener("scroll", function(){
        var header = document.querySelector("header");
        header.classList.toggle("change_color_header", window.scrollY > 100);
    });
</script>

<?php
    if(isset($userName)){
        ?>
        <script>
            document.addEventListener('DOMContentLoaded',function(){
                <?php
                    if($userName != "Admin"){
                        echo "document.querySelector('#show_cart').onclick = function(){
                            window.location.href = '../php/manage_account.php?id_active=2';
                        };";
                    }
                ?>
                document.querySelector('.navbar_profile').onclick = function(){
                    window.location.href = '../php/manage_account.php';
                };
                document.querySelector('.navbar_security').onclick = function(){
                    window.location.href = '../php/manage_account.php?id_active=1';
                };
                document.querySelector('.navbar_help').onclick = function(){
                    window.location.href = '../php/contact.php';
                };
            });
        </script>
        <?php
    }
    else{
        ?>
            <script src="../js/formAccount_JS.js"></script>
        <?php
    }
?>
