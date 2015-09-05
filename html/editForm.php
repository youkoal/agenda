<link rel="stylesheet" type="text/css" href="css/perso.css">
<link rel="stylesheet" type="text/css" href="css/editForm.css">
<p><a href="?deconnexion=1"><button>Déconnexion</button></a></p>
<form action="" method="post">

	<label class='lb1'>pseudo : </label><input class='fld' type="text" name="nom" value=<?=  '"'.$perso->pseudo().'"' ?>/>
	<label class='lb1'>pass   : </label><input class='fld' type="text" name="pass" />
	<label class='lb1'>mail   : </label><input class='fld' type="text" name="mail" value=<?= '"'.$perso->mail().'"' ?>/>
	<label class='lb1'>tel1   : </label><input class='fld' type="text" name="tel1" value=<?= '"'.$perso->tel1().'"' ?>/>
	<label class='lb1'>tel2   : </label><input class='fld' type="text" name="tel2" value=<?= '"'.$perso->tel2().'"' ?>/>
	<p>
	<input class='btn' type="submit" value="Modifier utilisateur" name="editerOK" />
	<input class='btn' type="submit" value="ann" name="ok" />
	</p>
</form>