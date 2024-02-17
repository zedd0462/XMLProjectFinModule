<?php
    $nom = $ville = $pays = "";
    if(isset($_POST['nom_gare'])&&!empty($_POST['nom_gare'])&&isset($_POST['ville'])&&!empty($_POST['ville'])){
        $nom = $_POST['nom'];
        $ville = $_POST['ville'];
    }else{
        echo "Not enough data.";
        return;
    }

    $id_gare = (int)uniqid(rand(), true);
    $id_gare = "g".$id_gare;

    $xml = new DOMDocument;
    $xml->load("gestion_train.xml");

    /*<gare id_gare="g001">
            <nom_gare>Gare de Safi</nom_gare>
            <ville>Safi</ville>
     </gare>*/

    $gares = $xml->getElementsByTagName("gares")->item(0);
    $gare = $xml->createElement("gare");

    $gare->setAttribute("id_gare",$id_gare);
    $nom_gare = $xml->createElement("nom_gare",$nom);
    $ville = $xml->createElement("ville",$ville);
    $gare->appendChild($nom_gare);
    $gare->appendChild($ville);
    $gares->appendChild($gare);
    $xml->save("gestion_train.xml");

    header("Location: admin_dashboard.php?msg=Gare ajouté avec succès.");

?>