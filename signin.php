<?php
require 'db_connection.php'; // Include il file di connessione al database

$message = ""; // Variabile per mostrare il messaggio
$message_class = ""; // Classe per lo stile del messaggio

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; #aggiunge alla variabile username il campo preso in input  
    $password = $_POST['password']; #aggiunge alla variabile password il campo preso in input  
    // Controlla se l'username esiste già
    $check_query = "SELECT * FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($check_query);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    if ($result_check->num_rows > 0) {
        // L'username esiste già
        $message = "Errore: Username già esistente! Scegli un altro username.";
        $message_class = "alert-error";
    }
    else {
    // creo la query
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    #connesione al db e invioi parametri 
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) { #verifico il risultato della richiesta
        $message = "Registrazione avvenuta con successo! Verrai reindirizzato alla pagina di login.";
        $message_class = "alert-success";
        header("refresh:2; url=index.php"); // Reindirizza alla pagina di login dopo 2 secondi
    } else {
        $message = "Errore durante la registrazione! Riprova.";
        $message_class = "alert-error";
    }}
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Account</title>
    <link rel="icon" tipo="immagine/png" href="ico.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center; 
        }
        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.7); 
            border-radius: 12px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            text-align: center;
            font-size: 2em;
            color: #094f75;
        }
        p {
            color: #094f75;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px; 
            border: 1px solid #ddd;
        }
        input::placeholder {
            color: #bd3f7a;
            text-align: left;
        }
        button {
            padding: 10px;
            font-size: 16px;
            background-color: #094f75;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 8px; 
        }
        button:hover {
            background-color: #bd3f7a;
        }
        a {
            text-decoration: none;
            color: #bd3f7a;
            font-size: 14px;
        }
        a:hover {
            text-decoration: underline;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            color: #fff;
            text-align: center;
        }

        .alert-success {
            background-color: #4CAF50;
        }

        .alert-error {
             background-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crea Account</h1>
        <?php if (!empty($message)): ?>
            <div class="alert <?php echo $message_class; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Sei già registrato? <a href="index.php">Login</a></p>
    </div>
</body>
</html>
