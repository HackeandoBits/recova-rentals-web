<?php

// Paths
$sourcePath = 'c:\laragon\www\recova-rentals-cliente\public\images\branding\recova-edificio-logo-body.png';
$destPath = 'c:\laragon\www\recova-rentals-cliente\public\images\branding\recova-favicon.png';

// Dimensions
$size = 1024; // Output size (square)

// Load source
$src = imagecreatefrompng($sourcePath);
$srcW = imagesx($src);
$srcH = imagesy($src);

// Calculate aspect ratio and new dimensions
// Max width logic
$newW = $size;
$newH = ($srcH / $srcW) * $size;

// Create destination image (Square)
$dest = imagecreatetruecolor($size, $size);

// Colors
$black = imagecolorallocate($dest, 0, 0, 0); // Solid Black
imagefill($dest, 0, 0, $black);

// Calc Center Y
$destY = ($size - $newH) / 2;

// Resize and Copy
// imagecopyresampled ( dst_image , src_image , dst_x , dst_y , src_x , src_y , dst_w , dst_h , src_w , src_h )
imagecopyresampled($dest, $src, 0, $destY, 0, 0, $newW, $newH, $srcW, $srcH);

// Save
imagepng($dest, $destPath);
imagedestroy($src);
imagedestroy($dest);

echo "Favicon generated successfully at $destPath";
