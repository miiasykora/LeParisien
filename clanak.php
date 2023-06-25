<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8">
  <title>LeParisien - Članak</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="stil2.css">
</head>

<body>
<?php
include '_header.php';
$conn = mysqli_connect("localhost", "root", "3884", "vijesti");
if (!$conn) {
  die("Neuspjelo spajanje na bazu podataka: " . mysqli_connect_error());
}

$id = $_GET['id']; 

$sql = "SELECT * FROM vijesti WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $datumObjave = $row['datum'];
  $formatiraniDatum = date('d.m.Y.', strtotime($datumObjave));

  echo '
    <h2>'.$row['naslov'].'</h2>
    <p class="datum-objave">Datum objave: ' . $formatiraniDatum . '</p>
    <img src="'.$row['slika'].'" alt="'.$row['naslov'].'">
    <p>'.$row['sazetak'].'</p>
    <p>'.$row['tekst'].'</p>
  ';
} else {
  echo 'Članak nije pronađen.';
}

mysqli_close($conn);
?>

<footer>
    <p>Autor: Mia Sykora</p>
    <p>Kontakt: msykora@tvz.hr</p>
    <p>© 2023. LeParisien. Sva prava pridržana.</p>
    <a href="odjava.php" class="btn btn-primary">Odjava</a>
  </footer>
</body>

</html>
