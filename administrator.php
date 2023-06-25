<?php include '_header.php';?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Administracija</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="stil.css">
</head>
<body>
<header>
    <h1><header>
  <img src="logo.png" alt="Logo" class="logo" style="width: 400px;" >
</header></h1>
  </header>
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
$conn = mysqli_connect("localhost", "root", "3884", "vijesti");

if (!$conn) {
    die("Neuspjelo spajanje na bazu podataka: " . mysqli_connect_error());
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql_delete = "DELETE FROM vijesti WHERE id = $delete_id";
    if (mysqli_query($conn, $sql_delete)) {
        echo "Zapis je uspješno obrisan.";
    } else {
        echo "Pogreška pri brisanju zapisa: " . mysqli_error($conn);
    }
}

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    if (isset($_POST['naslov']) && isset($_POST['sazetak']) && isset($_POST['tekst']) && isset($_POST['kategorija']) && isset($_POST['arhivirano'])) {
        $naslov = $_POST['naslov'];
        $sazetak = $_POST['sazetak'];
        $tekst = $_POST['tekst'];
        $kategorija = $_POST['kategorija'];
        $arhivirano = $_POST['arhivirano'];

        $noviNazivSlike = '';
        if (isset($_FILES['slika']['name']) && $_FILES['slika']['name'] != '') {
            $imeSlike = $_FILES['slika']['name'];
            $tipSlike = $_FILES['slika']['type'];
            $velicinaSlike = $_FILES['slika']['size'];
            $tmpLokacijaSlike = $_FILES['slika']['tmp_name'];

            $noviNazivSlike = uniqid() . '_' . $imeSlike;

            $lokacijaSlike = 'slike/' . $noviNazivSlike;

            if (($tipSlike == 'image/jpeg' || $tipSlike == 'image/png') && $velicinaSlike <= 2 * 1024 * 1024) {
                move_uploaded_file($tmpLokacijaSlike, $lokacijaSlike);
            } else {
                echo "Neispravan format slike ili prevelika veličina.";
                exit();
            }
        }

        $sql_update = "UPDATE vijesti SET naslov = '$naslov', sazetak = '$sazetak', tekst = '$tekst', kategorija = '$kategorija', arhivirano = '$arhivirano', slika = '$noviNazivSlike' WHERE id = $edit_id";
        if (mysqli_query($conn, $sql_update)) {
            echo "Zapis je uspješno ažuriran.";
        } else {
            echo "Pogreška pri ažuriranju zapisa: " . mysqli_error($conn);
        }
    }

    $sql_select = "SELECT * FROM vijesti WHERE id = $edit_id";
    $result_select = mysqli_query($conn, $sql_select);

    if (mysqli_num_rows($result_select) > 0) {
        $row_select = mysqli_fetch_assoc($result_select);
        $naslov = $row_select['naslov'];
        $sazetak = $row_select['sazetak'];
        $tekst = $row_select['tekst'];
        $kategorija = $row_select['kategorija'];
        $arhivirano = $row_select['arhivirano'];
        $slika = $row_select['slika'];

        echo "<form method='post' enctype='multipart/form-data'>";
        echo "<label for='naslov'>Naslov:</label><br>";
        echo "<input type='text' name='naslov' value='$naslov' required><br><br>";
        echo "<label for='sazetak'>Sazetak:</label><br>";
        echo "<textarea name='sazetak' rows='3' required>$sazetak</textarea><br><br>";
        echo "<label for='tekst'>Tekst:</label><br>";
        echo "<textarea name='tekst' rows='6' required>$tekst</textarea><br><br>";
        echo "<label for='kategorija'>Kategorija:</label><br>";
        echo "<input type='text' name='kategorija' value='$kategorija' required><br><br>";
        echo "<label for='arhivirano'>Arhivirano:</label>";
        echo "<input type='checkbox' name='arhivirano' value='1' " . ($arhivirano ? 'checked' : '') . "><br><br>";
        echo "<label for='slika'>Slika:</label><br>";
        echo "<img src='slike/$slika' width='200'><br><br>";
        echo "<input type='file' name='slika'><br><br>";
        echo "<input type='submit' value='Spremi'>";
        echo "</form>";
    } else {
        echo "Zapis s ID-om $edit_id nije pronađen.";
    }

    mysqli_free_result($result_select);
}

$sql_select_all = "SELECT * FROM vijesti";
$result_select_all = mysqli_query($conn, $sql_select_all);

if (mysqli_num_rows($result_select_all) > 0) {
    echo "<h2>Svi zapisi</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Naslov</th><th>Akcije</th></tr>";

    while ($row_select_all = mysqli_fetch_assoc($result_select_all)) {
        $id = $row_select_all['id'];
        $naslov = $row_select_all['naslov'];

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$naslov</td>";
        echo "<td><a href='administrator.php?edit_id=$id'>Uredi</a> | <a href='administrator.php?delete_id=$id'>Obriši</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nema zapisa u bazi.";
}

mysqli_free_result($result_select_all);

mysqli_close($conn);
?>

<footer>
    <p>Autor: Mia Sykora</p>
    <p>Kontakt: msykora@tvz.hr</p>
    <p>© 2023. LeParisien. Sva prava pridržana.</p>
    <a href="odjava.php" class="btn btn-primary">Odjava</a>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>