<?php
session_start();
$new_user = $_POST['new_username'] ?? '';
$new_pass = $_POST['new_password'] ?? '';

if($new_user && $new_pass){
    // Simple file-based user store (replace with DB for production)
    $users_file = 'users.json';
    $users = file_exists($users_file) ? json_decode(file_get_contents($users_file), true) : [];

    if(isset($users[$new_user])){
        echo "<script>alert('Username already exists');window.location='index.php';</script>";
    } else {
        $users[$new_user] = password_hash($new_pass, PASSWORD_DEFAULT);
        file_put_contents($users_file, json_encode($users, JSON_PRETTY_PRINT));
        echo "<script>alert('Account created');window.location='index.php';</script>";
    }
} else {
    header("Location: index.php");
    exit;
}
