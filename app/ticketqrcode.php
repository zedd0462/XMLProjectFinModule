<?php
    include('./lib/phpqrcode/qrlib.php');
    $ticket_id = "";

    if(isset($_GET['id_ticket']) && !empty($_GET['id_ticket'])){
        $ticket_id = $_GET['id_ticket'];
    } else {
        echo "No ticket selected!!";
        echo $ticket_id;
        return;
    }
    $backgroundColor = array(0, 0, 0, 0);
    QRcode::png($ticket_id, false, QR_ECLEVEL_L, 10, 2, false, $backgroundColor);
?>
