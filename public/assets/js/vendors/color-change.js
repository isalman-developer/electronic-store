document.addEventListener("DOMContentLoaded", function () {
  document.querySelector(".glight") && GLightbox({
    selector: ".glight",
    touchNavigation: !0,
    loop: !0
  });
  let n = {
    Gray: "./assets/images/product/product-single-gray.jpg",
    Green: "./assets/images/product/product-single-green.jpg",
    Blue: "./assets/images/product/product-single-blue.jpg",
    Red: "./assets/images/product/product-single-red.jpg"
  }; {
    var e = document.querySelectorAll("[data-label] label");
    let o = document.querySelector("#colorProductOption"),
      l = document.querySelector(".imgLoop"),
      r = document.getElementById("mainImageLink");
    0 < e.length && o && l && r && e.forEach(e => {
      e.addEventListener("click", function () {
        var e = this.getAttribute("data-label"),
          t = n[e];
        l.src = t, r.href = t, o.textContent = e
      })
    })
  } {
    e = document.querySelectorAll("[data-label] label");
    let t = document.querySelector("#colorOption");
    0 < e.length && t && e.forEach(e => {
      e.addEventListener("click", function () {
        var e = this.getAttribute("data-label");
        t.textContent = e
      })
    })
  }
});