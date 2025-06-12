<?php
require_once ("modele/modele.class.php");
$unModele = new Modele();

// Variables pour stocker les messages et erreurs
$message = null;
$success = false;
$errors = [];

if (isset($_POST['Inscription'])) {
    // Création du tableau de données
    $tab = array(
        "nom" => $_POST['nom'],
        "ville" => $_POST['ville'],
        "codepostal" => $_POST['codepostal'],
        "rue" => $_POST['rue'],
        "numrue" => $_POST['numrue'],
        "tel" => $_POST['tel'],
        "email" => $_POST['email'],
        "mdp" => $_POST['mdp']
    );
    
    // Insertion dans la base de données avec vérification du mot de passe
    $result = $unModele->insertClient($tab);
    
    // Traitement du résultat sécurisé
    if (is_array($result)) {
        $success = isset($result['success']) ? $result['success'] : false;
        $message = isset($result['message']) ? $result['message'] : 'Une erreur s\'est produite';
        
        if (!$success && isset($result['errors'])) {
            $errors = $result['errors'];
        }
        
        if ($success) {
            // Récupérer le mot de passe en clair pour la connexion automatique
            $mdp_clair = isset($result['mdp_clair']) ? $result['mdp_clair'] : $_POST['mdp'];
            
            // Connexion automatique de l'utilisateur après inscription
            $client = $unModele->verifConnexionClient($_POST['email'], $mdp_clair);
            
            if ($client['success']) {
                // Démarrer la session et stocker les infos utilisateur
                if (!isset($_SESSION)) {
                    session_start();
                }
                
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['role'] = 'client';
                $_SESSION['idclient'] = $client['data']['idclient'];
                $_SESSION['unUser'] = $client['data'];
                
                // Redirection vers la page d'accueil
                echo "<script>alert('Inscription réussie ! Bienvenue " . htmlspecialchars($_POST['nom']) . "'); window.location.href='index.php?page=1';</script>";
                exit;
            } else {
                // Redirection sans connexion automatique
                echo "<script>alert('Inscription réussie ! Veuillez vous connecter.'); window.location.href='index.php?page=connexion';</script>";
                exit;
            }
        }
    } else {
        // Si le résultat n'est pas un tableau (ancienne version de insertClient)
        $success = false;
        $message = "Problème lors de l'inscription";
    }
}
?>

<h1 class="custom-title container">Site ALU-ME pour la gestion des projets d'équipement</h1>
<br>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="mb-4">Inscription au Site ALU-ME</h3>
                    <img src="img/Logo.png" height="100" width="100" class="mb-4">
                    
                    <?php if(isset($message) && !$success): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?= $message ?>
                            <?php if(!empty($errors)): ?>
                                <ul class="mt-2 text-start">
                                    <?php foreach($errors as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nom" placeholder="Nom" required
                                   value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="ville" placeholder="Ville" required
                                   value="<?= isset($_POST['ville']) ? htmlspecialchars($_POST['ville']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="codepostal" placeholder="Code Postal" maxlength="5" required
                                   value="<?= isset($_POST['codepostal']) ? htmlspecialchars($_POST['codepostal']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="rue" placeholder="Rue" required
                                   value="<?= isset($_POST['rue']) ? htmlspecialchars($_POST['rue']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" name="numrue" placeholder="Numéro de rue" required
                                   value="<?= isset($_POST['numrue']) ? htmlspecialchars($_POST['numrue']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control" name="tel" placeholder="Téléphone" required
                                   value="<?= isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required
                                   value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                            <div id="email-feedback" class="form-text"></div>
                        </div>
                        
                        <div class="mb-3">
                            <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" required>
                            <div class="form-text text-start">
                                <small>Le mot de passe doit contenir au moins:</small>
                                <ul class="mb-0 ps-3">
                                    <li>8 caractères</li>
                                    <li>Une lettre majuscule</li>
                                    <li>Une lettre minuscule</li>
                                    <li>Un chiffre</li>
                                    <li>Un caractère spécial (!@#$%^&*...)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="Inscription" class="btn btn-primary">
                                <i class="bi bi-person-plus me-2"></i>Inscription
                            </button>
                            <button type="reset" name="Annuler" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Annuler
                            </button>
                            <a href="index.php?page=connexion" class="btn btn-link">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Déjà inscrit ? Connectez-vous
                            </a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const emailFeedback = document.getElementById('email-feedback');
    let typingTimer;
    const doneTypingInterval = 1000; // 1 seconde

    // Vérifier l'email après que l'utilisateur a arrêté de taper pendant le délai spécifié
    emailInput.addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        if (emailInput.value) {
            typingTimer = setTimeout(checkEmailAvailability, doneTypingInterval);
        }
    });

    function checkEmailAvailability() {
        const email = emailInput.value;
        if (!email || !isValidEmail(email)) return;

        emailFeedback.innerHTML = '<i class="bi bi-hourglass-split"></i> Vérification...';
        emailFeedback.className = 'form-text text-muted';

        // Utiliser Fetch API pour vérifier la disponibilité de l'email
        fetch('check_email.php?email=' + encodeURIComponent(email))
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    emailFeedback.innerHTML = '<i class="bi bi-check-circle-fill"></i> Email disponible';
                    emailFeedback.className = 'form-text text-success';
                } else {
                    emailFeedback.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> Cet email est déjà utilisé';
                    emailFeedback.className = 'form-text text-danger';
                }
            })
            .catch(error => {
                console.error('Erreur lors de la vérification de l\'email:', error);
            });
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
});
</script>


