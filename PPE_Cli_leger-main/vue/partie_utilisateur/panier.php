<?php
require_once("modele/modele.class.php");
require_once("controleur/controleur.class.php");
require_once("vue/composants/alert_popup.php");
$unControleur = new Controleur();

// Vérifier que l'utilisateur est connecté et a le rôle client
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'client') {
    echo '<div class="alert alert-warning p-4 m-4">
            <h4 class="alert-heading">Accès réservé</h4>
            <p>Vous devez être connecté en tant que client pour accéder à votre panier.</p>
            <hr>
            <div class="d-flex gap-2">
                <a href="index.php?page=connexion" class="btn btn-primary">Se connecter</a>
                <a href="index.php?page=inscription_client" class="btn btn-outline-primary">S\'inscrire</a>
            </div>
        </div>';
} else {
    // Récupération de l'ID du client depuis la session
    $idclient = $_SESSION['idclient'];

    // Récupération ou création d'un panier actif pour ce client
    $unPanier = $unControleur->getPanierActif($idclient);
    $idpanier = $unPanier['idpanier'];

    // Traitement des actions
    $message = '';
    $messageType = '';

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'vider':
                $resultat = $unControleur->viderPanier($idpanier);
                if ($resultat['success']) {
                    $message = $resultat['message'];
                    $messageType = 'success';
                } else {
                    $message = $resultat['message'];
                    $messageType = 'danger';
                }
                break;

            case 'supprimer':
                if (isset($_GET['idproduit'])) {
                    $resultat = $unControleur->supprimerProduitPanier($idpanier, $_GET['idproduit']);
                    if ($resultat['success']) {
                        $message = $resultat['message'];
                        $messageType = 'success';
                    } else {
                        $message = $resultat['message'];
                        $messageType = 'danger';
                    }
                }
                break;

            case 'valider':
                $resultat = $unControleur->validerPanier($idpanier, $idclient);
                if ($resultat['success']) {
                    $message = $resultat['message'];
                    $messageType = 'success';
                    // Redirection pour éviter de revalider le panier si l'utilisateur rafraîchit la page
                    echo "<div class='text-center my-4'>
                            <div class='spinner-border text-warning' role='status'>
                                <span class='visually-hidden'>Chargement...</span>
                            </div>
                            <p class='mt-2'>Redirection vers votre confirmation de commande...</p>
                          </div>
                          <script>
                            setTimeout(function() {
                                window.location.href = 'index.php?page=commande_confirmation&idcommande=" . $resultat['idcommande'] . "';
                            }, 2000);
                          </script>";
                } else {
                    $message = $resultat['message'];
                    $messageType = 'danger';
                }
                break;
        }
    }

    // Traitement du formulaire de mise à jour des quantités
    if (isset($_POST['update_cart'])) {
        $updated = false;
        if (isset($_POST['quantite']) && is_array($_POST['quantite'])) {
            foreach ($_POST['quantite'] as $idproduit => $quantite) {
                $resultat = $unControleur->modifierQuantitePanier($idpanier, $idproduit, intval($quantite));
                if ($resultat['success']) {
                    $updated = true;
                }
            }
            if ($updated) {
                $message = 'Panier mis à jour avec succès';
                $messageType = 'success';
            }
        }
    }

    // Récupération des produits dans le panier
    $produitsPanier = $unControleur->getProduitsPanier($idpanier);
    $totalPanier = $unControleur->getTotalPanier($idpanier);
    $nombreArticles = $unControleur->getNombreArticlesPanier($idpanier);
