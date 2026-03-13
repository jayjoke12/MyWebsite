<?php
session_start();

// get username
if(!isset($_SESSION['username'])) {
    echo "❌ You must be logged in to upload a page.";
    exit;
}

$username = $_SESSION['username'];

// destination dir
$uploadDir = __DIR__ . "/pages/users/" . $username . "/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (!isset($_FILES['userfile'])) {
    echo "❌ No file uploaded.";
    exit;
}

$fileTmp  = $_FILES['userfile']['tmp_name'];
$fileName = basename($_FILES['userfile']['name']);

// Force .html
$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
if ($ext !== "html") {
    echo "❌ Only .html uploads allowed.";
    exit;
}

$savePath = $uploadDir . $fileName;

// read uploaded content
$content = file_get_contents($fileTmp);

// append footer link
$pageUrl = "http://tingler.farted.net/?page=users/$username/$fileName";

$footer = "\n\n<!-- auto-footer -->\n".
          "<p style=\"color: grey; font-size: 12px; margin-top: 20px;\">PAGEURL: $pageUrl</p>";

$content .= $footer;

// save final file with footer appended
file_put_contents($savePath, $content);

echo "✅ Page uploaded successfully!<br>";
echo "<a href='?page=users/$username/$fileName'>View your page</a>";
