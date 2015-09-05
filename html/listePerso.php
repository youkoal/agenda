<?php
if (empty($persos))
{
  echo 'Personne';
}

else
{
  foreach ($persos as $unPerso)
  {
    echo htmlspecialchars($unPerso->pseudo()).'<br />';
  }
}

?>