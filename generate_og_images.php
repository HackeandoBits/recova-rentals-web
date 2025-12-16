<?php

function createOgImage($sourcePath, $outputPath, $bgColorHex)
{
    echo "Processing $outputPath...\n";

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

    // Target Canvas
    $targetW = 1200;
    $targetH = 630;
    $canvas = imagecreatetruecolor($targetW, $targetH);

    // Parse Hex Color
    $bgColorHex = ltrim($bgColorHex, '#');
    $r = hexdec(substr($bgColorHex, 0, 2));
    $g = hexdec(substr($bgColorHex, 2, 2));
    $b = hexdec(substr($bgColorHex, 4, 2));

    $bg = imagecolorallocate($canvas, $r, $g, $b);
    imagefill($canvas, 0, 0, $bg);

    // Calculate Aspect Ratio / Scaling
    // We want some padding. Let's say max width 1000px, max height 500px.
    $maxW = 1000;
    $maxH = 500;

    $scale = min($maxW / $srcW, $maxH / $srcH);

    $newW = (int) ($srcW * $scale);
    $newH = (int) ($srcH * $scale);

    // Center it
    $dstX = (int) (($targetW - $newW) / 2);
    $dstY = (int) (($targetH - $newH) / 2);

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

// Client Image (Burgundy)
$source = 'public/images/branding/recova-edificio-logo-body.png';
$clientDest = 'public/images/branding/recova-og-image.png';
$burgundy = '#361533';
// Using the calculation: RGB from HSL(298, 42%, 15%) ~ roughly #361533 or #361633.
// I'll stick to a nice dark burgundy that matches.

createOgImage($source, $clientDest, $burgundy);

// Admin Image (Black)
$adminDest = '../recova-rentals-admin/public/images/recova-og-image.png';
createOgImage($source, $adminDest, '#111111'); // Slightly off-black for elegance
