document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quick View Modal
    const quickViewModal = new bootstrap.Modal(document.getElementById('quickViewModal'));

    // Handle Quick View Button Click
    document.querySelectorAll('.quick-view-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;

            // Show loading state
            document.getElementById('quickViewContent').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div></div>';
            quickViewModal.show();

            // Fetch product details
            fetch(`/products/${productId}/quick-view`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('quickViewContent').innerHTML = data.html;
                        initializeGallery();
                        initializeQuantityButtons();
                        initColorSwatchListener();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('quickViewContent').innerHTML = '<div class="text-center text-danger">Error loading product details</div>';
                });
        });
    });

    // Initialize Swiper Gallery
    function initializeGallery() {
        new Swiper('.product-gallery', {
            slidesPerView: 1,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            }
        });
    }

    // Initialize Quantity Buttons
    function initializeQuantityButtons() {
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.quantity-input');
                const currentValue = parseInt(input.value);

                if (this.classList.contains('plus')) {
                    input.value = currentValue + 1;
                } else if (this.classList.contains('minus') && currentValue > 1) {
                    input.value = currentValue - 1;
                }
            });
        });
    }
});
