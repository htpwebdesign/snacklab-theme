document.addEventListener("DOMContentLoaded", function () {
  var swiper = new Swiper(".swiper-container", {
    // Optional Parameters
    direction: "horizontal", // 'vertical' or 'horizontal'
    loop: true, // Enable continuous loop mode

    // Pagination
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },

    // Navigation Arrows
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    // Scrollbar
    scrollbar: {
      el: ".swiper-scrollbar",
      hide: true,
    },

    // Autoplay
    autoplay: {
      delay: 5000, // 5 seconds
      disableOnInteraction: false,
    },

    // Responsive Breakpoints
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 40,
      },
    },
  });
});