?>

    <style>
        .page-header-panier {
            background: linear-gradient(135deg, #080808 0%, #333333 100%);
            padding: 50px 0;
            margin-bottom: 40px;
            color: white;
            text-align: center;
            border-bottom: 3px solid #FFFD55;
        }

        .page-header-panier h1 {
            font-weight: 600;
            color: #FFFD55;
            margin-bottom: 10px;
        }

        .cart-container-panier {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .cart-header-panier {
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .cart-item-panier {
            padding: 15px 0;
            border-bottom: 1px solid #f1f1f1;
            display: flex;
            align-items: center;
        }

        .item-image-panier {
            width: 80px;
            height: 80px;
            background-color: #f9f9f9;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .item-image-panier i {
            font-size: 30px;
            color: #ccc;
        }

        .item-details-panier {
            flex-grow: 1;
        }

        .item-title-panier {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-category-panier {
            color: #6c757d;
            font-size: 0.9em;
            margin-bottom: 5px;
        }

        .item-price-panier {
            color: #212529;
            font-weight: 500;
        }

        .item-quantity-panier {
            margin: 0 15px;
        }

        .quantity-input-panier {
            width: 60px;
            text-align: center;
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px;
        }

        .item-total-panier {
            font-weight: 600;
            min-width: 80px;
            text-align: right;
        }

        .item-remove-panier {
            margin-left: 15px;
        }

        .cart-summary-panier {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .summary-title-panier {
            font-weight: 600;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .summary-item-panier {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-total-panier {
            font-weight: 700;
            font-size: 1.2em;
            border-top: 2px solid #f1f1f1;
            padding-top: 15px;
            margin-top: 15px;
        }

        .btn-black-panier {
            background-color: #080808;
            color: #FFFD55;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .btn-black-panier:hover {
            background-color: #FFFD55;
            color: #080808;
        }

        .btn-outline-panier {
            background-color: transparent;
            color: #080808;
            border: 1px solid #080808;
        }

        .btn-outline-panier:hover {
            background-color: #080808;
            color: #FFFD55;
        }

        .empty-cart-panier {
            text-align: center;
            padding: 50px 0;
        }

        .empty-cart-panier i {
            font-size: 60px;
            color: #ccc;
            margin-bottom: 20px;
        }

        .empty-cart-panier p {
            color: #6c757d;
            margin-bottom: 20px;
        }
    </style>
    <div>
        <div class="page-header-panier">
            <div class="container">
                <h1>Mon Panier</h1>
                <p>Gérez vos achats avant de finaliser votre commande</p>
            </div>
        </div>

        <div class="container mb-5">
            <!-- Les messages de notification seront maintenant gérés par JavaScript -->
            <div id="notification-container-panier" style="display: none;">
                <input type="hidden" id="message-content" value="<?php echo htmlspecialchars($message); ?>">
                <input type="hidden" id="message-type" value="<?php echo htmlspecialchars($messageType); ?>">
            </div>
            <?php if (!empty($message)) showAlertPopup($message, $messageType); ?>

            <?php if (empty($produitsPanier)): ?>
                <div class="empty-cart-panier">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Votre panier est vide</h3>
                    <p>Découvrez nos produits et commencez votre shopping</p>
                    <a href="index.php?page=produit" class="btn btn-black-panier">Voir les produits</a>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-container-panier">
                            <div class="cart-header-panier d-flex justify-content-between align-items-center">
                                <h2>Articles dans votre panier (<?php echo $nombreArticles; ?>)</h2>
                                <a href="index.php?page=panier&action=vider" class="btn btn-sm btn-outline-panier" onclick="return confirm('Voulez-vous vraiment vider votre panier ?');">
                                    Vider le panier
                                </a>
                            </div>

                            <form method="post" action="index.php?page=panier">
                                <?php foreach ($produitsPanier as $produit): ?>
                                    <div class="cart-item-panier">
                                        <div class="item-image-panier">
                                            <i class="fas fa-lightbulb"></i>
                                        </div>
                                        <div class="item-details-panier">
                                            <div class="item-title-panier"><?php echo htmlspecialchars($produit['nomproduit']); ?></div>
                                            <div class="item-category-panier"><?php echo htmlspecialchars($produit['categorie']); ?></div>
                                            <div class="item-price-panier"><?php echo number_format($produit['prixUnitaire'], 2, ',', ' '); ?> €</div>
                                        </div>
                                        <div class="item-quantity-panier">
                                            <input type="number" name="quantite[<?php echo $produit['idproduit']; ?>]"
                                                value="<?php echo $produit['quantite']; ?>" min="1" max="99"
                                                class="quantity-input-panier">
                                        </div>
                                        <div class="item-total-panier">
                                            <?php echo number_format($produit['prixUnitaire'] * $produit['quantite'], 2, ',', ' '); ?> €
                                        </div>
                                        <div class="item-remove-panier">
                                            <a href="index.php?page=panier&action=supprimer&idproduit=<?php echo $produit['idproduit']; ?>"
                                                class="text-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <div class="text-end mt-4">
                                    <button type="submit" name="update_cart" class="btn btn-outline-panier">
                                        <i class="fas fa-sync-alt me-2"></i>Mettre à jour le panier
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-summary-panier">
                            <h3 class="summary-title-panier">Récapitulatif de la commande</h3>

                            <div class="summary-item-panier">
                                <span>Sous-total</span>
                                <span><?php echo number_format($totalPanier, 2, ',', ' '); ?> €</span>
                            </div>
                            <div class="summary-item-panier">
                                <span>Frais de livraison</span>
                                <span>Gratuit</span>
                            </div>

                            <div class="summary-total-panier">
                                <span>Total</span>
                                <span><?php echo number_format($totalPanier, 2, ',', ' '); ?> €</span>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="index.php?page=panier&action=valider" class="btn btn-black-panier btn-lg">
                                    Valider ma commande
                                </a>
                                <a href="index.php?page=produit" class="btn btn-outline-panier btn-lg">
                                    Continuer mes achats
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <script src="assets/js/notifications.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Récupération des messages PHP et affichage en pop-up si nécessaire
                const messageContent = document.getElementById('message-content').value;
                const messageType = document.getElementById('message-type').value;
                
                if (messageContent) {
                    showNotification(messageContent, messageType);
                }
            });
        </script>
    </div>
<?php
}
?>
