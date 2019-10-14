/*首页轮播*/
var swiper = new Swiper('.swiper-001', {
    pagination: '.swiper-pag1',
    slidesPerView: 1,
    paginationClickable: true,
    spaceBetween: 10,
    loop: true,
    autoplay: 2500,
    autoplayDisableOnInteraction: false,
    speed:2000,
});

var swiper2 = new Swiper('.swiper-002', {
    pagination: '.swiper-pagination',
    paginationClickable: true,
    direction: 'vertical',
    loop: true,
    autoplay: 2500,
    autoplayDisableOnInteraction: false,
    speed: 1000,
    spaceBetween: 10,
});

var swiper3 = new Swiper('.swiper-003', {
    pagination: '.swiper-pag3',
    paginationType: 'fraction',
    loop: true,
    autoplay: 2500,
    autoplayDisableOnInteraction: false,
    speed: 1000,
    spaceBetween: 10,
});