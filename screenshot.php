<?php
/**
 * Generate theme screenshot
 * 
 * This script generates a theme screenshot showing the structure and key features.
 * Run this script once to create the screenshot, then delete it.
 */

// Set up the image
$width = 1200;
$height = 900;
$image = imagecreatetruecolor($width, $height);

// Colors
$bg = imagecolorallocate($image, 245, 245, 245);  // Light gray background
$text = imagecolorallocate($image, 33, 33, 33);   // Dark text
$accent = imagecolorallocate($image, 255, 71, 71); // Accent color from theme
$white = imagecolorallocate($image, 255, 255, 255);

// Fill background
imagefilledrectangle($image, 0, 0, $width, $height, $bg);

// Add header area
imagefilledrectangle($image, 0, 0, $width, 100, $white);
imagerectangle($image, 0, 0, $width-1, 100, $accent);

// Add theme name
$font_path = __DIR__ . '/assets/fonts/PlayfairDisplay-Bold.ttf';
if (file_exists($font_path)) {
    imagettftext($image, 32, 0, 50, 65, $text, $font_path, 'Katie Bray Portfolio');
} else {
    imagestring($image, 5, 50, 40, 'Katie Bray Portfolio', $text);
}

// Add features list
$features = array(
    'Modern WordPress Theme',
    'Built with Tailwind CSS',
    'Custom Workshop Management',
    'Responsive Design',
    'Contact Form Integration',
    'Portfolio Showcase'
);

$y = 150;
foreach ($features as $feature) {
    if (file_exists($font_path)) {
        imagettftext($image, 20, 0, 50, $y, $text, $font_path, '• ' . $feature);
    } else {
        imagestring($image, 3, 50, $y-15, '• ' . $feature, $text);
    }
    $y += 50;
}

// Add preview boxes
$preview_width = 300;
$preview_height = 200;
$x = 50;
$y = 450;

// Homepage preview
imagefilledrectangle($image, $x, $y, $x+$preview_width, $y+$preview_height, $white);
imagerectangle($image, $x, $y, $x+$preview_width, $y+$preview_height, $accent);
if (file_exists($font_path)) {
    imagettftext($image, 16, 0, $x+20, $y+40, $text, $font_path, 'Homepage');
} else {
    imagestring($image, 3, $x+20, $y+20, 'Homepage', $text);
}

// Workshops preview
$x += $preview_width + 50;
imagefilledrectangle($image, $x, $y, $x+$preview_width, $y+$preview_height, $white);
imagerectangle($image, $x, $y, $x+$preview_width, $y+$preview_height, $accent);
if (file_exists($font_path)) {
    imagettftext($image, 16, 0, $x+20, $y+40, $text, $font_path, 'Workshops');
} else {
    imagestring($image, 3, $x+20, $y+20, 'Workshops', $text);
}

// Contact preview
$x += $preview_width + 50;
imagefilledrectangle($image, $x, $y, $x+$preview_width, $y+$preview_height, $white);
imagerectangle($image, $x, $y, $x+$preview_width, $y+$preview_height, $accent);
if (file_exists($font_path)) {
    imagettftext($image, 16, 0, $x+20, $y+40, $text, $font_path, 'Contact');
} else {
    imagestring($image, 3, $x+20, $y+20, 'Contact', $text);
}

// Add footer text
$footer_text = 'A WordPress theme for creative professionals';
if (file_exists($font_path)) {
    imagettftext($image, 18, 0, 50, $height-50, $text, $font_path, $footer_text);
} else {
    imagestring($image, 3, 50, $height-70, $footer_text, $text);
}

// Save the image
imagepng($image, __DIR__ . '/screenshot.png');
imagedestroy($image);

echo "Screenshot generated successfully!\n";
