<?php
require_once "config.php";
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim(isset($_POST["login-email"]) ? $_POST["login-email"] : "");
    $password = isset($_POST["login-password"]) ? $_POST["login-password"] : "";
    if ($email === "" || $password === "") {
        $message = "Please enter your email and password.";
    } else {
        $stmt = $pdo->prepare("SELECT id, password_hash, name FROM users WHERE email = ?");
        $stmt->execute(array($email));
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user["password_hash"])) {
            $message = "Welcome, " . $user["name"] . ". You have logged in successfully.";
        } else {
            $message = "Invalid email or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Saudi Vibes | Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="icon" href="../images/favicon.png" type="image/png">
</head>
<body>
  <main>
    <h2>Login Result</h2>
    <p><?php echo htmlspecialchars($message, ENT_QUOTES, "UTF-8"); ?></p>
    <p><a href="../login.html">Back to login</a></p>
  </main>
</body>
</html>
