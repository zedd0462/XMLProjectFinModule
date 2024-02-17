<?php
  session_start();
  if(isset($_SESSION['username'])){
    if($_SESSION['admin']==1)
      header("Location: admin_dashboard.php");
    else
      header("Location: dashboard.php");
    exit();
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
            <li class="nav-item ">
              <a class="nav-link" href="index.html">Home </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Login<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php">Admin Login</a>
            </li>
          </ul>
        </div>
    </nav>
    <div class=" container w100" style="height: 400px;">
        <div class= "row h-100 my-5">
            <div class="col-3"></div>
            <div class="col-6 border bg-white">
                <div class="my-5">
                    <form action="login_handler.php" method="POST">
                        <div class="form-group">
                          <label for="username">Nom d'utilisateur :</label>
                          <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur">
                        </div>
                        <div class="form-group">
                          <label for="password">Mot de passe</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                        </div>
                        <button type="submit" class="btn btn-primary">Se Connecter</button>
                      </form>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>