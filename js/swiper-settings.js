const swiper = new Swiper(".swiper", {
  loop: true,
  autoHeight: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  slidesPerView: 1,
  spaceBetween: 10,
  autoplay: {
    delay: 3500,
  },
  breakpoints: {
    800: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
  },
});
