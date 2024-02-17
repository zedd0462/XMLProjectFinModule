<?php
    $depart = $arrive = $date_voyage = "";
    if(isset($_POST['arrive'])&&!empty($_POST['arrive'])&&isset($_POST['depart'])&&!empty($_POST['depart'])&&isset($_POST['date_voyage'])&&!empty($_POST['date_voyage'])){
        $arrive = $_POST['arrive'];
        $depart = $_POST['depart'];
        $date_voyage = $_POST['date_voyage'];
    }else{
        echo "Not enough data.";
        return;
    }
    $xml = new DOMDocument;
    $xml->load("gestion_train.xml");

    $xsl = new DOMDocument;
    $xsl->load('voyages.xsl');

    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);

    $proc->setParameter(null, 'date_dep', $date_voyage);
    $proc->setParameter(null, 'ville_dep', $depart);
    $proc->setParameter(null, 'ville_arr', $arrive);
    echo $proc->transformToXML($xml);




?>