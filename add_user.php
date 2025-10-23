<?php
require_once '../config/db.php';
require_once '../lib/session.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = getDBConnection()->prepare("
        INSERT INTO users (username, password, first_name, last_name, age, phone, address)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $_POST['username'],
        password_hash($_POST['password'], PASSWORD_DEFAULT),
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['age'],
        $_POST['phone'],
        $_POST['address']
    ]);
    header("Location: index.php");
}
?>

<form method="post">
    <input type="text" name="username" placeholder="Login" required>
    <input type="password" name="password" placeholder="Hasło" required>
    <input type="text" name="first_name" placeholder="Imię">
    <input type="text" name="last_name" placeholder="Nazwisko">
    <input type="number" name="age" placeholder="Wiek">
    <input type="text" name="phone" placeholder="Telefon">
    <input type="text" name="address" placeholder="Adres">
    <button type="submit">Dodaj</button>
</form>
