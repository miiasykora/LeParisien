<?php
include '_header.php';

$conn = mysqli_connect("localhost", "root", "3884", "vijesti");
if (!$conn) {
  die("Neuspjelo spajanje na bazu podataka: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['korisnicko_ime'], $_POST['lozinka'])) {
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $lozinka = $_POST['lozinka'];
        $escaped_korisnicko_ime = mysqli_real_escape_string($conn, $korisnicko_ime);
        $escaped_lozinka = mysqli_real_escape_string($conn, $lozinka);

        $query = "SELECT id, korisnicko_ime, ime, prezime, administratorska_prava FROM korisnik WHERE korisnicko_ime = '$escaped_korisnicko_ime' AND lozinka = '$escaped_lozinka'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $ime = $row['ime'];
            $prezime = $row['prezime'];
            $administratorska_prava = $row['administratorska_prava'];

            $_SESSION["user_id"]=$row['id'];
            $_SESSION["admin"]=$row['administratorska_prava'];

            if ($administratorska_prava == 1) {                
                header('Location: administrator.php');                
                exit;
            } else {
                echo 'Dobrodošli, ' . $ime . ' ' . $prezime . '! Nemate pravo pristupa administratorskoj stranici.';
            }
        } else {            
            echo 'Pogrešno korisničko ime ili lozinka.';
            echo '<br>Molimo vas da se prvo <a href="registracija.php">registrirate</a>.';
        }
    }
}

mysqli_close($conn);
?>
