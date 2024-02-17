<?php
    $ticket_id = "";
    if(isset($_GET['id_ticket'])&&!empty($_GET['id_ticket'])){
        $ticket_id = $_GET['id_ticket'];
    }else{
        echo "No ticket selected !!";
        return;
    }

    $xml = new DOMDocument;
    $xml->load("gestion_train.xml");

    $xsl = new DOMDocument;
    $xsl->load('ticket.xsl');

    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);

    $proc->setParameter(null, 'ticket_id', $ticket_id);
    echo $proc->transformToXML($xml);


?>