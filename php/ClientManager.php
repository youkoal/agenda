<?php
class ClientManager
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
  


    public function add(Client $perso)
  {
    // Préparation de la requête d'insertion.
    $q = $this->_db->prepare('INSERT INTO clients SET pseudo = :nom, pass = :pass, mail = :mail, tel1 = :tel1, tel2 = :tel2');

    // Assignation des valeurs pour le nom du Client.
    $q->bindValue(':nom', 	$perso->pseudo(), PDO::PARAM_STR);
    $q->bindValue(':pass', 	$perso->pass(), 	PDO::PARAM_STR);
    $q->bindValue(':mail', 	$perso->mail(), 	PDO::PARAM_STR);
    $q->bindValue(':tel1', 	$perso->tel1(), 	PDO::PARAM_STR);
    $q->bindValue(':tel2', 	$perso->tel2(), 	PDO::PARAM_STR);

    // Exécution de la requête.
      $q->execute();
    
    // Hydratation du Client passé en paramètre avec assignation de son identifiant et des dégâts initiaux (= 0).
      $perso->hydrate([
        'id' => $this->_db->lastInsertId(),
      ]);
  }
  
  public function count()
  {
    // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
    return $this->_db->query('SELECT COUNT(*) FROM clients')->fetchColumn();
  }
  
  public function delete(Client $perso)
  {
    // Exécute une requête de type DELETE.
    $q = $this->_db->prepare('DELETE * FROM clients WHERE id= :id');
    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
    $q->execute();
  }
  
  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel Client ayant pour id $info existe.
    {
      return (bool) $this->_db->query('SELECT COUNT(*) FROM clients WHERE id = '.$info)->fetchColumn();
    }
    
    // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
    
    $q = $this->_db->prepare('SELECT COUNT(*) FROM clients WHERE pseudo = :nom');
    $q->execute([':nom' => $info]);
    
    return (bool) $q->fetchColumn();
  }
  
  public function get($info)
  {
    // Si le paramètre est un entier, on veut récupérer le Client avec son identifiant.
    if (is_int($info))
    {
      // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Client.
      $q = $this->_db->query('SELECT * FROM clients WHERE id = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      return new Client($donnees);
    }
    // Sinon, on veut récupérer le Client avec son nom.
    else
    {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Client.
      $q = $this->_db->query('SELECT id,pseudo,mail FROM clients WHERE pseudo = \''.$info.'\'');
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      $c = new Client();
      $c->hydrate($donnees);
      return $c;
    }
  }
  
  public function getList($nom)
  {
    $persos = [];
    
    $q = $this->_db->prepare('SELECT id, pseudo FROM clients WHERE pseudo <> :nom ORDER BY pseudo');
    $q->execute([':nom' => $nom]);
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $c= new Client();
      $c->hydrate($donnees);
      $persos[] = $c;
    }
    
    return $persos;
  }
  
  public function update(Client $perso)
  {
    // Prépare une requête de type UPDATE.
    $q = $this->_db->prepare('UPDATE clients SET pseudo = :nom, pass = :pass, mail = :mail, tel1 = :tel1, tel2 = :tel2 WHERE id = :id');
    // Assignation des valeurs à la requête.
    $q->bindValue(':id', $perso->id(), 			  PDO::PARAM_INT);
    // Exécution de la requête.
    $q->bindValue(':nom', 	$perso->pseudo(), PDO::PARAM_STR);
    $q->bindValue(':pass', 	$perso->pass(), 	PDO::PARAM_STR);
    $q->bindValue(':mail', 	$perso->mail(), 	PDO::PARAM_STR);
    $q->bindValue(':tel1', 	$perso->tel1(), 	PDO::PARAM_STR);
    $q->bindValue(':tel2', 	$perso->tel2(), 	PDO::PARAM_STR);

  }


}
?>