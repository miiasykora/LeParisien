<?php
include '_header.php';

if (isset($_SESSION['user_id'])) {     
    if ($_SESSION['admin'] == 1) header('Location: administrator.php');           
    else header('Location: index.php');    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stil.css">
</head>
<body>
    <h2>Prijava</h2>
    <form method="POST" action="provjera.php">
        <label for="korisnicko_ime">Korisničko ime:</label>
        <input type="text" id="korisnicko_ime" name="korisnicko_ime" required><br><br>

        <label for="lozinka">Lozinka:</label>
        <input type="password" id="lozinka" name="lozinka" required><br><br>

        <input type="submit" value="Prijavi se">
    </form>

    <p>Nemate korisnički račun? <a href="registracija.php">Registrirajte se ovdje</a>.</p>
    <footer>
    <p>Autor: Mia Sykora</p>
    <p>Kontakt: msykora@tvz.hr</p>
    <p>© 2023. LeParisien. Sva prava pridržana.</p>
    <a href="odjava.php" class="btn btn-primary">Odjava</a>
  </footer>
</body>
</html>
