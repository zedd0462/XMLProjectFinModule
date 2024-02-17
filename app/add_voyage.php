<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: index.html");
        return;
    }
    if($_SESSION['admin']==0){
        header("Location: dashboard.php");
        return;
    }
    //check if all fields are in the post request
    /*
    <xs:element name="voyage">
        <xs:complexType>
            <xs:sequence>
                <xs:element ref="date_dep"/>
                <xs:element ref="heure_dep"/>
                <xs:element ref="num_train"/>
                <xs:element ref="prix"/>
            </xs:sequence>
            <xs:attribute name="id_voyage" type="xs:ID" use="required"/>
            <xs:attribute name="gare_depart" type="xs:IDREF" use="required"/>
            <xs:attribute name="gare_arrive" type="xs:IDREF" use="required"/>
            <xs:attribute name="id_classe" type="xs:IDREF" use="required"/>
        </xs:complexType>
    </xs:element>
    */
    $date_dep = $num_train = $heure_dep = $prix = $gare_depart = $gare_arrive = $id_classe = "";
    if (isset($_POST['date_dep'])&&isset($_POST['heure_dep'])&&isset($_POST['num_train'])&&isset($_POST['prix'])&&isset($_POST['gare_depart'])&&isset($_POST['gare_arrive'])&&isset($_POST['id_classe'])){
        $date_dep = $_POST['date_dep'];
        $heure_dep = $_POST['heure_dep'];
        $num_train = $_POST['num_train'];
        $prix = $_POST['prix'];
        $gare_depart = $_POST['gare_depart'];
        $gare_arrive = $_POST['gare_arrive'];
        $id_classe = $_POST['id_classe'];
    }else{
        echo "All fields are required";
        return;
    }

    if($gare_depart==$gare_arrive){
        header("Location: add_voyage_form.php?msg=Gare de depart et d'arrivee ne peuvent pas etre identiques.");
        return;
    }

    $id_voyage = (int)uniqid(rand(), true);
    $id_voyage = "v".$id_voyage;

    $xml = new DOMDocument;
    //$xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;
    $xml->load("gestion_train.xml");


    $voyages = $xml->getElementsByTagName('voyages')->item(0);
    $voyage = $xml->createElement('voyage');
    $voyage->setAttribute('id_voyage',$id_voyage);
    $voyage->setAttribute('gare_depart',$gare_depart);
    $voyage->setAttribute('gare_arrive',$gare_arrive);
    $voyage->setAttribute('id_classe',$id_classe);

    $date_dep = $xml->createElement('date_dep',$date_dep);
    $heure_dep = $xml->createElement('heure_dep',$heure_dep);
    $num_train = $xml->createElement('num_train',$num_train);
    $prix = $xml->createElement('prix',$prix);

    $voyage->appendChild($date_dep);
    $voyage->appendChild($heure_dep);
    $voyage->appendChild($num_train);
    $voyage->appendChild($prix);

    $voyages->appendChild($voyage);
    $xml->save('gestion_train.xml');

    header("Location: admin_dashboard.php?msg=Voyage ajouté avec succès.");







    
?>