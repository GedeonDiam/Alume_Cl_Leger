<?php
require_once("modele/modele.class.php");

// Définir le type de contenu comme JSON
header('Content-Type: application/json');

// Vérifier si l'email est fourni
if (!isset($_GET['email']) || empty($_GET['email'])) {
    echo json_encode(['error' => 'Email non spécifié']);
    exit;
}

$email = $_GET['email'];

// Vérifier la validité de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['error' => 'Format d\'email invalide']);
    exit;
}

// Instancier le modèle
$modele = new Modele();

// Vérifier si l'email existe déjà
$exists = $modele->emailExists($email);

// Renvoyer le résultat
echo json_encode(['available' => !$exists]);
?>
