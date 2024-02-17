<?php
    session_start();
    $msg = "";
    if(!isset($_SESSION['username'])){
        header("Location: index.html");
        return;
    }
    if($_SESSION['admin']==0){
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
              <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          </ul>
        </div>
    </nav>
    <div class=" container w100" style="height: 400px;">
        <div class= "row h-100 my-5">
            <div class="col-3"></div>
            <div class="col-6 border bg-white">
                <div class="my-3">
                    <div class="h-50 text-center py-5">
                        <h3>Tableau de bord admin.</h3>
                        <h4><?php echo $msg; ?></h4>
                    </div>  
                    <div class="row ">
                        <div class="col-3"></div>
                        <a  class="btn btn-primary col-6 my-1" href="add_voyage_form.php">Ajouter un voyage</a>
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <a   class="btn btn-primary col-6 my-1" href="add_gare_form.php">Ajouter une gare</a >
                        <div class="col-3"></div>
                        <div class="col-3"></div>
                        <a   class="btn btn-primary col-6 my-1" href="logout.php">Déconnexion </a >
                        <div class="col-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>