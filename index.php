<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>LeParisien - Početna</title>
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

  <section id="content" class="container">
  
<h3 id="parisien">PARISIEN</h3>
    
    <div class="row">
      <?php
        $conn = mysqli_connect("localhost", "root", "3884", "vijesti");
        if (!$conn) {
          die("Neuspjelo spajanje na bazu podataka: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM vijesti WHERE kategorija = 'Parisien'";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
          echo '
            <div class="col-md-4">
              <div class="card">
                <img src="'.$row['slika'].'" class="card-img-top" alt="'.$row['naslov'].'">
                <div class="card-body">
                <h3 class="card-title">
                <a href="clanak.php?id='.$row['id'].'">'.$row['naslov'].'</a>
              </h3>              
                  <p class="card-text">'.$row['sazetak'].'</p>
                </div>
              </div>
            </div>
          ';
        }

        mysqli_close($conn);
      ?>
    </div>

    <h3 id="vivre">VIVRE MIEUX</h3>
    <div class="row">
      <?php
        $conn = mysqli_connect("localhost", "root", "3884", "vijesti");

         $sql = "SELECT * FROM vijesti WHERE kategorija = 'Vivre Mieux'";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
        echo '
             <div class="col-md-4">
               <div class="card">
                 <img src="'.$row['slika'].'" class="card-img-top" alt="'.$row['naslov'].'">
                 <div class="card-body">
                 <h3 class="card-title">
                 <a href="clanak.php?id='.$row['id'].'">'.$row['naslov'].'</a>
               </h3>               
                   <p class="card-text">'.$row['sazetak'].'</p>
                 </div>
               </div>
             </div>
           ';
         }
      ?>
    </div>
  </section>

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
