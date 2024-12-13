<?php
// Avvia la sessione (necessario per utilizzare $_SESSION)
session_start();

// Funzione per verificare se l'utente è loggato
function isLoggedIn() {
    return isset($_SESSION['user_id']); // Restituisce true se l'utente è loggato
}

// Funzione per ottenere l'ID dell'utente loggato
function getLoggedInUserId() {
    return isLoggedIn() ? $_SESSION['user_id'] : null; // Restituisce l'ID utente loggato o null
}

// Funzione per fare il logout
function logout() {
    // Rimuove tutte le variabili di sessione
    session_unset();
    // Distrugge la sessione
    session_destroy();
    // Redirige alla pagina di login (o alla pagina desiderata)
    header("Location: index.php");
    exit();
}

// Funzione per avviare il login
function login($user_id) {
    $_SESSION['user_id'] = $user_id; // Imposta l'ID dell'utente nella sessione
}

// Esempio di come usare il logout: se il parametro "logout" è passato nell'URL
if (isset($_GET['logout'])) {
    logout(); // Esegui il logout
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso Eseguito</title>
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
        <h1>Accesso Eseguito</h1>
        <p>Benvenuto, hai effettuato l'accesso con successo!</p>
        <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
