<style>
    .notification_register{
        height: 0;
        margin: 7.5px 0;
        transform: translate(92%,-38px);
    }
    .fa-exclamation-circle{
        font-size: 19px;
        color: red;
    }
    .meterPass{
        width: 100%;
        margin: -5px 0 5px;
    }
</style>
<div class="form__user">
    <div class="form__overlay"></div>
    <div class="form__layout">
        <div class="form__sign-in">
            <div class="form_layout-heading">
                <h2>Đăng nhập</h2>
            </div>
            <div class="form_layout-input">
                <form action="../../index.php" method='post'>
                    <input type="text" name = 'user_number-mobile' class="item_form-input" placeholder="Số điện thoại">
                    <input type="password" name = 'user_password' class="item_form-input" placeholder="Mật khẩu">
                    <input type="submit" name = 'submit_sign-in' class="item_form-input submit_account" value="Đăng nhập">
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
                    <form class='form_registerAccount' enctype='multipart/form-data' action="../../index.php" method='post'>
                        <input type="text" name = 'register_name' required id = 'register_name' class="item_form-input" placeholder="Nhập tên của bạn">
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
