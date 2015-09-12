<?php

	$db = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
	$manager  = new ClientManager($db);
	$tmanager = new TacheManager($db);
	$RService = new RenderService();

	//creation d'un nouvel utilisateur
	function creeNewClient($manager)
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


	function connectUser($RService,$manager,$nom,$tmanager)
	{
		if ($manager->exists($nom)) // Si celui-ci existe.
		{
		    $perso = $manager->get($nom);
		    $_SESSION['perso']=$perso;
		    //userRender($RService,$manager,$perso);
		    //Taches($RService,$perso,$tmanager);
		    $RService->renderAcc();
		}
		else
		{
		    echo('Ce Client n\'existe pas !'); // S'il n'existe pas, on affichera ce message.
		}	
	}

	function userRender($RService)
	{
		$RService->renderAcc();
	}

	function editRender($RService)
	{
		//echo ('<div id="persos">');
  		//affiche info de l'utilisateur courant
  		//$RService->renderModif($perso); 
  		//$RService->renderListU($manager->getList($perso->pseudo())); 
  		//echo ('</div>');
  		$RService->renderModif();
	}

	function editSending($perso,$manager)
	{
		$perso->hydrate(['pseudo' => $_POST['nom'],'pass' => $_POST['pass'],'mail' =>$_POST['mail'],'tel1' => $_POST['tel1'],'tel2' => $_POST['tel2']]);
    	$manager->update($perso);
    	$_SESSION['perso']=$perso;
    	header('Location: acc.php');
	}

	function Taches($RService,$perso,$tmanager)
	{
		$taches=$tmanager->getAll($perso->id());
		$RService->renderTaches($taches);
	}

	function tacheForm($RService){
		$RService->renderCreeTache();
	}






	//tout les utilisateurs + utilisateur courant
	function makeResponseUsers($perso, $manager)
	{
		//info perso courant
		$p =[
				"nomPerso" =>$perso->pseudo(),
				"mailPerso"=>$perso->mail(),
				"telPerso" =>$perso->tel1(),
				"tel2Perso"=>$perso->tel2()
			];

		//les perso existants
		$all = $manager->getList($perso->pseudo());
		$p2=[];

		if (empty($all))
		{
			$p2=['personne'];
		}
		else
		{
		  foreach ($all as $unPerso)
		  {
		  	$p2[] = $unPerso->pseudo();
		  }
		}
		echo json_encode(array($p,$p2));

	}

	function makeResponseEdit($perso)
	{
		$p =[
				"nomPerso" =>$perso->pseudo(),
				"mailPerso"=>$perso->mail(),
				"telPerso" =>$perso->tel1(),
				"tel2Perso"=>$perso->tel2()
			];
		echo json_encode($p);
	}


	function makeResponseMinTaches($perso,$tmanager)
	{
		$p =$tmanager->getAll($perso->id());
		$p2=[];

		foreach ($p as $tch)
		  {
		  	$x = array(
		  		"id" 	=>$tch->id(),
		  		"dateE" =>$tch->dateE(),
		  		"titre"	=>$tch->titre()
		  		);
		  	$p2[] = $x;
		  }
		echo json_encode($p2);
	}


	function makeResponseBigTaches($perso,$tmanager,$tid)
	{
		$tch=$tmanager->get($tid,$perso->id());
	  	$x = array(
	  		"id" 			=>$tch->id(),
	  		"dateE" 		=>$tch->dateE(),
	  		"dateEntree" 	=>$tch->dateEntree(),
	  		"titre"			=>$tch->titre(),
	  		"texte" 		=>$tch->texte()
	  	);

		echo json_encode($x);
	}


	function setEditTask()
	{
		$_SESSION['tId']=$_POST['id'];;
		
	}


	function makeResponseEditTaches($perso,$tmanager)
	{
		$tch=$tmanager->get($_SESSION['tId'],$perso->id());
		$d=date('d/m/Y', strtotime($tch->dateE()));
	  	$x = array(
	  		"id" 			=>$tch->id(),
	  		"dateE" 		=>$d,
	  		"dateEntree" 	=>$tch->dateEntree(),
	  		"titre"			=>$tch->titre(),
	  		"texte" 		=>$tch->texte()
	  	);
		echo json_encode($x);
	}

	//requier POST:
	//id,DateE,titre,texte
	function editSendTask($tmanager,$idc)
	{
		$dt = DateTime::createFromFormat('d/m/Y', $_POST['date']);
		$d = $dt->format('Y-m-d');


		$tache= new Tache();
		$tache->hydrate(['id' => $_POST['id'],'dateE' => $d,'titre' => $_POST['titre'],'texte' =>$_POST['texte'] ]);
    	$tmanager->update($tache,$idc);
    	header('Location: acc.php');
    }




	//requier POST:
	//id,DateE,titre,texte
	function creeSendTask($tmanager,$idc)
	{
		$dt = DateTime::createFromFormat('d/m/Y', $_POST['date']);
		$d = $dt->format('Y-m-d');
		
		$tache= new Tache();
		$tache->hydrate(['clientId' => $idc,'dateE' => $d,'titre' => $_POST['titre'],'texte' =>$_POST['texte'] ]);
    	$tmanager->add($tache);
    	header('Location: acc.php');
	}


	//requier POST:
	//id,DateE,titre,texte
	function delTask($tmanager,$idc)
	{
		$tmanager->delete(intval ($_POST['id']),$idc);
    	echo 'supression effectuer';
	}


	function reverseDate($d){

	}

?>