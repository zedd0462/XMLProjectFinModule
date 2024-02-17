<?php

    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: index.html");
        return;
    }
    if($_SESSION['admin']==1){
        header("Location: admin_dashboard.php");
        return;
    }
    $xml = new DOMDocument;
    $xml->load("gestion_train.xml");

    $xsl = new DOMDocument;
    $xsl->load('tickets.xsl');

    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);

    $proc->setParameter(null, 'username',$_SESSION['username']);
    echo $proc->transformToXML($xml);




?>