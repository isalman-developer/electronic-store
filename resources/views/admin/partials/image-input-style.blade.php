<style>
    .image-upload-container {
        max-width: 100vw;
        margin: 0 auto;
    }

    .upload-area {
        border: 2px dashed #ccc;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
        transition: border-color 0.3s ease;
    }

    .upload-area.dragover {
        border-color: #ff6b00;
        background-color: rgba(255, 107, 0, 0.05);
    }

    .upload-area.hidden {
        display: none;
    }

    .drop-zone {
        cursor: pointer;
    }

    .icon-container {
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .upload-icon {
        width: 48px;
        height: 48px;
        stroke: #ff6b00;
    }

    .drop-text {
        font-size: 18px;
        color: #333;
        margin-bottom: 10px;
    }

    .browse-text {
        color: #ff6b00;
        font-weight: bold;
    }

    .file-info {
        font-size: 14px;
        color: #666;
    }

    .file-input {
        opacity: 0;
        position: absolute;
        width: 1px;
        height: 1px;
    }

    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .image-preview {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 8px;
        overflow: hidden;
    }

    .preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .image-preview:hover .remove-btn {
        opacity: 1;
    }

    .remove-icon {
        width: 14px;
        height: 14px;
        stroke: #ff3b30;
    }

    .add-more-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 8px 16px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        color: #495057;
        font-size: 14px;
        cursor: pointer;
        margin-top: 10px;
        transition: background-color 0.2s ease;
    }

    .add-more-btn:hover {
        background-color: #e9ecef;
    }

    .add-more-icon {
        width: 16px;
        height: 16px;
        stroke: #495057;
    }
</style>
