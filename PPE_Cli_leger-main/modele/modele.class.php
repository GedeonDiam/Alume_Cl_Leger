<?php
class Modele {
	private $unPdo ; 
	//connexion via la classe PDO : PHP DATA Object 

	public function __construct(){
		$serveur = "localhost"; 
		$bdd = "ALUME"; 
		$user = "root";
		$mdp = ""; 
		try{
		$this->unPdo = new PDO("mysql:host=".$serveur.";dbname=".$bdd,$user, $mdp);
		}
		catch(PDOException $exp){
			echo "Erreur de connexion à la BDD";
		}
	}
	/**************** Gestion des clients ************/
	public function insertClient($tab){
		$requete = "insert into client values (null, :nom, :ville, :codepostal, :rue, :numrue, :email, :tel, :mdp);";
		$donnees = array(':nom' => $tab['nom'],
						 ':ville' => $tab['ville'],
						 ':codepostal' => $tab['codepostal'],
                         ':rue' => $tab['rue'],
                         ':numrue' => $tab['numrue'],
						 ':email' => $tab['email'],
						 ':tel' => $tab['tel'],
						 ':mdp' => $tab['mdp']
						); 
		//on prépare la requete 
		$exec = $this->unPdo->prepare ($requete);
		//exécuter la requete 
		$exec->execute ($donnees);
	}
 

	public function selectAllClients ($filtre){
		if($filtre == ""){
			$requete = "select * from client ;";
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ();
		}else{
			$requete = "select * from client where nom like :filtre or ville like :filtre or email like :filtre or tel like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%") ;
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ($donnees);
		}
		
