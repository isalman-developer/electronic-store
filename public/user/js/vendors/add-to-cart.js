// Debug: Log when script loads
console.log('add-to-cart.js loaded');

document.addEventListener("DOMContentLoaded", function () {
    // Get DOM elements
    const quickBuyCountElem = document.getElementById("quickBuyCount");
    const cartItemsContainer = document.getElementById("cartItems");
    const totalAmountElem = document.getElementById("totalAmount");
    const cartTotalAmountElem = document.getElementById("cartTotalAmount");
    const totalAmountContainer = document.getElementById("totalAmountContainer");
    const emptyCartMessage = document.getElementById("emptyCartMessage");

    // Initialize cart variables
    let quickBuyCount = 0;
    let totalAmount = 0;

    // Load cart from localStorage
    function loadCart() {
        console.log('Loading cart from localStorage');
        const savedItems = localStorage.getItem('cartItems');
        const savedCount = localStorage.getItem('quickBuyCount');

        if (savedItems && savedCount) {
            console.log('Found saved items:', savedItems);
            const items = JSON.parse(savedItems);
            quickBuyCount = parseInt(savedCount);

            // Update cart count in navbar
            if (quickBuyCountElem) {
                quickBuyCountElem.textContent = quickBuyCount;
                quickBuyCountElem.style.display = quickBuyCount > 0 ? 'inline-block' : 'none';
            }

            // If cart offcanvas elements exist, update them
            if (cartItemsContainer && emptyCartMessage && totalAmountContainer) {
                // Clear existing items
                cartItemsContainer.innerHTML = '';

                // Calculate total
                totalAmount = 0;

                if (items.length > 0) {
                    // Hide empty cart message and show total container
                    emptyCartMessage.style.display = 'none';
                    totalAmountContainer.style.display = 'block';

                    // Add each item to cart
                    items.forEach((item, index) => {
                        const itemTotal = item.price * item.quantity;
                        totalAmount += itemTotal;

                        const cartItemElem = document.createElement('div');
                        cartItemElem.className = 'cart-item d-flex align-items-center mb-3 pb-3 border-bottom';
                        cartItemElem.setAttribute('data-product-price', item.price);
                        cartItemElem.setAttribute('data-index', index);

                        cartItemElem.innerHTML = `
                            <img src="${item.image}" alt="${item.name}" class="img-fluid me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">${item.name}</h6>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-link text-dark p-0 quantity-minus">−</button>
                                        <input type="number" class="form-control form-control-sm text-center mx-2 quantity-input" 
                                            value="${item.quantity}" min="1" style="width: 40px;">
                                        <button class="btn btn-sm btn-link text-dark p-0 quantity-plus">+</button>
                                    </div>
                                    <div>
                                        <span class="fw-bold">$${itemTotal.toFixed(2)}</span>
                                        <button class="btn btn-sm text-danger ms-2 remove-item">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;

                        cartItemsContainer.appendChild(cartItemElem);

                        // Add event listeners for this item
                        const quantityInput = cartItemElem.querySelector('.quantity-input');
                        const minusBtn = cartItemElem.querySelector('.quantity-minus');
                        const plusBtn = cartItemElem.querySelector('.quantity-plus');
                        const removeBtn = cartItemElem.querySelector('.remove-item');

                        quantityInput.addEventListener('change', function () {
                            updateItemQuantity(index, parseInt(this.value) || 1);
                        });

                        minusBtn.addEventListener('click', function () {
                            const currentQty = parseInt(quantityInput.value);
                            if (currentQty > 1) {
                                quantityInput.value = currentQty - 1;
                                updateItemQuantity(index, currentQty - 1);
                            }
                        });

                        plusBtn.addEventListener('click', function () {
                            const currentQty = parseInt(quantityInput.value);
                            quantityInput.value = currentQty + 1;
                            updateItemQuantity(index, currentQty + 1);
                        });

                        removeBtn.addEventListener('click', function () {
                            removeItem(index);
                        });
                    });

                    // Update total amount
                    if (totalAmountElem) totalAmountElem.textContent = '$' + totalAmount.toFixed(2);
                    if (cartTotalAmountElem) cartTotalAmountElem.textContent = '$' + totalAmount.toFixed(2);
                } else {
                    // Show empty cart message and hide total container
                    emptyCartMessage.style.display = 'block';
                    totalAmountContainer.style.display = 'none';
                }
            }
        } else {
            console.log('No saved items found');
            // Initialize empty cart
            quickBuyCount = 0;
            totalAmount = 0;

            // Update cart count in navbar
            if (quickBuyCountElem) {
                quickBuyCountElem.textContent = '0';
                quickBuyCountElem.style.display = 'none';
            }

            // Show empty cart message and hide total container
            if (emptyCartMessage && totalAmountContainer) {
                emptyCartMessage.style.display = 'block';
                totalAmountContainer.style.display = 'none';
            }

            // Clear cart items
            if (cartItemsContainer) {
                cartItemsContainer.innerHTML = '';
            }
        }
    }

    // Update item quantity
    function updateItemQuantity(index, newQuantity) {
        const savedItems = JSON.parse(localStorage.getItem('cartItems'));

        if (savedItems && savedItems[index]) {
            // Update quantity
            savedItems[index].quantity = newQuantity;

            // Recalculate total count
            quickBuyCount = savedItems.reduce((sum, item) => sum + item.quantity, 0);

            // Save to localStorage
            localStorage.setItem('cartItems', JSON.stringify(savedItems));
            localStorage.setItem('quickBuyCount', quickBuyCount);

            // Reload cart
            loadCart();
        }
    }

    // Remove item from cart
    function removeItem(index) {
        const savedItems = JSON.parse(localStorage.getItem('cartItems'));

        if (savedItems && savedItems[index]) {
            // Remove item
            savedItems.splice(index, 1);

            // Recalculate total count
            quickBuyCount = savedItems.reduce((sum, item) => sum + item.quantity, 0);

            // Save to localStorage
            localStorage.setItem('cartItems', JSON.stringify(savedItems));
            localStorage.setItem('quickBuyCount', quickBuyCount);

            // Reload cart
            loadCart();
        }
    }

    // Add item to cart
    function addToCart(ProductId, name, price, image, quantity = 1) {
        console.log('Adding to cart:', ProductId, name, price, image, quantity);

        // Get existing items or initialize empty array
        const savedItems = localStorage.getItem('cartItems');
        let items = savedItems ? JSON.parse(savedItems) : [];

        // Check if item already exists in cart
        const existingItemIndex = items.findIndex(item => item.ProductId === ProductId);

        if (existingItemIndex !== -1) {
            // Update quantity if item exists
            items[existingItemIndex].quantity += quantity;
        } else {
            // Add new item
            items.push({
                ProductId: ProductId,
                name: name,
                price: price,
                image: image,
                quantity: quantity
            });
        }

        // Calculate total count
        quickBuyCount = items.reduce((sum, item) => sum + item.quantity, 0);

        // Save to localStorage
        localStorage.setItem('cartItems', JSON.stringify(items));
        localStorage.setItem('quickBuyCount', quickBuyCount);

        // Reload cart
        loadCart();

        // Show toast notification
        const toast = new bootstrap.Toast(document.getElementById('itemAddedToast'));
        toast.show();

        // Show cart offcanvas
        const cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
        cartOffcanvas.show();
    }

    // Add event listeners to quick add buttons
    document.querySelectorAll('.quick-add-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const ProductId = this.getAttribute('data-product-id');
            const name = this.getAttribute('data-product-name');
            const price = parseFloat(this.getAttribute('data-product-price'));
            const image = this.getAttribute('data-product-img');

            addToCart(ProductId, name, price, image, 1);
        });
    });

    // Initial load
    loadCart();
});
