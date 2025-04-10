<br>
<h2>Gestion des commandes</h2>

<?php
$laCommande = null;
if(isset($_GET['action']) && isset($_GET['idcommande'])){
    $action = $_GET['action'];
    $idcommande = $_GET['idcommande'];
    switch($action){
        case 'sup': 
            $unControleur->deleteCommande($idcommande);
            echo "<div id='message' style='color: green;'>✔️ Suppression réussie.</div>";

            break;
        case 'edit':
            $laCommande = $unControleur->selectWhereCommande($idcommande);
            break;
    }
}

require_once("vue/vue_insert_commande.php");

if(isset($_POST['Valider'])){
    $unControleur->insertCommande($_POST);
    echo "<div id='message' style='color: green;'>✔️ Insertion réussie.</div>";
   
}

if(isset($_POST['Modifier'])){
    $unControleur->updateCommande($_POST);
    header('Location: index.php?page=6');
    exit();
}

if(isset($_POST['Filtrer'])){
    $filtre = $_POST['filtre'];
}else{
    $filtre = "";
}

$lesCommandes = $unControleur->selectAllCommandes($filtre);
require_once("vue/vue_select_commandes.php");
?>

<script>
    // Attendre 3 secondes (3000ms), puis cacher le message
    setTimeout(function() {
        const message = document.getElementById('message');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000); // 3 secondes
</script>