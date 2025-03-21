function initializeSwiperCarousels() {
  document.querySelectorAll(".swiper-container").forEach(e => {
    var t = e.getAttribute("data-speed") || 400,
      a = e.getAttribute("data-space-between") || 20,
      i = "true" === e.getAttribute("data-pagination"),
      r = "true" === e.getAttribute("data-navigation"),
      n = "true" === e.getAttribute("data-autoplay"),
      s = e.getAttribute("data-autoplay-delay") || 3e3,
      l = e.getAttribute("data-pagination-type") || "bullets",
      o = "true" === e.getAttribute("data-center-slides"),
      d = e.getAttribute("data-effect") || "slide",
      u = "true" === e.getAttribute("data-thumbs");
    let p = {};
    var c = e.getAttribute("data-breakpoints");
    if (c) try {
      p = JSON.parse(c)
    } catch (e) {
      console.error("Error parsing breakpoints data:", e)
    }
    c = {
      speed: parseInt(t),
      spaceBetween: parseInt(a),
      breakpoints: p,
      slidesPerView: "auto",
      effect: d
    };
    "fade" === d && (c.fadeEffect = {
      crossFade: !0
    }), o && (c.slidesPerView = "auto", c.centeredSlides = !0), i && (t = e.querySelector(".swiper-pagination")) && (c.pagination = {
      el: t,
      type: l,
      dynamicBullets: !1,
      clickable: !0
    }), r && (c.navigation = {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }), n && (c.autoplay = {
      delay: parseInt(s)
    }), u && (a = e.nextElementSibling) && a.classList.contains("swiper-thumbs") && (d = new Swiper(a, {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: !0,
      watchSlidesProgress: !0
    }), c.thumbs = {
      swiper: d
    }), new Swiper(e, c)
  })
}
initializeSwiperCarousels();
var modalElement = document.getElementById("quickViewModal");
modalElement && modalElement.addEventListener("shown.bs.modal", function () {
  initializeSwiperCarousels()
});