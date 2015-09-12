<?php
class RenderService
{
	public function renderForn()
	{
	    include 'html/connectForm.html';
	}

	public function renderClient($perso)
	{
		include 'html/infoPerso.php';
	}

	public function renderListU($persos)
	{
		include 'html/listePerso.php';
	}

	public function renderModif()
	{
		include 'html/editPerso.html';
	}

	public function renderTaches($taches)
	{
		include 'html/listTaches.php';
	}

	public function renderEditTache()
	{
		include 'html/tacheEditForm.html';
	}

	public function renderAcc()
	{
		include 'html/connected.html';
	}

	public function renderCreeTache()
	{
		include 'html/tacheForm.html';
	}



}//fin class

?>