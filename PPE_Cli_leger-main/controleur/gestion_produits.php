<br>
<h2> Gestion des produits </h2>

<?php
$leProduit = null;

// Gestion des actions
if (isset($_GET['action']) && isset($_GET['idproduit'])) {
    $action = $_GET['action'];
    $idproduit = $_GET['idproduit']; 
    switch ($action) {
        case "sup":
            $unControleur->deleteProduit($idproduit);
            echo "<div id='message' style='color: green;'>✔️ Suppression réussie.</div>";
            break;

        case "edit":
            $leProduit = $unControleur->selectWhereProduit($idproduit);
            break;
    }
}

// Traitement du formulaire d'insertion
if (isset($_POST["Valider"])){
    $unControleur->insertProduit($_POST);
    echo "<br> <div id='message' style='color: green;'>✔️ Insertion réussie.</div>";
   
}

// Traitement du formulaire de modification
if (isset($_POST["Modifier"])){
    $unControleur->updateProduit($_POST);
    header("Location: index.php?page=4");
    exit();
}

// Récupération des produits
if(isset($_POST['Filtrer'])){
    $filtre = $_POST['filtre'];
}else{
    $filtre = "";
}
$lesProduits = $unControleur->selectAllProduits($filtre);

// Affichage des vues dans le bon ordre
if(isset($_GET['action']) && $_GET['action'] == 'edit') {
    require_once("vue/vue_edit_produit.php");
} else {
    require_once("vue/vue_insert_produit.php");
}
require_once("vue/vue_select_produits.php");

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


<style>
.flash-message {
    padding: 15px 25px;
    background-color: #d4edda;
    color: #155724;
    font-size: 18px;
    font-weight: bold;
    border: 2px solid #c3e6cb;
    border-radius: 5px;
    margin: 15px 0;
    width: fit-content;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    transition: opacity 1s ease;
}
.fade-out {
    opacity: 0;
}
</style>

