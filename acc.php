<?php
// On enregistre notre autoload.
function chargerClasse($classname)
{
  require 'php/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

session_start(); // On appelle session_start() APRÈS avoir enregistré l'autoload.

?>
<!DOCTYPE html>
<html>
  <head>
    <title>TP : agenda</title>
    
    <meta charset="utf-8" />
  </head>
  <body>

<?php
if (isset($_GET['deconnexion']))
{
  session_destroy();
  header('Location: acc.php');
  exit();
}

$db = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.

$manager = new ClientManager($db);
$RService = new RenderService();

if (isset($_SESSION['perso'])) // Si la session perso existe, on restaure l'objet.
{

  $perso = $_SESSION['perso'];
}


if (isset($_POST['creer']) && isset($_POST['nom'])) // Si on a voulu créer un Client.
{
  $perso = new Client(); // On crée un nouveau Client.
  $perso->hydrate(['pseudo' => $_POST['nom'],'pass' => $_POST['pass']]);
  
  if ($manager->exists($_POST['nom']))
  {
    $message = 'Le nom choisi est invalide.';
    unset($perso);
  }
  elseif ($manager->exists($perso->pseudo()))
  {
    $message = 'Le nom du Client est déjà pris.';
    unset($perso);
  }
  else
  {
    $manager->add($perso);
  }
}

elseif (isset($_POST['utiliser']) && isset($_POST['nom'])) // Si on a voulu utiliser un Client.
{//ne pas oublier d'ajouter la verif de password...
  if ($manager->exists($_POST['nom'])) // Si celui-ci existe.
  {
    $perso = $manager->get($_POST['nom']);
    $_SESSION['perso']=$perso;
  }
  else
  {
    $message = 'Ce Client n\'existe pas !'; // S'il n'existe pas, on affichera ce message.
  }
}




if (isset($perso) && isset($_POST['editer']))
{
   echo ('<div id="persos">');
  //affiche info de l'utilisateur courant
  $RService->renderModif($perso); 

  $persos = $manager->getList($perso->pseudo());

  $RService->renderListU($persos); 
  echo ('</div>');
}
elseif(isset($perso) && isset($_POST['editerOK']))
{//mise à jour du perso
  $perso->hydrate(['pseudo' => $_POST['nom'],'pass' => $_POST['pass'],'mail' =>$_POST['mail'],'tel1' => $_POST['tel1'],'tel2' => $_POST['tel2']]);
  $manager->update($perso);
  $_SESSION['perso']=$perso;

}
elseif (isset($perso)) // Si on utilise un personnage (nouveau ou pas).
{
  echo ('<div id="persos">');
  //affiche info de l'utilisateur courant
  $RService->renderClient($perso); 

  $persos = $manager->getList($perso->pseudo());

  $RService->renderListU($persos); 
  echo ('</div>');

}
else
{
  //formulaire de connection
  $RService->renderForn(); 
}

?>

</body>
</html>