// form sign-in sign-up
$(document).ready(function (){
    $(".navbar_signUp").click(function (){
        $(".form__sign-in").hide(),
        $(".form__sign-up").show(),
        $(".form__user").css({
            'display':'flex',
        });
    });
});
$(document).ready(function (){
    $(".navbar_signIn").click(function (){
        $(".form__sign-in").show(),
        $(".form__sign-up").hide(),
        $(".form__user").css({
            'display':'flex',
        });
    });
});
$(document).ready(function (){
    $("#click_sign-up").click(function (){
        $(".form__sign-in").hide();
        $(".form__sign-up").show();
    });
});
$(document).ready(function (){
    $("#click_sign-in").click(function (){
        $(".form__sign-up").hide();
        $(".form__sign-in").show();
    });
});
$(document).ready(function (){
    $(".fa-times").click(function (){
        $(".form__user").hide();
        $(".form__sign-in").show();
        $(".form__sign-up").show();
    });
});




// document.addEventListener('DOMContentLoaded',function(){
//     const formSignIn = document.querySelector('.form__sign-in');
//     const formSignUp = document.querySelector('.form__sign-up');
//     const formUser = document.querySelector('.form__user');

//     document.querySelector('.navbar_signUp').onclick = function(){
//         formSignIn.style.display = 'none';
//         formSignUp.style.display = 'block';
//         formUser.style.display = 'flex';
//         document.querySelector('#click_sign-in').onclick = function(){
//             formSignUp.style.display = 'none';
//             formSignIn.style.display = 'block';
//         };
//     };
//     document.querySelector('.navbar_signIn').onclick = function(){
//         formSignUp.style.display = 'none';
//         formSignIn.style.display = 'block';
//         formUser.style.display = 'flex';
//         document.querySelector('#click_sign-up').onclick = function(){
//             formSignIn.style.display = 'none';
//             formSignUp.style.display = 'block';
//         };
//     };
//     document.querySelector('.fa-times').onclick = function(){
//         formUser.style.display = 'none';
//         formSignUp.style.display = 'block';
//         formSignUp.style.display = 'block';
//     };
// });

