<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../img/logo_web.jpg"/>
    <title>Wabsi Mia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel ='stylesheet' href="../css/CSS_allPage.css">
    <link rel="stylesheet" href="../css/CSS_product.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/product_JS.js"></script>
    <style>
        
    </style>
</head>
<body>
    <?php
          require_once "../Main/header.php";
    ?>

    <div id="container" style='padding-bottom:0'>
        <section class="col-3">
            <div class="item_section">
            <h2>Loại sản phẩm</h2>
                <ul class="choose_typeProduct">
                    <?php
                        if(!isset($_GET['typeProduct'])){
                            echo "<li class='item_typeProduct'><input id='product_destiny' onclick = 'loader_web_product(this.id);' type='radio'>Phong thủy</li>";
                            echo "<li class='item_typeProduct'><input id='product_fashion' onclick = 'loader_web_product(this.id);' type='radio'>Thời trang</li>";
                        }
                        else{
                            if($_GET['typeProduct'] == "fashion"){
                                echo "<li class='item_typeProduct'><input id='product_destiny' onclick = 'loader_web_product(this.id);' type='radio'>Phong thủy</li>";
                                echo "<li class='item_typeProduct'><input id='product_fashion' checked onclick = 'loader_web_product(this.id);' type='radio'>Thời trang</li>"; 
                            }
                            else{
                                echo "<li class='item_typeProduct'><input id='product_destiny' checked onclick = 'loader_web_product(this.id);' type='radio'>Phong thủy</li>";
                                echo "<li class='item_typeProduct'><input id='product_fashion' onclick = 'loader_web_product(this.id);' type='radio'>Thời trang</li>";
                            }
                        }
                        if(isset($userName) && $userName != "Admin"){
                            echo "<li class='item_typeProduct'><input  type='radio' id='product_collect'>Bộ sưu tập</li>";
                        }
                    ?>
                </ul>
            </div>
            <div class="item_section">
                <h2>Dòng sản phẩm</h2>
                <ul class="choose_typeProduct">
                    <li class="item_typeProduct"><input type="radio" name="dong_sp">Cao cấp</li>
                    <li class="item_typeProduct"><input type="radio" name="dong_sp">Trung cấp</li>
                    <li class="item_typeProduct"><input type="radio" name="dong_sp">Phổ thông</li>
                </ul>
            </div>
            <div class="item_section">
                <h2>Giá sản phẩm</h2>
                <div class="rangePrice">
                    <div class="choose_rangePrice col-12">
                        <span>10,000</span>   
                            <input type="range" id="input_rangePrice" min="10000" max="200000">
                        <span>200,000</span>
                    </div>
                    <p class="show_rangePrice">Giá : 10,000 VNĐ &rarr; <span class='rangeShow_max'></span> VNĐ</p>
                </div>
            </div>
            <div class="item_section">
                <h2>Bản mệnh phù hợp</h2>
                <select name="" class="select_year">
                    <option value="null">-- Chọn năm sinh --</option>
                    <?php
                        for($i = 1980; $i <= 2021; $i++){
                            echo "<option value='{$i}'>$i</option>";
                        }
                    ?>
                </select>
            </div>
        </section>
        <aside class="col-10">
            <form method='post' action='./product_mia.php?search' class="formSearch_product col-10">
                <input type="text" class="item_formSearch input_searchProduct" name='input_searchProduct' placeholder='Nhập vào dữ liệu bạn muốn tìm kiếm...'>
                <select name="select_typeSearch" class= 'item_formSearch ' id="">
                    <option value="tenSP">Tên sản phẩm</option>
                    <option value="gia">Giá sản phẩm</option>
                    <option value="loaiSP">Loại sản phẩm</option>
                    <option value="menh">Mệnh</option>
                </select>
                <input type="submit" class= 'item_formSearch submit_searchProduct' name= 'submit_searchProduct' value='Tìm kiếm'>
            </form>
            <?php
                echo "<div class='all_product col-12'>";
                    if(isset($_GET['numberPage'])){
                        $page_current = $_GET['numberPage'];
                        $product_start = $page_current * 9;
                        $all_product = "SELECT * FROM sanpham WHERE soLuong > 0 LIMIT 9 OFFSET $product_start";
                    }
                    else{
                        if(isset($_GET['typeProduct'])){
                            if($_GET['typeProduct'] == "destiny"){
                                $all_product = "SELECT * FROM sanpham WHERE soLuong > 0 and loaiSP = 'Phong thủy'";
                            }
                            else{
                                $all_product = "SELECT * FROM sanpham WHERE soLuong > 0 and loaiSP = 'Thời trang'";
                            }
                        }
                        else if(isset($_GET['changePrice'])){
                            $getChangePrice = $_GET['changePrice'];
                            $all_product = "SELECT * FROM sanpham WHERE gia <= '{$getChangePrice}'";
                        }
                        else if(isset($_POST['submit_searchProduct'])){
                            $select_typeSearch = $_POST['select_typeSearch'];
                            $input_searchProduct = $_POST['input_searchProduct'];
                            if($select_typeSearch != "gia"){
                                $all_product = "SELECT * FROM sanpham WHERE soLuong > 0 and $select_typeSearch LIKE '%{$input_searchProduct}%'";
                            }
                            else{
                                $all_product = "SELECT * FROM sanpham WHERE soLuong > 0 and $select_typeSearch <= '{$input_searchProduct}'";
                            }
                        }
                        else{
                            $all_product = "SELECT * FROM sanpham WHERE soLuong > 0 LIMIT 9 OFFSET 0";
                        }
                    }
                    
                    $result_product = $conn->query($all_product);
                    if($result_product->num_rows>0){
                        while($rowInfo_product = $result_product->fetch_assoc()){
                            echo "<div class='item_product'>";
                                echo "<a class='details_product' href='../php/details.php?id={$rowInfo_product['maSP']}&loai={$rowInfo_product['loaiSP']}'>
                                        <img src='../img/img-sp/{$rowInfo_product['loaiSP']}/{$rowInfo_product['anhSP']}' class='img_product'>
                                    </a>";
                                echo "<div class='content_product'>";
                                    echo "<h3 class='name_product'>{$rowInfo_product['tenSP']}</h3>";
                                    echo "<div class='content_detailsProduct'>";
                                        echo "<a class='details_product' href='../php/details.php?id={$rowInfo_product['maSP']}&loai={$rowInfo_product['loaiSP']}'>Xem chi tiết</a>";
                                        echo "<p class='price_product'>Giá: <b>{$rowInfo_product['gia']}đ</b></p>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<img src= '../img/img-destiny/{$rowInfo_product['menh']}.png' alt = '{$rowInfo_product['menh']}' class='destiny_product' title='Mệnh {$rowInfo_product['menh']}'>";
                            echo "</div>";
                                
                        }
                    }
                    else{
                        echo "<h3>Không có sản phẩm nào";
                    }               
                echo "</div>";

                if(!isset($_GET['changePrice']) && !isset($_GET['search']) && !isset($_GET['typeProduct'])){
                    if(isset($_GET['numberPage'])){
                        $page_currentProduct = $_GET['numberPage'];
                    }
                    else{
                        $page_currentProduct = 0;
                    }
                    
                    $numberPage = "SELECT COUNT(*) as sumProduct FROM sanpham";
                    $sqlSum_Product = $conn->query($numberPage);
                    if($sqlSum_Product == TRUE){
                        $rowSum = $sqlSum_Product->fetch_assoc();
                        $sumProduct = $rowSum['sumProduct'];
                        $sumNumber_pageProduct = ceil($sumProduct / 9);
                        echo "<div class='numberPage'>";
                            for($i = 0; $i <$sumNumber_pageProduct; $i++){
                                $number = $i +1;
                                if($i == $page_currentProduct){
                                    echo "<a href='./product_mia.php?numberPage=$i'><p class='item_numberPage active_numberPage'>{$number}</p></a>";                                    
                                }
                                else{
                                    echo "<a href='./product_mia.php?numberPage=$i'><p class='item_numberPage'>{$number}</p></a>";
                                }
                            }
                        echo "</div>";
                    }
                }
            ?>
        </aside>
    </div>
    
    <?php
        if(isset($_GET['changePrice'])){
            $range_price = $_GET['changePrice'];
            echo "<script>
                var priceVND = '{$range_price}';
                var rangePrice_inner = formatCash(priceVND.toString());
                document.querySelector('.rangeShow_max').innerHTML = rangePrice_inner ;
            </script>";
        }
        if(isset($userName) && $userName !="Admin"){
            echo "<script>";
                echo "    document.querySelector('#product_collect').onclick = function(){
                    window.location.href = '../php/manage_account.php?id_active=4';
                }";
            echo "</script>";
        }
        require_once "../Main/footer.php";
        require_once "../Main/form.php";
    ?>
</body>
</html>