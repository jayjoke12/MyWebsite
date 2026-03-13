<?php
session_start();

// Path to JSON file
$usersFile = __DIR__ . '/users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

// Handle login
if(isset($_POST['login'])){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if(isset($users[$username]) && password_verify($password, $users[$username])){
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

// Handle registration
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
        $success = "Account created! You can now login.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login/Register</title>
<link rel="stylesheet" href="style.css">
<style>
body {
    font-family: MyFont;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.login-box {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    color: #fff;
    text-align: center;
      background: #e2f3ff;
  border: 3px solid #6ac7ff;
	-webkit-background-clip: padding-box;
	background-clip: padding-box;
  border-radius: 28px;
  box-shadow:
        0 0 18px #6ac7ff,
        0 0 40px rgba(106, 199, 255, 0.9),
        inset 0 0 15px rgba(106, 199, 255, 0.5);
}

.login-box h2 {margin-top:0; font-size:24px; color: black;}
.login-box label {display:block; margin:10px 0 4px; font-size:16px; color: black;}
.login-box input[type="text"], .login-box input[type="password"] {
    width: 100%; padding:8px; border:2px solid #000; border-radius:8px;
    margin-bottom:10px; box-sizing:border-box; font-family: MyFont;
}
.login-box button {
    width: 100%; padding:10px; font-size:16px; border:none; border-radius:10px;
    background:#000; color:#fff; cursor:pointer; transition: transform 0.2s, background 0.2s;
}
.login-box button:hover {transform: scale(1.03); background:#222;}
.login-message {margin-top:12px; padding:10px; border-radius:10px; background: rgba(255,255,255,0.2); border:2px solid #000; font-size:14px; color:#fff;}
hr {margin:20px 0; border:1px solid #000;}
.toggle-link {cursor:pointer; text-decoration:underline; margin-top:10px; display:block;}
</style>
</head>
<body>
<div class="login-box">
    <!-- Login Form -->
    <div id="login-form">
        <h2>Login</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <?php if(!empty($error)) echo "<div class='login-message'>".htmlspecialchars($error)."</div>"; ?>
        <span style="color: black;"class="toggle-link" onclick="toggleForms()">Haven't got an account? Register</span>
    </div>

    <!-- Register Form -->
    <div id="register-form" style="display:none;">
        <h2>Register</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="new_username" required>
            <label>Password:</label>
            <input type="password" name="new_password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <?php
        if(!empty($regError)) echo "<div class='login-message'>".htmlspecialchars($regError)."</div>";
        if(!empty($success)) echo "<div class='login-message' style='color:green;'>$success</div>";
        ?>
        <span style="color: black;" class="toggle-link" onclick="toggleForms()">Already have an account? Login</span>
    </div>
</div>

<script>
function toggleForms(){
    const login = document.getElementById('login-form');
    const register = document.getElementById('register-form');
    if(login.style.display==='none'){
        login.style.display='block';
        register.style.display='none';
    } else {
        login.style.display='none';
        register.style.display='block';
    }
}
</script>
</body>
</html>
