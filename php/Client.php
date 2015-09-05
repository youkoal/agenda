<?php
class Client
{

	private $_id;
	private $_pseudo;
	private $_pass;
	private $_mail;
	private $_tel1;
	private $_tel2;


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
  	public function id() 		  { return $this->_id; 		  }
  	public function pseudo() 	{ return $this->_pseudo; 	}
  	public function pass() 		{ return $this->_pass; 		}
  	public function mail() 		{ return $this->_mail; 		}
  	public function tel1() 		{ return $this->_tel1; 		}
  	public function tel2() 		{ return $this->_tel2; 		}


	//setters
	public function setId($id)
  	{
    	// L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    	$this->_id = (int) $id;
  	}
        
  	public function setPseudo($nom)
  	{
    	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
    	// Dont la longueur est inférieure à 60 caractères.
    	if (is_string($nom) && strlen($nom) <= 60)
    	{
      		$this->_pseudo = $nom;
    	}
  	}

  	public function setMail($mail)
  	{
    	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
    	// Dont la longueur est inférieure à 60 caractères.
    	if (is_string($mail) && strlen($mail) <= 60)
    	{
      		$this->_mail = $mail;
    	}
  	}


  	public function setTel1($tel)
  	{
    	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
    	// Dont la longueur est inférieure à 20 caractères.
    	if (is_string($tel) && strlen($tel) <= 20)
    	{
      		$this->_tel1 = $tel;
    	}
  	}

  	public function setTel2($tel)
  	{
    	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
    	// Dont la longueur est inférieure à 20 caractères.
    	if (is_string($tel) && strlen($tel) <= 20)
    	{
      		$this->_tel2 = $tel;
    	}
  	}


  	public function setPass($pass)
  	{
    	// On vérifie qu'il s'agit bien d'une chaîne de caractères.
    	// Dont la longueur est inférieure à 60 caractères.
    	if (is_string($pass) && strlen($pass) <= 60)
    	{
      		$this->_pass = $pass;
    	}
  	}





	
}









?>