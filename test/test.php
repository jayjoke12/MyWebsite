<?php
session_start(); // MUST be first line

// Path to JSON file
$usersFile = __DIR__ . '/users.json';

// Load users from JSON
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

// --- LOGIN ---
if(isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if(isset($users[$username]) && password_verify($password, $users[$username])){
        $_SESSION['username'] = $username;
        header("Location: "); // refresh current page
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

// --- LOGOUT ---
if(isset($_POST['logout'])){
    session_destroy();
    header("Location: "); // refresh current page
    exit;
}

// --- REGISTER ---
if(isset($_POST['register'])){
    $newUser = $_POST['new_username'] ?? '';
    $newPass = $_POST['new_password'] ?? '';

    if(!$newUser || !$newPass){
        $regError = "Username and password required";
    } elseif(isset($users[$newUser])){
        $regError = "Username already exists";
    } else {
        $users[$newUser] = password_hash($newPass, PASSWORD_DEFAULT);
        file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
        $success = "Account created! You can now log in.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login/Register</title>
<style>
body { font-family: sans-serif; margin:20px; }
#top-buttons { position: fixed; top: 10px; left: 10px; }
#user-info { position: fixed; top: 10px; right: 10px; }
input { margin: 2px; }
p { margin: 5px 0; }
</style>
</head>
<body>

<!-- Login form -->
<div id="top-buttons">
<?php if(!isset($_SESSION['username'])): ?>
    <form method="POST" style="display:inline;">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php endif; ?>
</div>

<!-- Logged-in user info -->
<div id="user-info">
<?php if(isset($_SESSION['username'])): ?>
    Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?>
    <form method="POST" style="display:inline;">
        <button type="submit" name="logout">Logout</button>
    </form>
<?php endif; ?>
</div>

<!-- Registration form -->
<div style="margin-top:100px;">
<h3>Register</h3>
<form method="POST">
    <input type="text" name="new_username" placeholder="Username" required>
    <input type="password" name="new_password" placeholder="Password" required>
    <button type="submit" name="register">Register</button>
</form>
<?php
if(!empty($regError)) echo "<p style='color:red;'>$regError</p>";
if(!empty($success)) echo "<p style='color:green;'>$success</p>";
?>
</div>

</body>
</html>
