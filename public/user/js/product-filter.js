document.addEventListener('DOMContentLoaded', function () {
    // Initialize from URL parameters
    initializeFromUrl();
    updateActiveFilters();

    // Color filters
    const colorsFilters = document.querySelectorAll('.color-filter');
    colorsFilters.forEach(colorFilter => {
        colorFilter.addEventListener('change', function () {
            applyFilters();
        });
    });

    // Price range filters
    const minPriceInput = document.querySelector('#minPrice');
    const maxPriceInput = document.querySelector('#maxPrice');

    if (minPriceInput) {
        minPriceInput.addEventListener('change', function () {
            applyFilters();
        });
    }

    if (maxPriceInput) {
        maxPriceInput.addEventListener('change', function () {
            applyFilters();
        });
    }

    // Rating filters
    const ratingFilters = document.querySelectorAll('input[name="rating"]');
    ratingFilters.forEach(filter => {
        filter.addEventListener('change', function () {
            applyFilters();
        });
    });

    // Sort select
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
        sortSelect.addEventListener('change', function () {
            applyFilters();
        });
    }

    // Filter tag removal
    function setupFilterTagListeners() {
        const filterTags = document.querySelectorAll('.filter-tag');
        filterTags.forEach(tag => {
            tag.addEventListener('click', function () {
                const filterType = this.dataset.filter;
                const filterValue = this.dataset.value;

                if (filterType === 'color' && filterValue) {
                    // Uncheck specific color
                    const colorCheckbox = document.querySelector(`input[value="${filterValue}"]`);
                    if (colorCheckbox) colorCheckbox.checked = false;
                } else if (filterType === 'price') {
                    // Clear price inputs
                    const minPriceEl = document.getElementById('minPrice');
                    const maxPriceEl = document.getElementById('maxPrice');
                    if (minPriceEl) minPriceEl.value = '';
                    if (maxPriceEl) maxPriceEl.value = '';
                } else if (filterType === 'rating') {
                    // Uncheck rating
                    const checkedRating = document.querySelector('input[name="rating"]:checked');
                    if (checkedRating) checkedRating.checked = false;
                } else if (filterType === 'sort') {
                    // Reset sort
                    const sortSelect = document.getElementById('sortSelect');
                    if (sortSelect) sortSelect.value = '';
                }

                applyFilters();
            });
        });
    }

    // Set up initial filter tag listeners
    setupFilterTagListeners();

    // Function to initialize filters from URL
    function initializeFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);

        // Set colors from URL
        if (urlParams.has('colors')) {
            const colors = urlParams.get('colors').split('-');
            colors.forEach(color => {
                const checkbox = document.querySelector(`input[value="${color}"]`);
                if (checkbox) checkbox.checked = true;
            });
        }

        // Set price range from URL
        if (urlParams.has('price')) {
            const priceRange = urlParams.get('price').split('-');
            const minPriceEl = document.getElementById('minPrice');
            const maxPriceEl = document.getElementById('maxPrice');

            if (priceRange[0] && minPriceEl) minPriceEl.value = priceRange[0];
            if (priceRange.length > 1 && priceRange[1] && maxPriceEl) maxPriceEl.value = priceRange[1];
        } else {
            const minPriceEl = document.getElementById('minPrice');
            const maxPriceEl = document.getElementById('maxPrice');

            if (urlParams.has('min_price') && minPriceEl) minPriceEl.value = urlParams.get('min_price');
            if (urlParams.has('max_price') && maxPriceEl) maxPriceEl.value = urlParams.get('max_price');
        }

        // Set rating from URL
        if (urlParams.has('rating')) {
            const rating = urlParams.get('rating');
            const ratingInput = document.querySelector(`input[name="rating"][value="${rating}"]`);
            if (ratingInput) ratingInput.checked = true;
        }

        // Set sort from URL
        if (urlParams.has('sort')) {
            const sortValue = urlParams.get('sort');
            const sortSelect = document.getElementById('sortSelect');
            if (sortSelect) {
                const sortOption = sortSelect.querySelector(`option[value="${sortValue}"]`);
                if (sortOption) sortOption.selected = true;
            }
        }
    }

    // Function to update active filters display
    function updateActiveFilters() {
        const activeFiltersContainer = document.getElementById('active-filters');
        if (!activeFiltersContainer) return;

        // Clear existing filter tags
        activeFiltersContainer.innerHTML = '';

        // Add color filter tags
        const selectedColors = document.querySelectorAll('.color-filter:checked');
        selectedColors.forEach(colorCheckbox => {
            const colorSlug = colorCheckbox.value;
            const colorTitle = colorCheckbox.nextElementSibling.textContent.trim();

            const filterTag = document.createElement('button');
            filterTag.type = 'button';
            filterTag.className = 'btn btn-sm btn-light d-flex align-items-center gap-2 filter-tag';
            filterTag.dataset.filter = 'color';
            filterTag.dataset.value = colorSlug;
            filterTag.innerHTML = `${colorTitle} <i class="bi bi-x lh-1"></i>`;

            activeFiltersContainer.appendChild(filterTag);
        });

        // Add price filter tag if price inputs have values
        const minPrice = document.getElementById('minPrice')?.value;
        const maxPrice = document.getElementById('maxPrice')?.value;

        if (minPrice || maxPrice) {
            const filterTag = document.createElement('button');
            filterTag.type = 'button';
            filterTag.className = 'btn btn-sm btn-light d-flex align-items-center gap-2 filter-tag';
            filterTag.dataset.filter = 'price';
            filterTag.innerHTML = `$${minPrice || '0'} ${maxPrice ? ' - $' + maxPrice : ''} <i class="bi bi-x lh-1"></i>`;

            activeFiltersContainer.appendChild(filterTag);
        }

        // Add rating filter tag if a rating is selected
        const selectedRating = document.querySelector('input[name="rating"]:checked');
        if (selectedRating) {
            const ratingValue = selectedRating.value;

            const filterTag = document.createElement('button');
            filterTag.type = 'button';
            filterTag.className = 'btn btn-sm btn-light d-flex align-items-center gap-2 filter-tag';
            filterTag.dataset.filter = 'rating';
            filterTag.innerHTML = `${ratingValue}⭐ & Up <i class="bi bi-x lh-1"></i>`;

            activeFiltersContainer.appendChild(filterTag);
        }

        // Add sort filter tag if sort is selected
        const sortSelect = document.getElementById('sortSelect');
        if (sortSelect && sortSelect.value) {
            const sortValue = sortSelect.value;
            const sortText = sortSelect.options[sortSelect.selectedIndex].text;

            const filterTag = document.createElement('button');
            filterTag.type = 'button';
            filterTag.className = 'btn btn-sm btn-light d-flex align-items-center gap-2 filter-tag';
            filterTag.dataset.filter = 'sort';
            filterTag.dataset.value = sortValue;
            filterTag.innerHTML = `Sort: ${sortText} <i class="bi bi-x lh-1"></i>`;

            activeFiltersContainer.appendChild(filterTag);
        }

        // Add clear all button if there are any filters
        if (selectedColors.length > 0 || minPrice || maxPrice || selectedRating || (sortSelect && sortSelect.value)) {
            const clearAllBtn = document.createElement('button');
            clearAllBtn.type = 'button';
            clearAllBtn.id = 'clearFilters';
            clearAllBtn.className = 'btn btn-sm btn-focus-none';
            clearAllBtn.textContent = 'Clear all';

            activeFiltersContainer.appendChild(clearAllBtn);

            // Add event listener to the new clear all button
            clearAllBtn.addEventListener('click', clearAllFilters);
        }

        // Set up listeners for the new filter tags
        setupFilterTagListeners();
    }

    // Function to clear all filters
    function clearAllFilters() {
        // Uncheck all color checkboxes
        document.querySelectorAll('.color-filter:checked').forEach(checkbox => {
            checkbox.checked = false;
        });

        // Reset price inputs
        const minPriceEl = document.getElementById('minPrice');
        const maxPriceEl = document.getElementById('maxPrice');
        if (minPriceEl) minPriceEl.value = '';
        if (maxPriceEl) maxPriceEl.value = '';

        // Uncheck all rating radio buttons
        const checkedRating = document.querySelector('input[name="rating"]:checked');
        if (checkedRating) checkedRating.checked = false;

        // Reset sort select
        const sortSelect = document.getElementById('sortSelect');
        if (sortSelect) sortSelect.value = '';

        // Update active filters display
        updateActiveFilters();

        // Apply empty filters
        applyFilters();
    }

    // Apply filters function
    function applyFilters() {
        // Update active filters display first
        updateActiveFilters();

        // Get base URL (current URL without query parameters)
        const baseUrl = window.location.href.split('?')[0];
        let url = new URL(baseUrl);

        // Get selected colors
        const selectedColors = [];
        document.querySelectorAll('.color-filter:checked').forEach(checkbox => {
            selectedColors.push(checkbox.value);
        });

        // Add colors to URL if any are selected
        if (selectedColors.length > 0) {
            url.searchParams.append('colors', selectedColors.join('-'));
        }

        // Add price range if set
        const minPriceEl = document.getElementById('minPrice');
        const maxPriceEl = document.getElementById('maxPrice');
        const minPrice = minPriceEl.value;
        const maxPrice = maxPriceEl.value;

        if (minPrice && maxPrice) {
            url.searchParams.append('price', `${minPrice}-${maxPrice}`);
        } else if (minPrice) {
            url.searchParams.append('price', `${minPrice}`);
        } else if (maxPrice) {
            url.searchParams.append('price', `0-${maxPrice}`);
        }

        // Add rating if selected
        const selectedRating = document.querySelector('input[name="rating"]:checked');
        if (selectedRating) {
            url.searchParams.append('rating', selectedRating.value);
        }

        // Add sort option if selected
        const sortSelect = document.getElementById('sortSelect');
        if (sortSelect && sortSelect.value) {
            url.searchParams.append('sort', sortSelect.value);
        }

        // Show loading indicator
        const productsContainer = document.getElementById('products-container');
        if (productsContainer) {
            productsContainer.innerHTML = '<div class="col-12 text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        }

        // Make AJAX request
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                // Update products container
                if (productsContainer && data.products) {
                    productsContainer.innerHTML = data.products;
                }

                // Update URL without page reload
                window.history.pushState({}, '', url);

                // Reinitialize quick view buttons
                if (typeof initializeQuickView === 'function') {
                    initializeQuickView();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (productsContainer) {
                    productsContainer.innerHTML = '<div class="col-12"><div class="alert alert-danger">Error loading products. Please try again.</div></div>';
                }
            });
    }
});
