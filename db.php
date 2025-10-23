<?php
// config/db.php

// Tutaj tylko definiujemy funkcję do połączenia, dane przechowujemy w bezpiecznym pliku poza publicznym katalogiem
function getDBConnection() {
    // Pobierz dane z pliku .ini w bezpiecznej lokalizacji
    $config = parse_ini_file(__DIR__ . '/db_credentials.ini');
    $host = $config['host'];
    $db   = $config['database'];
    $user = $config['username'];
    $pass = $config['password'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Błąd połączenia z bazą: " . $e->getMessage());
    }
}
