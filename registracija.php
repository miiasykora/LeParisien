<?php include '_header.php';?>
<!DOCTYPE html>
<html>
<head>
    <title>Registracija</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stil.css">
</head>
</head>
<body>
    <h2>Registracija korisnika</h2>
    <form method="POST" action="unos_korisnika.php">
        <label for="korisnicko_ime">Korisničko ime:</label>
        <input type="text" id="korisnicko_ime" name="korisnicko_ime" required><br>

        <label for="lozinka">Lozinka:</label>
        <input type="password" id="lozinka" name="lozinka" required><br>

        <label for="ime">Ime:</label>
        <input type="text" id="ime" name="ime" required><br>

        <label for="prezime">Prezime:</label>
        <input type="text" id="prezime" name="prezime" required><br>

        <input type="submit" value="Registriraj se">
    </form>
    <footer>
    <p>Autor: Mia Sykora</p>
    <p>Kontakt: msykora@tvz.hr</p>
    <p>© 2023. LeParisien. Sva prava pridržana.</p>
    <a href="odjava.php" class="btn btn-primary">Odjava</a>
  </footer>
</body>
</html>
