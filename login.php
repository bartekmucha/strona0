<?php
require_once '../config/db.php';
require_once '../lib/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Nieprawidłowy login lub hasło!";
    }
}
?>

<form method="post">
    <input type="text" name="username" placeholder="Login" required>
    <input type="password" name="password" placeholder="Hasło" required>
    <button type="submit">Zaloguj</button>
</form>
<?php if (!empty($error)) echo $error; ?>
