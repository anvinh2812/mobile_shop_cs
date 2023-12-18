var FNextBtn = document.querySelector('.flash__sale__next__btn')
var FPrevBtn = document.querySelector('.flash__sale__prev__btn')
var FPrdoductList = document.querySelector('.flash__sale__product__list')
var FPrdoductIem = document.querySelectorAll('.flash__sale__product')
var Fl = 238
var Findex = 0
var FPositionX = 0
var totalProducts = FPrdoductIem.length; // Tổng số sản phẩm

FNextBtn.addEventListener('click', function () {
    FHandle(1)
})
FPrevBtn.addEventListener('click', function () {
    FHandle(-1)
})

function FHandle(Fnumber) {
    if (totalProducts <= 4) return; // Nếu chỉ có 4 sản phẩm thì không di chuyển

    if (Fnumber == 1) {
        if (Findex >= totalProducts - 4) return; // Dừng khi hiển thị sản phẩm cuối cùng
        console.log('Next')
        FPositionX = FPositionX - Fl
        FPrdoductList.style = `transform: translateX(${FPositionX}px)`
        Findex++
        console.log('Findex', Findex)
    }
    if (Fnumber == -1) {
        if (Findex <= 0) return
        console.log('Prev')
        FPositionX = FPositionX + Fl
        FPrdoductList.style = `transform: translateX(${FPositionX}px)`
        Findex--
        console.log('Findex', Findex)
    }
}
