<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        return;
    }
    if($_SESSION['admin']==1){
        header("Location: admin_dashboard.php?msg=You are an admin, you can't buy tickets.");
        return;
    }
    if(!isset($_GET['id_voyage'])){
        echo "No voyage selected !!";
        return;
    }
    $id_ticket = (int)uniqid(rand(), true);
    $id_ticket = "t".$id_ticket;
    $username = $_SESSION['username'];
    $id_voyage = $_GET['id_voyage'];

    $xml = new DOMDocument;
    //$xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;
    $xml->load("gestion_train.xml");
    $xpath = new DOMXpath($xml);
    $query = "/gestion_trains/voyages/voyage[@id_voyage='".$id_voyage."']";
    $element = $xpath->query($query);
    if (is_null($element[0])){
        //todo : show this on index page
        echo "Voyage not in database";
        return;
    }
    
    $gestion = $xml->getElementsByTagName('tickets')->item(0);
        
    $ticket = $xml->createElement('ticket');
    $ticket->setAttribute('id_ticket',$id_ticket);
    $ticket->setAttribute('username', $username);
    $ticket->setAttribute('id_voyage', $id_voyage); 
    
    $gestion->appendChild($ticket);
    $xml->save('gestion_train.xml');    
    header("Location: dashboard.php?buy_success=1");
?>