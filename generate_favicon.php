<?php

function createFavicon($sourcePath, $outputPath, $bgColorHex)
{
    echo "Processing Favicon $outputPath...\n";

    // Load source
    if (! file_exists($sourcePath)) {
        exit("Source not found: $sourcePath\n");
    }
    $source = imagecreatefrompng($sourcePath);
    if (! $source) {
        exit("Failed to load PNG.\n");
    }

    // Get source dimensions
    $srcW = imagesx($source);
    $srcH = imagesy($source);

    // Target Canvas (Square)
    $targetSize = 128; // Good for high-DPI and regular use
    $canvas = imagecreatetruecolor($targetSize, $targetSize);

    // Parse Hex Color
    $bgColorHex = ltrim($bgColorHex, '#');
    $r = hexdec(substr($bgColorHex, 0, 2));
    $g = hexdec(substr($bgColorHex, 2, 2));
    $b = hexdec(substr($bgColorHex, 4, 2));

    $bg = imagecolorallocate($canvas, $r, $g, $b);
    imagefill($canvas, 0, 0, $bg);

    // Calculate Aspect Ratio / Scaling with Padding
    $padding = 0; // Zero padding to fill width/height
    $maxW = $targetSize - ($padding * 2);
    $maxH = $targetSize - ($padding * 2);

    $scale = min($maxW / $srcW, $maxH / $srcH);

    $newW = (int) ($srcW * $scale);
    $newH = (int) ($srcH * $scale);

    // Center it
    $dstX = (int) (($targetSize - $newW) / 2);
    $dstY = (int) (($targetSize - $newH) / 2);

    // Preserve alpha for source logo (if it has transparency)
    imagealphablending($source, true);
    // Composite
    imagecopyresampled($canvas, $source, $dstX, $dstY, 0, 0, $newW, $newH, $srcW, $srcH);

    // Save
    imagepng($canvas, $outputPath);
    echo "Saved to $outputPath\n";

    imagedestroy($source);
    imagedestroy($canvas);
}

// Config
$source = 'public/images/branding/recova-edificio-logo-body.png';
$dest = 'public/images/branding/recova-favicon.png';
$black = '#000000';

createFavicon($source, $dest, $black);
