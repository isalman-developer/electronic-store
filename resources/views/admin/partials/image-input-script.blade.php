<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('previewContainer');
        const dropZone = document.querySelector('.drop-zone');

        // Add "Add More" button
        const addMoreBtn = document.createElement('button');
        addMoreBtn.className = 'add-more-btn';
        addMoreBtn.type = 'button';
        addMoreBtn.innerHTML = `+ Add More Images`;
        addMoreBtn.style.display = 'none';
        previewContainer.parentNode.insertBefore(addMoreBtn, previewContainer.nextSibling);

        function toggleUploadUI() {
            const hasImages = previewContainer.children.length > 0;

            if (hasImages) {
                uploadArea.style.display = 'none';
                addMoreBtn.style.display = 'block';
            } else {
                uploadArea.style.display = 'block';
                addMoreBtn.style.display = 'none';
            }
        }

        // Click to trigger file input
        dropZone.addEventListener('click', function() {
            fileInput.click();
        });

        addMoreBtn.addEventListener('click', function() {
            fileInput.click();
        });

        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function() {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('dragover');

            if (e.dataTransfer.files.length) {
                handleFiles(e.dataTransfer.files);
            }
        });

        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (!file.type.match('image.*')) {
                    continue;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    const preview = createImagePreview(e.target.result);
                    previewContainer.appendChild(preview);
                    toggleUploadUI();
                };

                reader.readAsDataURL(file);
            }
        }

        function createImagePreview(src) {
            const preview = document.createElement('div');
            preview.className = 'image-preview';

            const img = document.createElement('img');
            img.src = src;
            img.className = 'preview-img';

            const removeBtn = document.createElement('button');
            removeBtn.className = 'remove-btn';
            removeBtn.innerText = 'X';

            removeBtn.addEventListener('click', function() {
                preview.remove();
                toggleUploadUI();
            });

            preview.appendChild(img);
            preview.appendChild(removeBtn);

            return preview;
        }

        toggleUploadUI();
    });
</script>
