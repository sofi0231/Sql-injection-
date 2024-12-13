<?php
#connessione al database
$servername = "db"; // Nome server
$username = "root"; // Username db
$password = ""; // password db
$dbname = "db"; // Nome db

// Crea connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>