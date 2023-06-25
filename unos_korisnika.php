<?php
include '_header.php';
$conn = mysqli_connect("localhost", "root", "3884", "vijesti");
if (!$conn) {
  die("Neuspjelo spajanje na bazu podataka: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['korisnicko_ime'], $_POST['lozinka'], $_POST['ime'], $_POST['prezime'])) {
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $lozinka = $_POST['lozinka'];
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $escaped_korisnicko_ime = mysqli_real_escape_string($conn, $korisnicko_ime);
        $escaped_lozinka = mysqli_real_escape_string($conn, $lozinka);
        $escaped_ime = mysqli_real_escape_string($conn, $ime);
        $escaped_prezime = mysqli_real_escape_string($conn, $prezime);
        $query = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = '$escaped_korisnicko_ime'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo 'Korisničko ime već postoji. Molimo odaberite drugo korisničko ime.';
        } else {
            $query = "INSERT INTO korisnik (korisnicko_ime, lozinka, ime, prezime) VALUES ('$escaped_korisnicko_ime', '$escaped_lozinka', '$escaped_ime', '$escaped_prezime')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo 'Uspješno ste se registrirali. Možete se prijaviti s vašim korisničkim imenom i lozinkom.';
            } else {
                echo 'Došlo je do pogreške prilikom registracije. Molimo pokušajte ponovno.';
            }
        }
    }
}
?>
