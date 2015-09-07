<fieldset id="taches">
  <legend>taches</legend>

<?php

	if (empty($taches))
	{
	  echo 'aucunes taches';
	}

	else
	{
	  foreach ($taches as $uneTache)
	  {
	  	$id=$uneTache->id();
	  	echo '<div id=task_'.$id.'>';
	  	$ps = htmlspecialchars($uneTache->dateE());
	    echo '<span>'.$ps.'</span><br />';
	    $ps = htmlspecialchars($uneTache->titre());
	    echo '<span>'.$ps.'</span></div>';
	  }
	}

?>

</fieldset>