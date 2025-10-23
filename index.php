<?php
require_once '../config/db.php';
require_once '../lib/session.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$pdo = getDBConnection();
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// info o użytkowniku
$ip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
?>

<p>IP: <?php echo $ip; ?> | UserAgent: <?php echo $useragent; ?></p>

<table border="1">
    <tr>
        <th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Telefon</th><th>Adres</th><th>Usuń</th>
    </tr>
    <?php foreach($users as $user): ?>
    <tr>
        <td><?= htmlspecialchars($user['first_name']) ?></td>
        <td><?= htmlspecialchars($user['last_name']) ?></td>
        <td><?= htmlspecialchars($user['age']) ?></td>
        <td><?= htmlspecialchars($user['phone']) ?></td>
        <td><?= htmlspecialchars($user['address']) ?></td>
        <td><a href="delete_user.php?id=<?= $user['id'] ?>">Usuń</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="add_user.php">Dodaj użytkownika</a>
<a href="logout.php">Wyloguj</a>
