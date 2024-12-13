<?php
session_start();
require 'db_connection.php'; // Include il file di connessione al database

// Controlla se il modulo è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; #inserisce nella variabile username l'input
    $password = $_POST['password']; #inserisce nella variabile password l'input

    // controlla se l'username non è vuoto
    if (!empty($username)) {
        
        // Controllare le credenziali nel database
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password';";
        // connessione multiquery
        $result = $conn->multi_query($query);
        #controllo il risultato
        if ($result) { 
            $result_set = $conn->store_result(); // Conserva il risultato della query in memoria
            if ($result_set->num_rows > 0) { // Verifica se ci sono righe corrispondenti
                $user = $result_set->fetch_assoc(); // Estrae la prima riga del risultato
                // Successful login, store session data
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                $_SESSION['success_message'] = "Accesso effettuato con successo!"; // Messaggio di successo
                header("Location: session.php");
                exit();
            } else {
                $error = "Credenziali errate!";
            }
        } else {
            $error = "Schema Users non trovato!";
        }
    } else {
        $error = "Tutti i campi sono obbligatori!";
    }
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h1>Login</h1>
        <?php
        // Mostra il messaggio di successo se presente
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']); // Rimuovi il messaggio dopo averlo visualizzato
            header("session.php");
        }

        // Mostra il messaggio di errore
        if (isset($error)) {
            echo '<div class="alert alert-error">' . $error . '</div>';
        }
        ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Nome Utente" required>
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>
        <p>Non hai un account? <a href="signin.php">Registrati</a></p>
    </div>
</body>
</html>
