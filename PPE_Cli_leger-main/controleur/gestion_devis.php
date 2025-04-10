<?php
    require_once("controleur/controleur.class.php");
    $unControleur = new Controleur();
    
    // Insertion d'un devis
    if(isset($_POST['Enregistrer'])){
        $tab = array(
            "datedevis"=>$_POST['datedevis'],
            "etatdevis"=>$_POST['etatdevis'],
            "idclient"=>$_POST['idclient']
        );
        $unControleur->insertDevis($tab);
        echo "<br><div id='message' style='color: green;'>✔️ Insertion réussie.</div>";

    }

    // Suppression d'un devis
    if(isset($_GET['action']) && isset($_GET['iddevis'])){
        $action = $_GET['action'];
        $iddevis = $_GET['iddevis'];
        if($action == "sup"){
            $unControleur->deleteDevis($iddevis);
            echo "<br><div id='message' style='color: green;'>✔️ Suppression réussie.</div>";
        } else if($action == "edit"){
            $unDevis = $unControleur->selectWhereDevis($iddevis);

        }
    }

    // Modification d'un devis
    if(isset($_POST['Modifier'])){
        $tab = array(
            "iddevis"=>$_POST['iddevis'],
            "datedevis"=>$_POST['datedevis'],
            "etatdevis"=>$_POST['etatdevis'],
            "idclient"=>$_POST['idclient']
        );
        $unControleur->updateDevis($tab);
        header("Location: index.php?page=7");
    }

    // Récupération des devis avec filtre
    $lesDevis = null;
    if(isset($_POST['Filtrer'])){
        $filtre = $_POST['filtre'];
        $lesDevis = $unControleur->selectAllDevis($filtre);
    } else {
        $lesDevis = $unControleur->selectAllDevis("");
    }

    // Affichage des vues
    if(isset($_GET['action']) && $_GET['action'] == "edit"){
        require_once("vue/vue_edit_devis.php");
    } else {
        require_once("vue/vue_insert_devis.php");
    }
    require_once("vue/vue_select_devis.php");
?>

<br>
<script>
    // Attendre 3 secondes (3000ms), puis cacher le message
    setTimeout(function() {
        const message = document.getElementById('message');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000); // 3 secondes
</script>
