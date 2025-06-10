<div class="container">
    <h3>Ajout d'un produit</h3>
    <form method="post" class="form-technicien" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Nom du produit : </td>
                <td><input type="text" name="nomproduit" class="form-input" required value="<?= ($leProduit==null)?' ':$leProduit['nomproduit']?>"></td>
            </tr>

            <tr>
                <td>Prix unitaire : </td>
                <td><input type="number" name="prix_unit" class="form-input" required value="<?= ($leProduit==null)?' ':$leProduit['prix_unit']?>"></td>
            </tr>

            <tr>
                <td>Catégorie : </td>
                <td><input type="text" name="categorie" class="form-input" required value="<?= ($leProduit==null)?' ':$leProduit['categorie']?>"></td>
            </tr>

            <tr>
                <td>Image : </td>
                <td>
                    <input type="text" name="image" class="form-input" placeholder="Nom du fichier image" value="<?= ($leProduit==null)?' ':$leProduit['image']?>">
                    <?php if($leProduit != null && !empty($leProduit['image']) && $leProduit['image'] != 'default_product.jpg'): ?>
                        <div class="image-preview">
                            <img src="images/produits/<?= $leProduit['image'] ?>" alt="Aperçu du produit" height="100">
                        </div>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <td>Description : </td>
                <td>
                    <textarea name="description" class="form-input form-textarea" rows="4"><?= ($leProduit==null)?' ':$leProduit['description']?></textarea>
                </td>
            </tr>

            <tr>
                <td><input type="reset" name="Annuler" value="Annuler" class="btn btn-secondary"></td>
                <td><input type="submit" class="btn btn-primary"
                    <?= ($leProduit==null)?'name="Valider" value="Valider"':
                    'name="Modifier" value="Modifier"'?>></td>
            </tr>

            <?= ($leProduit==null)?'':'<input type="hidden" name="idproduit" value="'.$leProduit['idproduit'].'">'?>
        </table>
    </form>
</div>

<style>
    .container {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    h3 {
        color: #000000;
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
        text-transform: uppercase;
    }

    .form-technicien table {
        width: 100%;
        border-spacing: 0 15px;
    }

    .form-technicien td {
        padding: 8px;
        color: #000000;
    }

    .form-input {
        width: 100%;
        padding: 8px 12px;
        border: 2px solid #000000;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }

    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #FFD700;
        box-shadow: 0 0 5px rgba(255,215,0,0.3);
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #FFD700;
        color: #000000;
        border: 2px solid #000000;
    }

    .btn-secondary {
        background-color: #000000;
        color: #FFD700;
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .form-input:hover, .form-textarea:hover {
        border-color: #FFD700;
    }

    .form-input:required {
        border-left: 4px solid #FFD700;
    }

    .image-preview {
        margin-top: 8px;
        padding: 5px;
        border: 1px dashed #ccc;
        display: inline-block;
    }
</style>