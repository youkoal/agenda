<?php
class Tache
{
	private $_id;
	private $_clientId;
  private $_dateEntree;
	private $_dateE;
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
  	public function id() 		    { return $this->_id; 		    }
  	public function clientId() 	{ return $this->_clientId;  }
    public function dateEntree(){ return $this->_dateEntree;}
  	public function dateE()     { return $this->_dateE;     }
  	public function titre() 	  { return $this->_titre; 	  }
  	public function texte() 	  { return $this->_texte; 	  }


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


    public function setDateEntree($date)
    {
      if (is_string($date) && strlen($date) <= 11)
      {
        //on stocke la date comme étant une chaine de charactere
          $this->_dateEntree = $date;
      }
    }
      

  	public function setDateE($date)
  	{
  		if (is_string($date) && strlen($date) <= 11)
  		{
  			//on stocke la date comme étant une chaine de charactere
      		$this->_dateE = $date;
      }
  	}


  	public function setTitre($titre)
  	{
  		if (is_string($titre) && strlen($titre) <= 120)
		{
    		$this->_titre = $titre;
    	}
  	}


  	public function setTexte($texte)
  	{
  		if (is_string($texte) && strlen($texte) <= 1200)
		  {
    		$this->_texte = $texte;
    	}
  	}


}//end class


?>