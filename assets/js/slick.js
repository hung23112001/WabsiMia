  $(document).ready(function(){
      $('.img_product').slick({
          // slidesToShow: 1, // số ảnh show
          // slidesToScroll: 2, // số ảnh chuyển tiếp
          infinite: true, // lặp lại 
          arrows: false, // nút pre, next
          autoplay: true, 
          autoplaySpeed: 1500,
          draggable: true, //trượt
      });
  });
$(document).ready(function(){
    $('.container__img').slick({
        infinite: true, // lặp lại 
        arrows: false, // nút pre, next
        autoplay: true, 
        autoplaySpeed: 3000,
        draggable: false, //trượt
    });
});
$(document).ready(function(){
    $('.content__bottom--img').slick({
        infinite: true, // lặp lại 
        arrows: false, // nút pre, next
        autoplay: true, 
        autoplaySpeed: 2000,
        draggable: true, //trượt
    });
});