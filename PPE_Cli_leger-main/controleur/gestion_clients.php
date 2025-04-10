<br>
<h2> Gestion des clients </h2>

<?php
$leClient = null;
if (isset($_GET['action']) && isset($_GET['idclient'])){
	$action = $_GET['action']; 
	$idclient = $_GET['idclient']; 
	switch ($action) {
		case 'sup':
			$unControleur->deleteClient($idclient); 
			echo "<div id='message' style='color: green;'>✔️ Suppression réussie.</div>";

			break;
		case 'edit':
			$leClient = $unControleur->selectWhereClient($idclient); 
			break;
	}
}

// Affichage du formulaire d'insertion/modification
require_once("vue/vue_insert_client.php");

if (isset($_POST["Valider"])){
	// Insertion des données dans la base
	$unControleur->insertClient($_POST);
	echo "<div id='message' style='color: green;'>✔️ Insertion réussie.</div>";
	
}

// Traitement du formulaire de modification
if (isset($_POST["Modifier"])){
	// Mise à jour des données dans la base
	$unControleur->updateClient($_POST);
	// Redirection après modification pour actualiser la page
	header("Location: index.php?page=2");
	exit();  // Toujours faire un exit après une redirection
}

// La vue des clients n'est accessible qu'aux administrateurs
if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
	//recuperation des clients de la base de données
	if(isset($_POST['Filtrer'])){
		$filtre = $_POST['filtre'];
	}else{
		$filtre = "";
	}
	$lesClients = $unControleur->selectAllClients($filtre);
	require_once("vue/vue_select_clients.php");
} else {
	if(isset($_SESSION['role'])) {
		echo "<p>L'accès à la liste des clients est réservé aux administrateurs.</p>";
	}
}
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