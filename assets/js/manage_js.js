document.addEventListener("DOMContentLoaded",function(){
    document.querySelector('.item_menu.backTo_pageHome').onclick = function(){
        window.location.href = '../../index.php';
    };
    // Function checkMeterPass
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
    // Check change Password
    function checkChangePass(){
        document.querySelector('.btn_changePass').disabled = true;
        var meter_pass = document.querySelector('.meter');
        const input_passOld = document.querySelector('.input_passOld');
        const input_passNews = document.querySelector('.input_passNews');
        const input_rePassNews = document.querySelector('.input_re-passNews');
        const notification_passOld = document.querySelector('.span_checkPass');
        const notification_passNews = document.querySelector('.span_passNews');
        const notification_rePassNews = document.querySelector('.span_re-passNews');
        
        function check_rePass(){
            if(input_rePassNews.value != input_passNews.value){
                notification_rePassNews.innerHTML = 'Mật khẩu nhập vào không khớp';
            }else{
                notification_rePassNews.innerHTML = '';
            }
        }
        input_passOld.onchange= function(){
            if(input_passOld.value !=  passUser){
                notification_passOld.innerHTML = "Mật khẩu nhập vào không đúng";
            }
            else{
                notification_passOld.innerHTML = "";
            }
        }
        input_passNews.onchange = function(){
            var meter = checkPass(input_passNews.value);
            meter_pass.value = meter;
            if(meter != 100){
                notification_passNews.innerHTML = 'Mật khẩu phải lớn hơn 6 kí tự, bao gồm chữ cái in hoa, in thường, số và kí tự đặc biệt';
            }
            else{
                check_rePass();
                notification_passNews.innerHTML = '';
            }
        }
        input_rePassNews.onchange = check_rePass;
        if(meter_pass.value == 100 && input_passOld.value ==  passUser && input_rePassNews.value == input_passNews.value){
            document.querySelector('.btn_changePass').removeAttribute('disabled');
        }
    }
    document.querySelector('.form_changePass').onkeyup = checkChangePass;
});