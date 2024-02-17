<?php
    session_start();
    $username = $password = "";
    if (isset($_POST['username'])&&isset($_POST['password'])){
        $username =$_POST['username'];
        $password = $_POST['password'];
    }else{
        echo "username or password not set :) ";
        return;
    }
    $xml = new DOMDocument;
    $xml->load("gestion_train.xml");
    $xpath = new DOMXpath($xml);
    $query = "/gestion_trains/utilisateurs/utilisateur[@username='".$username."']";
    $element = $xpath->query($query);
    if (is_null($element[0])){
        echo "User not registered";
        return;
    }
    $nodes = $element[0]->childNodes;
    foreach ($nodes as $node) {
        if ($node->nodeName=='password'){
            $tmp = $node->nodeValue;
            break;
        } 
    }
    if (!($tmp==$password)){
        echo "Wrong password";
        return;
    }
    
    
    //echo $nodes->getAttribute('username');
    //if ($node->nodeName=='username'){
    //    $_SESSION['username'] = $node->nodeValue;
    //    echo " Session set !!";
    //}
    $_SESSION['username'] = $username;
    $_SESSION['admin'] = 0;
    foreach ($nodes as $node) {
        if ($node->nodeName=='nom'){
            $_SESSION['nom'] = $node->nodeValue;
        }
        if ($node->nodeName=='prenom'){
            $_SESSION['prenom'] = $node->nodeValue;
        }
        if ($node->nodeName=='cin'){
            $_SESSION['cin'] = $node->nodeValue;
        }  
    }
    header("Location: dashboard.php");
    exit();

    
?>