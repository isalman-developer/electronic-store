// Order Timeline JS
document.addEventListener('DOMContentLoaded', function() {
    // Resend invoice button click handler
    const resendButtons = document.querySelectorAll('.resend-invoice');
    
    resendButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const orderId = this.getAttribute('data-order-id');
            
            // Show loading state
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
            this.disabled = true;
            
            // Send AJAX request to resend invoice
            fetch(`/admin/orders/${orderId}/invoice/resend`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                // Reset button state
                this.innerHTML = 'Resend Invoice';
                this.disabled = false;
                
                // Show success message
                if (data.success) {
                    // Create toast notification
                    const toast = document.createElement('div');
                    toast.className = 'toast align-items-center text-white bg-success border-0';
                    toast.setAttribute('role', 'alert');
                    toast.setAttribute('aria-live', 'assertive');
                    toast.setAttribute('aria-atomic', 'true');
                    
                    toast.innerHTML = `
                        <div class="d-flex">
                            <div class="toast-body">
                                ${data.message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    `;
                    
                    document.querySelector('.toast-container').appendChild(toast);
                    
                    // Initialize and show the toast
                    const bsToast = new bootstrap.Toast(toast);
                    bsToast.show();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.innerHTML = 'Resend Invoice';
                this.disabled = false;
            });
        });
    });
});