		return $exec->fetchAll(); //extraire tous les clients
	}
	public function deleteClient($idclient){
		$requete = "delete from client where idclient = :idclient;";
		$donnees = array (':idclient' => $idclient);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	public function updateClient($tab){
		$requete = "update client set nom = :nom, ville = :ville, codepostal = :codepostal, rue = :rue, numrue = :numrue, email = :email, mdp = :mdp, tel = :tel where idclient = :idclient;";
		$donnees = array (':idclient' => $tab['idclient'],
						':nom' => $tab['nom'],
						':ville' => $tab['ville'],
						':codepostal' => $tab['codepostal'],
						':rue' => $tab['rue'],
						':numrue' => $tab['numrue'],
						':email' => $tab['email'],
						':mdp' => $tab['mdp'],
						':tel' => $tab['tel'],
						);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	public function selectWhereClient($idclient){
		$requete = "select * from client where idclient = :idclient;";
		$donnees = array (':idclient' => $idclient);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		$unClient = $exec->fetch(); //extraire un seul client
		return $unClient;
	}

	/**************** Gestion des techniciens ************/
	public function insertTechnicien($tab){
		$requete = "insert into technicien values (null, :nom, :prenom, :specialite, :email, :mdp);";
		$donnees = array(':nom' => $tab['nom'],
						':prenom' => $tab['prenom'],
						':specialite' => $tab['specialite'],
						':email' => $tab['email'],
						':mdp' => $tab['mdp'],
						); 
		//on prépare la requete 
		$exec = $this->unPdo->prepare ($requete);
		//exécuter la requete 
		$exec->execute ($donnees);
	}


	public function selectAllTechniciens ($filtre){
		
		if($filtre == ""){
			$requete = "select * from technicien ;";
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ();
		}else{
			$requete = "select * from technicien where nom like :filtre or prenom like :filtre or specialite like :filtre or email like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%") ;
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ($donnees);
		}

		return $exec->fetchAll(); //extraire tous les techniciens
		}
		public function deleteTechnicien($idtechnicien){
		$requete = "delete from technicien where idtechnicien = :idtechnicien;";
		$donnees = array (':idtechnicien' => $idtechnicien);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		}
		public function updateTechnicien($tab){
		$requete = "update technicien set nom = :nom, prenom = :prenom, specialite = :specialite, email = :email, mdp = :mdp where idtech = :idtech;";
		$donnees = array (':idtechnicien' => $tab['idtechnicien'],
						':nom' => $tab['nom'],
						':prenom' => $tab['prenom'],
						':specialite' => $tab['specialite'],
						':email' => $tab['email'],
						':mdp' => $tab['mdp'],
						);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		}
		public function selectWhereTechnicien($idtechnicien){
		$requete = "select * from technicien where idtechnicien = :idtechnicien;";
		$donnees = array (':idtechnicien' => $idtechnicien);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		$unTechnicien = $exec->fetch(); //extraire un seul client
		return $unTechnicien;
		}

		/**************** Gestion des produits ************/
	public function insertProduit($tab){
		$requete = "insert into produit values (null, :nomproduit, :prix_unit, :categorie);";
		$donnees = array(
			':nomproduit' => $tab['nomproduit'],
			':prix_unit' => $tab['prix_unit'],
			':categorie' => $tab['categorie']  
		); 
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
 

	public function selectAllProduits ($filtre){
		if($filtre == ""){
			$requete = "select * from produit ;";
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ();
		}else{
			$requete = "select * from produit where nomproduit like :filtre or prix_unit like :filtre or categorie like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%") ;
			$exec = $this->unPdo->prepare ($requete);
			$exec->execute ($donnees);
		}
		
		return $exec->fetchAll(); //extraire tous les clients
	}
	public function deleteProduit($idproduit){
		$requete = "delete from produit where idproduit = :idproduit;";
		$donnees = array (':idproduit' => $idproduit);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	public function updateProduit($tab){
		$requete = "update produit set nomproduit = :nomproduit, prix_unit = :prix_unit, categorie = :categorie where idproduit = :idproduit;"; 
		$donnees = array (':idproduit' => $tab['idproduit'],
						':nomproduit' => $tab['nomproduit'],
						':prix_unit' => $tab['prix_unit'],
						':categorie' => $tab['categorie']
						);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}
	public function selectWhereProduit($idproduit){
		$requete = "select * from produit where idproduit = :idproduit;";
		$donnees = array (':idproduit' => $idproduit);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		$unProduit = $exec->fetch(); //extraire un seul PRODUIT
		return $unProduit;
	}


	/********************************Gestions des users********************************************/

	public function verifConnexion($email, $mdp){
		try {
			$requete = "select * from technicien where email =:email and mdp=:mdp;";
			$exec = $this->unPdo->prepare($requete);
			$donnees = array(":email"=>$email, ":mdp"=>$mdp);
			$exec->execute($donnees);
			$resultat = $exec->fetch();
			
			if($resultat) {
				return array(
					"success" => true,
					"message" => "Connexion réussie !",
					"data" => $resultat
				);
			} else {
				return array(
					"success" => false,
					"message" => "Email ou mot de passe incorrect"
				);
			}
		} catch(PDOException $e) {
			return array(
				"success" => false,
				"message" => "Erreur de connexion : " . $e->getMessage()
			);
		}
	}

	/********************************Gestions des interventions********************************************/
	public function insertIntervention($tab){
		$requete = "insert into intervention values (:idtechnicien, :codecom, :datehd, :datehf, :etat);";
		$donnees = array(
			':idtechnicien' => $tab['idtechnicien'],
			':codecom' => $tab['codecom'],
			':datehd' => $tab['datehd'],
			':datehf' => $tab['datehf'],
			':etat' => $tab['etat']
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}

	public function selectAllInterventions($filtre){
		if($filtre == ""){
			$requete = "select * from intervention ;";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute();
		}else{
			$requete = "select * from intervention where idtechnicien like :filtre or codecom like :filtre or etat like :filtre;";
			$donnees = array(":filtre"=>"%".$filtre."%");
			$exec = $this->unPdo->prepare($requete);
			$exec->execute($donnees);
		}
		return $exec->fetchAll();
	}

	public function deleteIntervention($idtechnicien, $codecom, $datehd){
		$requete = "delete from intervention where idtechnicien = :idtechnicien and codecom = :codecom and datehd = :datehd;";
		$donnees = array(
			':idtechnicien' => $idtechnicien,
			':codecom' => $codecom,
			':datehd' => $datehd
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}

	public function updateIntervention($tab){
		$requete = "update intervention set datehf = :datehf, etat = :etat where idtechnicien = :idtechnicien and codecom = :codecom and datehd = :datehd;";
		$donnees = array(
			':idtechnicien' => $tab['idtechnicien'],
			':codecom' => $tab['codecom'],
			':datehd' => $tab['datehd'],
			':datehf' => $tab['datehf'],
			':etat' => $tab['etat']
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
	}

	public function selectWhereIntervention($idtechnicien, $codecom, $datehd){
		$requete = "select * from intervention where idtechnicien = :idtechnicien and codecom = :codecom and datehd = :datehd;";
		$donnees = array(
			':idtechnicien' => $idtechnicien,
			':codecom' => $codecom,
			':datehd' => $datehd
		);
		$exec = $this->unPdo->prepare($requete);
		$exec->execute($donnees);
		return $exec->fetch();
	}

	/********************************Gestions des commandes********************************************/
    public function insertCommande($tab){
        $requete = "insert into commande values (null, :etatcom, :codedevis);";
        $donnees = array(
            ':etatcom' => $tab['etatcom'],
            ':codedevis' => $tab['codedevis']
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectAllCommandes($filtre){
        if($filtre == ""){
            $requete = "select * from commande;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
        }else{
            $requete = "select * from commande where etatcom like :filtre or codedevis like :filtre;";
            $donnees = array(":filtre"=>"%".$filtre."%");
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
        }
        return $exec->fetchAll();
    }

    public function deleteCommande($idcommande){
        $requete = "delete from commande where idcommande = :idcommande;";
        $donnees = array(':idcommande' => $idcommande);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function updateCommande($tab){
        $requete = "update commande set etatcom = :etatcom, codedevis = :codedevis where idcommande = :idcommande;";
        $donnees = array(
            ':idcommande' => $tab['idcommande'],
            ':etatcom' => $tab['etatcom'],
            ':codedevis' => $tab['codedevis']
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectWhereCommande($idcommande){
        $requete = "select * from commande where idcommande = :idcommande;";
        $donnees = array(':idcommande' => $idcommande);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
        return $exec->fetch();
    }

	/********************************Gestions des devis********************************************/
    public function insertDevis($tab){
        $requete = "insert into devis values (null, :datedevis, :etatdevis, :idclient);";
        $donnees = array(
            ':datedevis' => $tab['datedevis'],
            ':etatdevis' => $tab['etatdevis'],
            ':idclient' => $tab['idclient']
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectAllDevis($filtre){
        if($filtre == ""){
            $requete = "select d.*, c.nom as nom_client from devis d 
                       inner join client c on d.idclient = c.idclient;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
        }else{
            $requete = "select d.*, c.nom as nom_client from devis d 
                       inner join client c on d.idclient = c.idclient 
                       where datedevis like :filtre or etatdevis like :filtre 
                       or c.nom like :filtre;";
            $donnees = array(":filtre"=>"%".$filtre."%");
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
        }
        return $exec->fetchAll();
    }

    public function deleteDevis($iddevis){
        $requete = "delete from devis where iddevis = :iddevis;";
        $donnees = array(':iddevis' => $iddevis);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function updateDevis($tab){
        $requete = "update devis set datedevis = :datedevis, etatdevis = :etatdevis, 
                    idclient = :idclient where iddevis = :iddevis;";
        $donnees = array(
            ':iddevis' => $tab['iddevis'],
            ':datedevis' => $tab['datedevis'],
            ':etatdevis' => $tab['etatdevis'],
            ':idclient' => $tab['idclient']
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectWhereDevis($iddevis){
        $requete = "select d.*, c.nom as nom_client from devis d 
                   inner join client c on d.idclient = c.idclient 
                   where iddevis = :iddevis;";
        $donnees = array(':iddevis' => $iddevis);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
        return $exec->fetch();
    }

	/********************************Gestions des administrateurs********************************************/
    public function insertAdmin($tab){
        $requete = "insert into administrateur values (null, :nom, :prenom, :email, :mdp);";
        $donnees = array(
            ':nom' => $tab['nom'],
            ':prenom' => $tab['prenom'],
            ':email' => $tab['email'],
            ':mdp' => $tab['mdp'],
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectAllAdmins($filtre){
        if($filtre == ""){
            $requete = "select * from administrateur;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
        }else{
            $requete = "select * from administrateur where nom like :filtre or prenom like :filtre or email like :filtre;";
            $donnees = array(":filtre"=>"%".$filtre."%");
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
        }
        return $exec->fetchAll();
    }

    public function deleteAdmin($idadmin){
        $requete = "delete from administrateur where idadmin = :idadmin;";
        $donnees = array(':idadmin' => $idadmin);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function updateAdmin($tab){
        $requete = "update administrateur set nom = :nom, prenom = :prenom, email = :email, mdp = :mdp where idadmin = :idadmin;";
        $donnees = array(
            ':idadmin' => $tab['idadmin'],
            ':nom' => $tab['nom'],
            ':prenom' => $tab['prenom'],
            ':email' => $tab['email'],
            ':mdp' => $tab['mdp'],
        );
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
    }

    public function selectWhereAdmin($idadmin){
        $requete = "select * from administrateur where idadmin = :idadmin;";
        $donnees = array(':idadmin' => $idadmin);
        $exec = $this->unPdo->prepare($requete);
        $exec->execute($donnees);
        return $exec->fetch();
    }

    public function verifConnexionAdmin($email, $mdp) {
		try {
			$requete = "select * from administrateur where email = :email and mdp = :mdp;";
			$donnees = array(':email' => $email, ':mdp' => $mdp);
			$exec = $this->unPdo->prepare($requete);
			$exec->execute($donnees);
			$resultat = $exec->fetch();
			return $resultat;  // Retourne false si aucun administrateur trouvé
		} catch(PDOException $e) {
			echo "Erreur de connexion admin : " . $e->getMessage();
			return false;
		}
	}

    public function deconnexion() {
        session_start();
        session_destroy();
        unset($_SESSION);
        return true;
    }
}
?>