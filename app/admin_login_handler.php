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
    $query = "/gestion_trains/admins/admin[@username='".$username."']";
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

    $_SESSION['username'] = $username;
    $_SESSION['admin'] = 1;
    
    header("Location: admin_dashboard.php");
    exit();

    
?>