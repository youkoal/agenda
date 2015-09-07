<?php
class RenderService
{
	public function renderForn()
	{
	    include '/html/connectForm.html';
	}

	public function renderClient($perso)
	{
		include '/html/infoPerso.php';
	}

	public function renderListU($persos)
	{
		include '/html/listePerso.php';
	}

	public function renderModif($perso)
	{
		include '/html/editForm.php';
	}

	public function renderTaches($taches)
	{
		include '/html/listTaches.php';
	}



}//fin class

?>