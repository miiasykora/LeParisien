<!DOCTYPE html>
<html>
<head>
    <title>Kategorija</title>
    <style>
        .slika {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        .slika img {
    	max-width: 1500px;
    height: auto;
}

    </style>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="stil.css">
</head>
<body>
<header>
    
    <h1><header style=padding-bottom:20px; >
  Kategorija
</header></h1>
  <hr/>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container justify-content-center">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Početna</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="kategorija.php?kategorija=parisien">Parisien</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="kategorija.php?kategorija=vivre mieux">Vivre Mieux</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="unos.html">Unesi vijest</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="prijava.php">Administracija</a>
      </li> 
    </ul>
  </div>
</nav>
    <?php
    $server = "localhost";
    $username = "root";
    $password = "3884";
    $database = "vijesti";

    $connection = mysqli_connect($server, $username, $password, $database);

    if (!$connection) {
        die("Neuspjelo povezivanje s bazom podataka: " . mysqli_connect_error());
    }

    if (isset($_GET['kategorija'])) {
        $kategorija = $_GET['kategorija'];

        $query = "SELECT * FROM vijesti WHERE kategorija = '$kategorija' AND arhivirano = 0";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $naslov = $row['naslov'];
                $tekst = $row['tekst'];
                $sazetak = $row['sazetak'];
                $slika = $row['slika'];

                echo '<div class="slika">';
                echo '<img src="' . $slika . '" alt="Slika">';
                echo '<h2>' . $naslov . '</h2>';
                echo '<p>' . $tekst . '</p>';
                echo '<p><strong>Sazetak:</strong> ' . $sazetak . '</p>';
                echo '</div>';
            }
        } else {
            echo 'Nema vijesti za prikaz.';
        }
    } else {
        echo 'Niste odabrali kategoriju.';
    }

    mysqli_close($connection);
    ?>

<footer>
    <p>Autor: Mia Sykora</p>
    <p>Kontakt: msykora@tvz.hr</p>
    <p>© 2023. LeParisien. Sva prava pridržana.</p>
    <a href="odjava.php" class="btn btn-primary">Odjava</a>
  </footer>
</body>

</html>
