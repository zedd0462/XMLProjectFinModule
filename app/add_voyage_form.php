<?php
    session_start();
    $msg = "";
    if(!isset($_SESSION['username'])){
        header("Location: index.html");
        return;
    }
    if($_SESSION['admin'] == 0){
        header("Location: dashboard.php");
        return;
    }
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }


    $xml = new DOMDocument;
    $xml->load("gestion_train.xml");
    $gares = $xml->getElementsByTagName("gare");
    $gares_array = array();
    foreach ($gares as $gare) {
        $gares_array[$gare->getAttribute('id_gare')] = $gare->getElementsByTagName('nom_gare')->item(0)->nodeValue;
    }



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="main.css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <title>Gestion des trains</title>
</head>
<body>
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded navbar-expand bg-white">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.html">GestTrain</a>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php">Admin Login</a>
            </li>
          </ul>
        </div>
    </nav>
    <br/>

    <br/>
    <div class="container w100" style="height: 400px;">
        <div class= "row h-100 my-5">
            <div class="col-3"></div>
            <div class="col-6 border bg-white">
                <div class="my-5">
                    <h3 class="text-center">Ajouter un Voyage</h3>
                </div>
                <div class="my-3">
                    <?php 
                      if($msg != ""){
                      echo "<div class='alert alert-danger text-center'>$msg</div>";
                      } 
                    ?>
                    <form action="add_voyage.php" method="POST">
                        <div class="form-group">
                          <label for="date_dep">Date de Départ :</label>
                          <input type="text" class="form-control" id="date_dep" name="date_dep" placeholder="DD-MM-YYYY" required>
                        </div>
                        <div class="form-group">
                          <label for="heure_dep">Heure de Départ:</label>
                          <input type="text" class="form-control" id="heure_dep" name="heure_dep" placeholder="HH:MM" required>
                        </div>
                        <div class="form-group">
                          <label for="num_train">Numéro du Train:</label>
                          <input type="text" class="form-control" id="num_train" name="num_train" placeholder="Numéro du Train" required>
                        </div>
                        <div class="form-group">
                          <label for="prix">Prix:</label>
                          <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix" required>
                        </div>
                        <div class="form-group">
                          <label for="gare_depart">Gare de Départ:</label>
                          <select class="custom-select" id="gare_depart" name="gare_depart" required>
                            <?php
                                foreach ($gares_array as $id => $name) {
                                    echo "<option value='$id'>$name</option>";
                                }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="gare_arrive">Gare d'Arrivée:</label>
                          <select class="custom-select" id="gare_arrive" name="gare_arrive" required>
                            <?php
                                foreach ($gares_array as $id => $name) {
                                    echo "<option value='$id'>$name</option>";
                                }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="id_classe">Classe:</label>
                          <select class="custom-select" id="id_classe" name="id_classe" required>
                            <option selected="">Selectionner la classe</option>
                            <option value="1">1ère Classe</option>
                            <option value="2">2ème Classe</option>
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter un Voyage</button>
                      </form>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>

