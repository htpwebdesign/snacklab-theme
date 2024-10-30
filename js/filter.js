jQuery(document).ready(function ($) {
  // Initialize Isotope after all images have loaded
  var $grid = $(".products-grid").isotope({
    // options
    itemSelector: ".product-item",
    layoutMode: "masonry",
    // masonry: {
    //   columnWidth: 320,
    //   isFitWidth: true
    // },
    percentPosition: true,
    // Optional: Customize animation duration and easing
    transitionDuration: "0.6s",
    hiddenStyle: {
      opacity: 0,
      transform: "scale(0.8)",
    },
    visibleStyle: {
      opacity: 1,
      transform: "scale(1)",
    },
  });

  // Filter items on button click
  $(".filter-menu").on("click", ".filter-button", function () {
    var filterValue = $(this).attr("data-filter");
    $grid.isotope({ filter: filterValue });

    // Update active class
    $(".filter-button").removeClass("active");
    $(this).addClass("active");
  });

  // Optional: Make sure Isotope layout updates on window resize
  $(window).resize(function () {
    $grid.isotope("layout");
  });
});
