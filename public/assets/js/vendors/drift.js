document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".drift").forEach(e => {
    var n = JSON.parse(e.getAttribute("data-zoom-options"));
    new Drift(e, {
      paneContainer: document.querySelector(n.paneSelector),
      inlinePane: n.inlinePane,
      hoverDelay: n.hoverDelay,
      touchDisable: n.touchDisable,
      containInline: !0
    })
  })
});