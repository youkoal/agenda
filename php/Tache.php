<?php
class Tache
{
	private $_id;
	private $_clientId;
	private $_dateDebut;
	private $_dateFin;
	private $_titre;
	private $_texte;

	//hydratation
	public function hydrate(array $donnees)
	{
	  foreach ($donnees as $key => $value)
	  {
	    // On récupère le nom du setter correspondant à l'attribut.
	    $method = 'set'.ucfirst($key);
	        
	    // Si le setter correspondant existe.
	    if (method_exists($this, $method))
	    {
	      // On appelle le setter.
	      $this->$method($value);
	    }
	  }
	}

	//getters
  	public function id() 		{ return $this->_id; 		}
  	public function clientId() 	{ return $this->_clientId; 	}
  	public function dateDebut() { return $this->_dateDebut; }
  	public function dateFin() 	{ return $this->_dateFin; 	}
  	public function titre() 	{ return $this->_titre; 	}
  	public function texte() 	{ return $this->_texte; 	}


  	//setters
	public function setId($id)
  	{
    	// L'identifiant de la tache sera, quoi qu'il arrive, un nombre entier.
    	$this->_id = (int) $id;
  	}


  	public function setClientId($id)
  	{
    	// L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    	$this->_clientId = (int) $id;
  	}
      

  	public function setDateDebut($date)
  	{
  		if (validateDate($date))
		{
			//on stocke la date comme étant une chaine de charactere
    		$this->_dateDebut = (str) $date;
    	}
  	}

  	public function setDateFin($date)
  	{
  		if (validateDate($date))
		{
			//on stocke la date comme étant une chaine de charactere
    		$this->_dateFin = (str) $date;
    	}
  	}


  	public function setTitre($titre)
  	{
  		if (is_string($titre) && strlen($titre) <= 120)
		{
    		$this->_titre = (str) $titre;
    	}
  	}


  	public function setTexte($texte)
  	{
  		if (is_string($texte) && strlen($texte) <= 1200)
		{
    		$this->_texte = (str) $texte;
    	}
  	}


}//end class
?>