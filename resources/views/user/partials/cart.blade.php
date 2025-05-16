<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="cartOffcanvasLabel">Your Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="cartItems">
            <!-- Cart items will be loaded here via JavaScript -->
        </div>

        <div class="text-center py-5" id="emptyCartMessage">
            @include('user.svgs.empty-cart-svg')
            <h5 class="mt-3">Your cart is empty</h5>
            <p class="text-muted">Add items to your cart to continue shopping</p>
        </div>

        <div id="totalAmountContainer" style="display: none;">
            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal</span>
                <span id="totalAmount">$0.00</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Shipping</span>
                <span>Free</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-3">
                <strong>Total</strong>
                <strong id="cartTotalAmount">$0.00</strong>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('cart.index') }}" class="btn btn-outline-dark">View Cart</a>
                <a href="{{ route('checkout') }}" class="btn btn-dark">Checkout</a>
            </div>
        </div>
    </div>
</div>
<div class="toast-container position-fixed bottom-0 start-0 p-3">
    <div id="itemAddedToast" class="toast bg-warning-subtle border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="toast-header bg-warning-subtle border-warning border-opacity-25">
            <strong class="me-auto">Cart</strong>
            <small>Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">Your item is added.</div>
    </div>
</div>
