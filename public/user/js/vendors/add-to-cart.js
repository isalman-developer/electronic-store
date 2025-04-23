let quickBuyCountElem = document.getElementById("quickBuyCount"),
  cartItemsContainer = document.getElementById("cartItems"),
  totalAmountElem = document.getElementById("totalAmount"),
  totalAmountContainer = document.getElementById("totalAmountContainer"),
  emptyCartMessage = document.getElementById("emptyCartMessage"),
  quickBuyCount = 0,
  totalAmount = 0;

function updateQuickBuyCount() {
  quickBuyCountElem.textContent = quickBuyCount
}

function updateTotalAmount() {
  totalAmountElem.textContent = "$" + totalAmount.toFixed(2)
}

function calculateTotalAmount() {
  totalAmount = 0, document.querySelectorAll(".cart-item").forEach(t => {
    var e = parseInt(t.querySelector(".quantity-input").value),
      t = parseFloat(t.getAttribute("data-product-price"));
    totalAmount += e * t
  }), updateTotalAmount(), checkCartEmpty()
}

function removeCartItem(t) {
  var e = parseInt(t.querySelector(".quantity-input").value);
  quickBuyCount -= e, t.remove(), calculateTotalAmount(), updateQuickBuyCount()
}

function checkCartEmpty() {
  0 === cartItemsContainer.children.length ? (emptyCartMessage.style.display = "block", totalAmountContainer.style.display = "none") : (emptyCartMessage.style.display = "none", totalAmountContainer.style.display = "flex")
}

function findCartItem(e) {
  return Array.from(cartItemsContainer.children).find(t => t.querySelector("h6").textContent === e)
}
let quickAddButtons = document.querySelectorAll(".quick-add-btn");
quickAddButtons.forEach(e => {
  e.addEventListener("click", function (t) {
    t.preventDefault();
    var t = e.getAttribute("data-product-name"),
      n = parseFloat(e.getAttribute("data-product-price")),
      u = e.getAttribute("data-product-img"),
      a = findCartItem(t);
    if (a) {
      a = a.querySelector(".quantity-input");
      a.value = parseInt(a.value) + 1, quickBuyCount++, calculateTotalAmount(), updateQuickBuyCount()
    } else {
      quickBuyCount++, updateQuickBuyCount();
      a = `
              <div class="d-flex mb-3 align-items-start cart-item gap-4 border-bottom pb-3" data-product-price="${n}">
                <img src="${u}" alt="${t}" class="img-fluid  col-2 border" />
                <div class="me-auto">
                  <h6 class="mb-1">${t}</h6>
                  <div>$${n.toFixed(2)}</div>
                 <div class="d-inline-flex align-items-center mt-2 border p-2">
									<button class="btn btn-icon btn-xs btn-focus-none quantity-btn minus fs-5">-</button>
									<input type="number" class="form-control quantity-input text-center mx-1 p-0 border-0" value="1" min="1" style="width: 40px">
									<button class="btn btn-icon btn-xs btn-focus-none quantity-btn plus fs-5">+</button>
								</div>
                </div>
                <button class="btn btn-danger btn-sm remove-item-btn">
                  Remove
                </button>
              </div>
            `;
      cartItemsContainer.insertAdjacentHTML("beforeend", a), calculateTotalAmount(), new bootstrap.Offcanvas(document.getElementById("cartOffcanvas")).show();
      let e = cartItemsContainer.lastElementChild;
      e.querySelector(".plus").addEventListener("click", function () {
        var t = e.querySelector(".quantity-input");
        t.value = parseInt(t.value) + 1, quickBuyCount++, calculateTotalAmount(), updateQuickBuyCount()
      }), e.querySelector(".minus").addEventListener("click", function () {
        var t = e.querySelector(".quantity-input");
        1 < parseInt(t.value) && (t.value = parseInt(t.value) - 1, quickBuyCount--, calculateTotalAmount(), updateQuickBuyCount())
      }), e.querySelector(".remove-item-btn").addEventListener("click", function () {
        removeCartItem(e)
      })
    }
    checkCartEmpty(), new bootstrap.Toast(document.getElementById("itemAddedToast")).show()
  })
}), checkCartEmpty();