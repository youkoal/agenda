<?php

	$db = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
	$manager  = new ClientManager($db);
	$tmanager = new TacheManager($db);
	$RService = new RenderService();


	//à bouger
	function userRender($RService)
	{
		$RService->renderAcc();
	}

	//à bouger
	function editRender($RService)
	{
  		$RService->renderModif();
	}

	//à bouger
	function tacheForm($RService){
		$RService->renderCreeTache();
	}

	//si le client veut édité un tache, il nous faut l'id de la tache à éditée.
	//pour pouvoir par la suite chargé les données qui lui correspondent. 
	function setEditTask()
	{
		$_SESSION['tId']=$_POST['id'];;
		
	}

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
		    $RService->renderAcc();
		}
		else
		{
		    echo('Ce Client n\'existe pas !'); // S'il n'existe pas, on affichera ce message.
		}	
	}



	//édition de donnée d'un client. par sécuritée, on verifie aussis que celui qui 
	//édite la donnée édite bien ses propres données.
	function editSending($perso,$manager)
	{
		$perso->hydrate(['pseudo' => $_POST['nom'],'pass' => $_POST['pass'],'mail' =>$_POST['mail'],'tel1' => $_POST['tel1'],'tel2' => $_POST['tel2']]);
    	$manager->update($perso);
    	$_SESSION['perso']=$perso;
    	header('Location: acc.php');
	}

	//reccuperation de toutes les données de l'agenda du client connecté.
	function Taches($RService,$perso,$tmanager)
	{
		$taches=$tmanager->getAll($perso->id());
		$RService->renderTaches($taches);
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

	//lors de l'édition des données d'un perso, on reccuperes les données du client connecté.
	//cela permetra de préremplire les champs
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

	//pour le premier apperçut des taches, il faut charger un minimum de donnée qui les résumes.
	//on reccupère donc le titre et la date de toutes les taches entrées par le client connecté.
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

	//on reccupere le contenus de la tache séléctionnée par le client.
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

	//reccuperation des données de la tache à éditée pour préremplire les champs du formulaire.
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

	//mise à jour de la taches éditée par le client.
	function editSendTask($tmanager,$idc)
	{
		$dt = DateTime::createFromFormat('d/m/Y', $_POST['date']);
		$d = $dt->format('Y-m-d');

		$tache= new Tache();
		$tache->hydrate(['id' => $_POST['id'],'dateE' => $d,'titre' => $_POST['titre'],'texte' =>$_POST['texte'] ]);
    	$tmanager->update($tache,$idc);
    	header('Location: acc.php');
    }

	//ajout à la BDD de la tâche créé par le client.
	function creeSendTask($tmanager,$idc)
	{
		$dt = DateTime::createFromFormat('d/m/Y', $_POST['date']);
		$d = $dt->format('Y-m-d');
		
		$tache= new Tache();
		$tache->hydrate(['clientId' => $idc,'dateE' => $d,'titre' => $_POST['titre'],'texte' =>$_POST['texte'] ]);
    	$tmanager->add($tache);
    	header('Location: acc.php');
	}

	//suppression de la tâche sélectionnée par le client
	function delTask($tmanager,$idc)
	{
		$tmanager->delete(intval ($_POST['id']),$idc);
    	echo 'supression effectuer';
	}

?>