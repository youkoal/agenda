<fieldset id="info_other">
  <legend>Qui est enregistré ?</legend>
  <p>

<?php

	if (empty($persos))
	{
	  echo 'Personne';
	}

	else
	{
	  foreach ($persos as $unPerso)
	  {
	  	$ps = htmlspecialchars($unPerso->pseudo());
	    echo '<span title='.$ps.'>'.$ps.'</span><br />';
	  }
	}

?>

	</p>
</fieldset>