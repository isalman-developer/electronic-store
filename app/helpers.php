<?php

if (!function_exists('showValidationMessage')) {
    function showValidationMessage($error = null)
    {
        if ($error) {
            echo "<div class='invalid-feedback'>" . htmlspecialchars($error) . " </div>";
        }
    }
}

if (!function_exists('getImageUrl')) {
    function getImageUrl($image)
    {
        return asset('storage/' . $image->file_path) ?? asset('no-image.png');
    }
}

if (!function_exists('getSingleImageUrl')) {
    function getSingleImageUrl($object)
    {
        return count($object->media) > 0 ? asset('storage/' . $object->media->first()->file_path) : asset('no-image.png');
    }
}

if (!function_exists('getStatus')) {
    function getStatus($value)
    {
        return $value == 1 ? 'Active' : 'In-Active';
    }
}
