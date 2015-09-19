<?php
class RenderService
{
	//rendu de la page d'accueil de l'app apres connection
	public function renderAcc()
	{
		include 'html/connected.html';
	}

	//formulaire de connection
	public function renderForn()
	{
	    include 'html/connectForm.html';
	}

	//formulaire d'édition de données personelles
	public function renderModif()
	{
		include 'html/editPerso.html';
	}

	//formulaire d'édition d'une tache
	public function renderEditTache()
	{
		include 'html/tacheEditForm.html';
	}

	//formulaire de création de tâches
	public function renderCreeTache()
	{
		include 'html/tacheForm.html';
	}



}//fin class

?>