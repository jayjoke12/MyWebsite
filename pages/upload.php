<?php
// Handle upload when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $uploadDir = __DIR__ . '/../uploaded/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!isset($_POST['username']) || !isset($_FILES['photo'])) {
        $message = "Form not submitted correctly.";
    } else {
        $name = trim($_POST['username']);
        $file = $_FILES['photo'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $message = "Upload error: " . $file['error'];
        } else {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

            $cleanName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $name);

            $targetFile = $uploadDir . $cleanName . "." . $ext;
            $counter = 1;

            while (file_exists($targetFile)) {
                $targetFile = $uploadDir . $cleanName . "_" . $counter . "." . $ext;
                $counter++;
            }

            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                $message = "Uploaded successfully! 😘";
            } else {
                $message = "Upload failed.";
            }
        }
    }
}
?>

<style>

.upload-box {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;

    background: rgba(255, 255, 255, 0.75);
    border: 3px solid #000;
    border-radius: 12px;
    padding: 20px;

    font-family: MyFont;
    overflow: hidden;
}

.upload-box h2 {
    margin-top: 0;
    font-size: 26px;
    text-align: center;
}

.upload-box label {
    display: block;
    margin: 12px 0 6px;
    font-size: 18px;
}

.upload-box input[type="text"],
.upload-box input[type="file"] {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;

    padding: 10px;
    border: 2px solid #000;
    border-radius: 8px;
    background: #fff;
    font-size: 16px;
}

.upload-box button {
    margin-top: 18px;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;

    padding: 12px;
    font-size: 18px;

    background: #000;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.2s ease;
}

.upload-box button:hover {
    transform: scale(1.04);
    background: #222;
}

.upload-message {
    margin-top: 20px;
    padding: 12px;
    text-align: center;
    border-radius: 10px;
    background: #f3f3f3;
    font-size: 18px;
    border: 2px solid #000;

    width: 100%;
    box-sizing: border-box;
}
</style>

<div class="upload-box">
    <h2>Images</h2>

    <form action="/pages/uploader.php" method="POST" enctype="multipart/form-data">
        <label>Username (and custom sizing if desired):</label>
        <input type="text" name="username" required>
        Example: jayjoke9x3 or jayjoke3x9 (w x h) max maps is 27

        <label>Select Photo:</label>
        <input type="file" name="photo" accept="image/*" required>

        <button type="submit">Upload</button>
    </form>

    <?php if (!empty($message)): ?>
        <div class="upload-message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
</div>
