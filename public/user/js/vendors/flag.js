function changeCurrency(e, n, t) {
  document.getElementById("current-currency").innerText = n + " " + ("USD" === n ? "$" : "EUR" === n ? "€" : "£"), document.getElementById("current-flag").src = t
}
document.getElementById("currencyDropdown").addEventListener("click", function () {
  let e = document.getElementById("arrowIcon");
  this.addEventListener("shown.bs.dropdown", function () {
    e.classList.remove("bi-chevron-down"), e.classList.add("bi-chevron-up")
  }), this.addEventListener("hidden.bs.dropdown", function () {
    e.classList.remove("bi-chevron-up"), e.classList.add("bi-chevron-down")
  })
});