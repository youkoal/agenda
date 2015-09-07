<?php
require_once('/TacheManager.php');
class utilService
{

	private $_db; // Instance de PDO
	private $_tmanager;
  	public function __construct($db)
  	{
    	$this->tmanager=new TacheManager($db);
  	}

	
  	public function tmanager(){return $_tmanager;}
	//creation d'un nouvel utilisateur
	public function creeNewClient($manager)
	{
	    $perso = new Client(); // On crée un nouveau Client.
  		$perso->hydrate(['pseudo' => $_POST['nom'],'pass' => $_POST['pass']]);
  
		if ($manager->exists($_POST['nom']))
		{
		    echo('Le nom du Client est déjà pris.');
		    unset($perso);
		}
		else
		{
			$manager->add($perso);
		    echo('creation réusie');
		}
	}


	public function connectUser($RService,$manager,$nom,$tmanager)
	{
		if ($manager->exists($nom)) // Si celui-ci existe.
		{
		    $perso = $manager->get($nom);
		    $_SESSION['perso']=$perso;
		    $this->userRender($RService,$manager,$perso);
		    $this->Taches($RService,$perso);
		}
		else
		{
		    echo('Ce Client n\'existe pas !'); // S'il n'existe pas, on affichera ce message.
		}	
	}

	public function userRender($RService,$manager,$perso)
	{
		echo ('<div id="persos">');
			//affiche info de l'utilisateur courant
			$RService->renderClient($perso); 
			$RService->renderListU($manager->getList($perso->pseudo())); 
		echo ('</div>');
	}

	public function editRender($RService,$manager,$perso)
	{
		echo ('<div id="persos">');
  		//affiche info de l'utilisateur courant
  		$RService->renderModif($perso); 
  		$RService->renderListU($manager->getList($perso->pseudo())); 
  		echo ('</div>');
	}

	public function editSending($perso,$manager)
	{
		$perso->hydrate(['pseudo' => $_POST['nom'],'pass' => $_POST['pass'],'mail' =>$_POST['mail'],'tel1' => $_POST['tel1'],'tel2' => $_POST['tel2']]);
    	$manager->update($perso);
    	$_SESSION['perso']=$perso;
    	header('Location: acc.php');
	}

	public function Taches($RService,$perso)
	{
		$taches=$this->tmanager()->getAll($perso->id());
		$RService->renderTaches($taches);
	}


}//fin class

?>