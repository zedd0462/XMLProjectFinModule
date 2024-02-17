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
                    <h3 class="text-center">Ajouter une Gare</h3>
                </div>
                <div class="my-3">
                    <?php 
                      if($msg != ""){
                      echo "<div class='alert alert-danger text-center'>$msg</div>";
                      } 
                    ?>
                    <form action="add_gare.php" method="POST">
                        <div class="form-group">
                          <label for="nom_gare">Nom de la gare:</label>
                          <input type="text" class="form-control" id="nom_gare" name="nom_gare" placeholder="Nom de la gare" required>
                        </div>
                        <div class="form-group">
                          <label for="ville">Ville:</label>
                          <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Ajouter une Gare</button>
                      </form>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>

