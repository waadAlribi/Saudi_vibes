<?php
require_once "config.php";
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim(isset($_POST["reg-name"]) ? $_POST["reg-name"] : "");
    $email = trim(isset($_POST["reg-email"]) ? $_POST["reg-email"] : "");
    $password = isset($_POST["reg-password"]) ? $_POST["reg-password"] : "";
    $confirm = isset($_POST["reg-confirm-password"]) ? $_POST["reg-confirm-password"] : "";
    if ($name === "" || $email === "" || $password === "" || $confirm === "") {
        $message = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm) {
        $message = "Passwords do not match.";
    } else {
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute(array($email));
        if ($check->fetch()) {
            $message = "This email is already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users (name, email, password_hash, created_at) VALUES (?, ?, ?, NOW())");
            $insert->execute(array($name, $email, $hash));
            $message = "Account created successfully.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Saudi Vibes | Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="icon" href="../images/favicon.png" type="image/png">
</head>
<body>
  <main>
    <h2>Registration Result</h2>
    <p><?php echo htmlspecialchars($message, ENT_QUOTES, "UTF-8"); ?></p>
    <p><a href="../register.html">Back to register</a></p>
  </main>
</body>
</html>
