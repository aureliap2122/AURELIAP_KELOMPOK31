<?php
session_start();

$allowed_username = "admin";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  
    $count = isset($_SESSION['counter']) ? $_SESSION['counter'] : 1;

    if (isset($_POST['increment'])) {
        $count++;
        $_SESSION['counter'] = $count;
    }

    echo "
        <h2>Selamat datang, $allowed_username!</h2>
        <p>Label angka: $count</p>
        <form method='POST'>
            <button type='submit' name='increment'>Tambah +1</button>
        </form>
        <a href='logout.php'>Logout</a>
    ";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];

    if ($username === $allowed_username) {
        $_SESSION['logged_in'] = true;
        $_SESSION['counter'] = 1; 
        header('Location: index.php');
        exit;
    } else {
        $error = "Username tidak valid!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Masuk</button>
    </form>
</body>
</html>
