<?php
require_once '../lib/session.php'; // wczytanie obsługi sesji

// usuń wszystkie dane sesji
session_unset();
session_destroy();

// przekierowanie do logowania
header("Location: login.php");
exit;
