<h1 class="custom-title container"> Site ALU-ME pour la gestion des projets d'équipement </h1> 
<br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="mb-4">Connexion au Site Orange</h3>
                        <img src="img/Logo.png" height="100" width="100" class="mb-4">
                        
                        <?php if(isset($message)): ?>
                            <div class="alert <?= $success ? 'alert-success' : 'alert-danger' ?>" role="alert">
                                <?= $message ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post">
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email" >
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="mdp" placeholder="Mot de passe">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" name="Connexion" class="btn btn-primary">Connexion</button>
                                <button type="reset" name="Annuler" class="btn btn-secondary">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
