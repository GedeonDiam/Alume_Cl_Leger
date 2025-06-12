<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <h1 class="custom-title container"> Site ALU-ME pour la gestion des projets d'équipement </h1> 
    <br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="mb-4">Inscription au Site ALU-ME</h3>
                        <img src="img/Logo.png" height="100" width="100" class="mb-4">
                        
                        <?php if(isset($message)): ?>
                            <div class="alert <?= isset($success) && $success ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
                                <i class="bi <?= isset($success) && $success ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' ?> me-2"></i>
                                <?= $message ?>
                                <?php if(isset($errors) && is_array($errors) && count($errors) > 0): ?>
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
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" name="nom" placeholder="Nom" required
                                           value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '' ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-building"></i></span>
                                    <input type="text" class="form-control" name="ville" placeholder="Ville" required
                                           value="<?= isset($_POST['ville']) ? htmlspecialchars($_POST['ville']) : '' ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" class="form-control" name="codepostal" placeholder="Code postal" required
                                           value="<?= isset($_POST['codepostal']) ? htmlspecialchars($_POST['codepostal']) : '' ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-signpost"></i></span>
                                    <input type="text" class="form-control" name="rue" placeholder="Rue" required
                                           value="<?= isset($_POST['rue']) ? htmlspecialchars($_POST['rue']) : '' ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-house-door"></i></span>
                                    <input type="text" class="form-control" name="numrue" placeholder="Numéro de rue" required
                                           value="<?= isset($_POST['numrue']) ? htmlspecialchars($_POST['numrue']) : '' ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required
                                           value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="tel" class="form-control" name="tel" placeholder="Téléphone" required
                                           value="<?= isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '' ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" required>
                                </div>
                                <div class="form-text text-start mt-1">
                                    <small>Le mot de passe doit contenir au moins:</small>
                                    <ul class="small ps-3 mb-0">
                                        <li>8 caractères</li>
                                        <li>Une lettre majuscule</li>
                                        <li>Une lettre minuscule</li>
                                        <li>Un chiffre</li>
                                        <li>Un caractère spécial</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" name="confirm_mdp" placeholder="Confirmer le mot de passe" required>
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
</body>
</html>