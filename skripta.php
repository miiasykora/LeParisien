<?php
session_start();

$conn = mysqli_connect("localhost", "root", "3884", "vijesti");
if (!$conn) {
  die("Neuspjelo spajanje na bazu podataka: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $naslov = $_POST['naslov'];
  $sazetak = $_POST['sazetak'];
  $tekst = $_POST['tekst'];
  $kategorija = $_POST['kategorija'];
  $slika = "";
  if ($_FILES['slika']['name']) {
    $imeSlike = $_FILES['slika']['name'];
    $tipSlike = $_FILES['slika']['type'];
    $velicinaSlike = $_FILES['slika']['size'];
    $tmpLokacijaSlike = $_FILES['slika']['tmp_name'];

    $noviNazivSlike = uniqid() . '_' . $imeSlike;

    $lokacijaSlike = 'slike/' . $noviNazivSlike;

    if (($tipSlike == 'image/jpeg' || $tipSlike == 'image/png') && $velicinaSlike <= 2 * 1024 * 1024) {
        move_uploaded_file($tmpLokacijaSlike, $lokacijaSlike);
        $slika = $lokacijaSlike;
    } else {
        echo "Neispravan format slike ili prevelika veličina.";
        exit();
    }
  }

  $obavijest = isset($_POST['obavijest']) ? 1 : 0;

  $sql = "INSERT INTO vijesti (naslov, sazetak, tekst, kategorija, slika) VALUES ('$naslov', '$sazetak', '$tekst', '$kategorija', '$slika')";

  if (mysqli_query($conn, $sql)) {
    echo "Uspješno spremljeno u bazu podataka.";
  } else {
    echo "Greška pri spremanju u bazu podataka: " . mysqli_error($conn);
  }

  mysqli_close($conn);
} else {
  echo "Nevažeći zahtjev.";
}
?>


<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8">
  <title>LeParisien - Početna</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="stil.css">
</head>

<body>
  <header>
    <h1>
      <header>
        <img src="logo.png" alt="Logo" class="logo" style="width: 400px;">
      </header>
    </h1>
  </header>
  <hr />
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


  <main>
    <section class="clanak">
      <?php if (isset($kategorija) && isset($naslov) && isset($sazetak) && isset($tekst)) { ?>
        <h2><?php echo $kategorija; ?></h2>

        <div class="clanak-section">
          <h3><?php echo $naslov; ?></h3>

          <?php if (!empty($slika)) { ?>
            <div class="clanak-image">
              <img src="<?php echo $slika; ?>" alt="Article Image">
            </div>
          <?php } ?>

          <div class="clanak-content">
            <h4><?php echo $sazetak; ?></h4>
            <p><?php echo $tekst; ?></p>
          </div>
        </div>
      <?php } else { ?>
        <p>Nema podataka za prikaz.</p>
      <?php } ?>
    </section>
  </main>


  <footer>
    <p>Autor: Mia Sykora</p>
    <p>Kontakt: msykora@tvz.hr</p>
    <p>© 2023. LeParisien. Sva prava pridržana.</p>
    <a href="odjava.php" class="btn btn-primary">Odjava</a>
  </footer>

</body>

</html>
