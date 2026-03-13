<?php
// Folder to store uploads
$uploadDir = __DIR__ . '/uploaded/';

// Make sure the folder exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$name = trim($_POST['username']);
$file = $_FILES['photo'];

$ext = pathinfo($file['name'], PATHINFO_EXTENSION);

// Sanitize the name (remove weird characters)
$cleanName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $name);

// Base filename like "Jay"
$targetFile = $uploadDir . $cleanName . "." . $ext;

$counter = 1;

// If file exists, add _1, _2, _3 …
while (file_exists($targetFile)) {
    $targetFile = $uploadDir . $cleanName . "_" . $counter . "." . $ext;
    $counter++;
}

if (move_uploaded_file($file['tmp_name'], $targetFile)) {
    echo "Uploaded successfully!";
} else {
    echo "Upload failed.";
}
?>
