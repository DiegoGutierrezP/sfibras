let navbar = document.querySelector(".header .navbar");
let searchForm = document.querySelector(".header .search-form");
//let loginForm = document.querySelector(".header .login-form");
//let contactInfo = document.querySelector(".contact-info");
let contactInfo = document.querySelector(".contact-info-content");
/* servicios page */
let menuserviciospage = document.querySelector(".servicios-page .content .menu");
/* Profile content */
let profileContent = document.querySelector(".header .profile-content .menu-profile");



document.addEventListener("click",e =>{
    if(e.target.matches("#menu-btn")){
        navbar.classList.toggle('active');
        searchForm.classList.remove('active');
        contactInfo.classList.remove('active');
        if(menuserviciospage !== null){
            menuserviciospage.classList.remove('active');
        }
        profileContent.classList.remove('active');
    }
    if(e.target.matches("#search-btn")){
        searchForm.classList.toggle('active');
        navbar.classList.remove('active');
        contactInfo.classList.remove('active');
        if(menuserviciospage !== null){
            menuserviciospage.classList.remove('active');
        }
        profileContent.classList.remove('active');
    }
    if(e.target.matches("#info-btn")){
        contactInfo.classList.toggle('active');
        navbar.classList.remove('active');
        searchForm.classList.remove('active');
        if(menuserviciospage !== null){
            menuserviciospage.classList.remove('active');
        }
        profileContent.classList.remove('active');
    }
    if(e.target.matches(".contact-info #close-contact-info")){
        contactInfo.classList.remove('active');
    }
    /* Servicios page */
    if(e.target.matches(".servicios-page #menu-servicios-btn")){
        menuserviciospage.classList.add('active');
    }
    if(e.target.matches(".servicios-page .content .menu")){
        if(menuserviciospage.classList.contains('active')){
            menuserviciospage.classList.remove('active');
             console.log('removi');
        }
    }
    /* ProfileContent */
    if(e.target.matches("#auth-btn")){
        profileContent.classList.toggle('active');
        navbar.classList.remove('active');
        searchForm.classList.remove('active');
        contactInfo.classList.remove('active');
    }
})
/* Servicios page */
let breakpoint = window.matchMedia("(max-width:991px)");
breakpoint.addEventListener("change",()=>{//cuando sea mayor a 991px
    console.log("mayor a 991");
    menuserviciospage.classList.remove('active');
})


window.onscroll = () =>{
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
     contactInfo.classList.remove('active');
     if(menuserviciospage !== null){
         menuserviciospage.classList.remove('active');
     }

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
        1200:{
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
   if(e.target.matches(".popup-image .close-popup")){
        document.querySelector('.popup-image').style.display = 'none';
   }
})

