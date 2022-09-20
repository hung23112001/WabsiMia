function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
        break;
        }
    }
}
// định dạng tiền
function formatCash(str) {
    return str.split('').reverse().reduce(
        (prev, next, index) => {
            return ((index % 3) ? next : (next + ',')) + prev
        }
    )
}
function loader_web_product(id){
    if(id =="product_destiny"){
        window.location.href = '../html/product_mia.php?typeProduct=destiny';
    }else if(id == "product_fashion"){
        window.location.href = '../html/product_mia.php?typeProduct=fashion';
    }
}
document.addEventListener("DOMContentLoaded",function(){
    document.querySelector('#input_rangePrice').onchange = function(){
        var priceRange = document.querySelector("#input_rangePrice").value;
        window.location.href = './product_mia.php?changePrice='+priceRange+'';            
    }
    const img_destinyProduct = document.querySelectorAll('.destiny_product');
    
    img_destinyProduct.forEach((item,index) => {
        var destiny = (item.getAttribute('alt')).toString();
        if(destiny == "Hỏa"){
            item.style.background = '#f52121';
        }
        else if(destiny == "Kim"){
            item.style.background = '#f1c40f';
        }
        else if(destiny == "Thủy"){
            item.style.background = '#3498db';
        }
        else if(destiny == "Mộc"){
            item.style.background = '#2ecc71';
        }
        else{
            item.style.background = '#cd6133';
        }
    });
});
