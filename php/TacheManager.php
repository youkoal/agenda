<?php
class TacheManager
{
	private $_db; // Instance de PDO
  
  	public function __construct($db)
  	{
    	$this->setDb($db);
  	}



	public function setDb(PDO $db)
	  {
	    $this->_db = $db;
	  }


	public function add(Tache $tache)
	{
		date_default_timezone_set('Indian/Reunion');
	    // Préparation de la requête d'insertion.
	    $q = $this->_db->prepare('INSERT INTO taches SET clientId= :id, dateEntree= :entree, dateE= :dateE, titre= :titre, texte= :texte');

	    // Assignation des valeurs pour le nom du Client.
	    $q->bindValue(':id', 		 $tache->clientId(), PDO::PARAM_INT);
	    $q->bindValue(':dateEntree', date('Y-m-d'), 	 PDO::PARAM_STR);//date du jour
	    $q->bindValue(':dateE', 	 $tache->dateE(), 	 PDO::PARAM_STR);
	    $q->bindValue(':titre', 	 $tache->titre(), 	 PDO::PARAM_STR);
	    $q->bindValue(':texte', 	 $tache->texte(), 	 PDO::PARAM_STR);

	    // Exécution de la requête.
	      $q->execute();
	    
	    // Hydratation de la tache passé en paramètre avec assignation de son identifiant + date de l'entrée
	      $tache->hydrate([
	        'id' => $this->_db->lastInsertId(),
	        'dateEntree' => date('Y-m-d'),
	      ]);
	}


	public function delete($id)
	{
	    // Exécute une requête de type DELETE.
	    $q = $this->_db->prepare('DELETE * FROM taches WHERE id= :id');
	    $q->bindValue(':id', $id, PDO::PARAM_INT);
	    $q->execute();
	}


	public function get($id)
  	{
    	//on veut récupérer la tache avec son identifiant.
	    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Client.
	    $q = $this->_db->query('SELECT * FROM taches WHERE id = '.$id);
	    $donnees = $q->fetch(PDO::FETCH_ASSOC);
	    $t=new Tache();
	   	$t->hydrate($donnees);
	    return $t;
  	}


  	public function getFromTo($from,$to,$idc)
  	{
  		$taches=[];
    	//on veut récupérer la tache avec son identifiant.
	    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Client.
	    $q = $this->_db->prepare('SELECT id,dateE,titre FROM taches WHERE (dateE  BETWEEN :fro AND :to ) AND clientId= :idc order by dateE');
	    $q->bindValue(':fro',$from,PDO::PARAM_STR);
	    $q->bindValue(':to',$to,PDO::PARAM_STR);
	    $q->bindValue(':idc',$idc,PDO::PARAM_INT);
	    $q->execute();
	    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	    {
	      	$t= new Tache();
	      	$t->hydrate($donnees);
	      	$taches[] = $t;
	    }
	    return $taches;
  	}

  	public function getAll($idc)
  	{
  		$taches=[];
    	//on veut récupérer la tache avec son identifiant.
	    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Client.
	    $q = $this->_db->prepare('SELECT id,dateE,titre FROM taches WHERE clientId= :idc order by dateE');
	    $q->bindValue(':idc',$idc,PDO::PARAM_INT);
	    $q->execute();
	    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	    {
	      	$t= new Tache();
	      	$t->hydrate($donnees);
	      	$taches[] = $t;
	    }
	    return $taches;
  	}

  	public function getEntreeFromTo($from,$to,$idc)
  	{
  		$taches=[];
    	//on veut récupérer la tache avec son identifiant.
	    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Client.
	    $q = $this->_db->prepare('SELECT id,dateE,dateEntree,titre FROM taches WHERE (dateEntree  BETWEEN :fro AND :to ) AND clientId= :idc order by dateEntree');
	    $q->bindValue(':fro',$from,PDO::PARAM_STR);
	    $q->bindValue(':to',$to,PDO::PARAM_STR);
	    $q->bindValue(':idc',$idc,PDO::PARAM_INT);
	    $q->execute();
	    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	    {
	      	$t= new Tache();
	      	$t->hydrate($donnees);
	      	$taches[] = $t;
	    }
	    return $taches;
  	}

  	
  	public function update(Tache $tache)
  	{
	    // Prépare une requête de type UPDATE.
	    $q = $this->_db->prepare('UPDATE taches SET dateEntree = :dateEntree, dateE = :dateE, titre = :titre, texte = :texte WHERE id = :id');
	    // Assignation des valeurs à la requête.
	    $q->bindValue(':id', 		 $tache->id(), 	  PDO::PARAM_INT);
	    $q->bindValue(':dateEntree', date('Y-m-d'),   PDO::PARAM_STR);
	    $q->bindValue(':dateE', 	 $tache->dateE(), PDO::PARAM_STR);
	    $q->bindValue(':titre', 	 $tache->titre(), PDO::PARAM_STR);
	    $q->bindValue(':texte', 	 $tache->texte(), PDO::PARAM_STR);
	    $q->execute();
  	}

}//fin class
?>
