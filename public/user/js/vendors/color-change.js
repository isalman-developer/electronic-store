function initColorSwatchListener() {
    const colorOptionLabel = document.getElementById('colorOption');
    const colorInputs = document.querySelectorAll('input[name="colors"]');

    if (!colorOptionLabel || colorInputs.length === 0) return;

    colorInputs.forEach(input => {
        input.addEventListener('change', function () {
            const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
            const colorTitle = selectedLabel?.getAttribute('data-label') || 'N/A';
            colorOptionLabel.textContent = colorTitle;
        });
    });
}
