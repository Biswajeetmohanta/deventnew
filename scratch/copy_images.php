<?php
$src1 = 'C:\Users\biswa\.gemini\antigravity\brain\8e91fa6f-cafe-4267-adb0-28704fec0c34\tech_bg_1_1778494323596.png';
$src2 = 'C:\Users\biswa\.gemini\antigravity\brain\8e91fa6f-cafe-4267-adb0-28704fec0c34\industry_bg_1_1778494347725.png';
$src3 = 'C:\Users\biswa\.gemini\antigravity\brain\8e91fa6f-cafe-4267-adb0-28704fec0c34\code_bg_1_1778494368670.png';

$dest_dir = __DIR__ . '/../storage/app/public/demo';
if (!is_dir($dest_dir)) {
    mkdir($dest_dir, 0777, true);
}

copy($src1, $dest_dir . '/tech_bg.png');
copy($src2, $dest_dir . '/industry_bg.png');
copy($src3, $dest_dir . '/code_bg.png');

echo "Images copied successfully to storage/app/public/demo/\n";
