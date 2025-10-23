<?php
require_once __DIR__ . '/../config/db.php';

// pobranie wszystkich użytkowników
function getAllUsers() {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// dodanie nowego użytkownika
function addUser($username, $password, $first_name, $last_name, $age, $phone, $address) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        INSERT INTO users (username, password, first_name, last_name, age, phone, address)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([
        $username,
        password_hash($password, PASSWORD_DEFAULT), // hasło zawsze haszujemy!
        $first_name,
        $last_name,
        $age,
        $phone,
        $address
    ]);
}

// usunięcie użytkownika po ID
function deleteUser($id) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    return $stmt->execute([$id]);
}

// pobranie jednego użytkownika po username
function getUserByUsername($username) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
