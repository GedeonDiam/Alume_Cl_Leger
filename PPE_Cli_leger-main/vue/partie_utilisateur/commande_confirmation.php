<?php
require_once("modele/modele.class.php");
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

// Vérifier que l'utilisateur est connecté et est un client
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'client') {
    echo '<div class="alert alert-danger mt-4" role="alert">
            <h4 class="alert-heading">Accès refusé</h4>
            <p>Vous devez être connecté en tant que client pour accéder à cette page.</p>
            <hr>
            <p class="mb-0">
                <a href="index.php?page=connexion" class="btn btn-primary">Se connecter</a>
            </p>
        </div>';
    exit;
}

// Récupérer l'ID de commande depuis l'URL
$idcommande = isset($_GET['idcommande']) ? intval($_GET['idcommande']) : 0;

if ($idcommande <= 0) {
    echo '<div class="alert alert-warning mt-4" role="alert">
            <h4 class="alert-heading">Information manquante</h4>
            <p>Aucune commande n\'a été spécifiée.</p>
            <hr>
            <p class="mb-0">
                <a href="index.php?page=produit" class="btn btn-primary">Retour aux produits</a>
            </p>
        </div>';
    exit;
}

// Récupérer les détails de la commande
$commande = $unControleur->selectWhereCommande($idcommande);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande - ALUME</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .confirmation-header {
            background: linear-gradient(135deg, #080808 0%, #333333 100%);
            padding: 50px 0;
            margin-bottom: 40px;
            color: white;
            text-align: center;
            border-bottom: 3px solid #FFFD55;
        }
        
        .confirmation-header h1 {
            font-weight: 600;
            color: #FFFD55;
            margin-bottom: 10px;
        }
        
        .confirmation-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            margin-bottom: 40px;
            text-align: center;
        }
        
        .confirmation-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
        
        .order-number {
            background-color: #f8f9fa;
            border: 2px solid #FFFD55;
            border-radius: 10px;
            padding: 15px;
            font-size: 1.2rem;
            font-weight: 600;
            color: #212529;
            display: inline-block;
            margin: 20px 0;
        }
        
        .btn-continue {
            background-color: #080808;
            color: #FFFD55;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-continue:hover {
            background-color: #FFFD55;
            color: #080808;
        }
        
        .info-section {
            margin-top: 40px;
        }
        
        .info-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            height: 100%;
            transition: transform 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
        }
        
        .info-icon {
            font-size: 40px;
            color: #080808;
            margin-bottom: 15px;
        }
        
        .info-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: #212529;
        }
    </style>
</head>
<body>
    <div class="confirmation-header">
        <div class="container">
            <h1>Commande Confirmée</h1>
            <p>Merci pour votre achat chez ALUME</p>
        </div>
    </div>
    
    <div class="container">
        <div class="confirmation-container">
            <div class="confirmation-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h2>Votre commande a été validée avec succès !</h2>
            <p class="mb-4">Un email de confirmation a été envoyé à votre adresse email.</p>
            
            <div class="order-number">
                Commande n° <?php echo $idcommande; ?>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <a href="index.php?page=produit" class="btn btn-continue w-100">
                        <i class="fas fa-shopping-bag me-2"></i> Continuer mes achats
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="index.php?page=mes_commandes" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-clipboard-list me-2"></i> Voir mes commandes
                    </a>
                </div>
            </div>
        </div>
        
        <div class="info-section">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="info-card text-center">
                        <div class="info-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3 class="info-title">Livraison</h3>
                        <p>Votre commande sera préparée et expédiée dans les 24 à 48 heures ouvrables.</p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="info-card text-center">
                        <div class="info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3 class="info-title">Contact</h3>
                        <p>Notre service client est disponible pour toute question concernant votre commande.</p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="info-card text-center">
                        <div class="info-icon">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                        <h3 class="info-title">Retour</h3>
                        <p>Vous disposez de 30 jours pour retourner les articles qui ne vous conviendraient pas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
