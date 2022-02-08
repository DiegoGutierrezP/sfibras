let navbar = document.querySelector(".header .navbar");
let searchForm = document.querySelector(".header .search-form");
//let loginForm = document.querySelector(".header .login-form");
let contactInfo = document.querySelector(".contact-info");

document.querySelector("#menu-btn").onclick = ()=>{
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
     //loginForm.classList.remove('active');
     contactInfo.classList.remove('active');
};
document.querySelector("#search-btn").onclick = ()=>{
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
    //loginForm.classList.remove('active');
    contactInfo.classList.remove('active');
};
/* document.querySelector("#login-btn").onclick = ()=>{
    loginForm.classList.toggle('active');
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
    contactInfo.classList.remove('active');
}; */
document.querySelector("#info-btn").onclick = ()=>{
    contactInfo.classList.toggle('active');
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
     //loginForm.classList.remove('active');
};
document.querySelector(".contact-info #close-contact-info").onclick = ()=>{
    contactInfo.classList.remove('active');
};
window.onscroll = () =>{
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
     //loginForm.classList.remove('active');
     contactInfo.classList.remove('active');
}
/* SWIPER JS */
var swiper = new Swiper(".home-slider", {
    loop:true,
    grabCursor:true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

var swiper = new Swiper(".logo-slider",{
    loop:true,
    grabCursor:true,
    spaceBetween: 20,
    breakpoints:{
        450:{
            slidesPerView:2
        },
        640:{
            slidesPerView:3
        },
        768:{
            slidesPerView:4
        },
        1000:{
            slidesPerView:5
        },
    }
})


/* Popup image */
const $popupimg =document.querySelector(".popup-image img");

document.addEventListener("click", e =>{
    if(e.target.matches("[data-img-trabajos]")){
        //console.log(e.srcElement.src);
        $popupimg.src = e.srcElement.src;
        document.querySelector('.popup-image').style.display = 'block';
   }
})

document.querySelector(".popup-image .close-popup").onclick = () => {
     document.querySelector('.popup-image').style.display = 'none';
}
