<?php
// On enregistre notre autoload.
function chargerClasse($classname)
{
  require 'php/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

session_start(); // On appelle session_start() APRÈS avoir enregistré l'autoload.
include 'php/utilService.php';
?>


<?php
//si on veut se deco, pas la peine de continuer
if (isset($_GET['deconnexion']))
{
  session_destroy();
  header('Location: acc.php');
  exit();
}

// Si la session perso existe, on restaure l'objet.
if (isset($_SESSION['perso'])) 
{
  $perso = $_SESSION['perso'];
}


//creation\utilisation d'un utilisateur
if (isset($_POST['creer']) && isset($_POST['nom'])) // Si on a voulu créer un Client.
{
  creeNewClient($manager);
}
elseif (isset($_POST['utiliser']) && isset($_POST['nom'])) // Si on a voulu utiliser un Client.
{//ne pas oublier d'ajouter la verif de password...
  connectUser($RService,$manager,$_POST['nom'],$tmanager);
}



//utilisateur connecté
if (isset($perso) && isset($_POST['editer']))
{
  editRender($RService);
}
elseif(isset($perso) && isset($_POST['editerOK']))
{//mise à jour du perso
  editSending($perso,$manager);
}
elseif (isset($perso) && !(isset($_GET['get_param']))) // Si on utilise un personnage (nouveau ou pas).
{
  userRender($RService,$manager,$perso);
}


//formulaire de connection si l'utilisateur n'est pas connecter
if(!(isset($_SESSION['perso'])))
{
  //formulaire de connection
  $RService->renderForn(); 
}

if(isset($_GET['get_param'])){
  if($_GET['get_param']=='users'){
    makeResponseUsers($perso, $manager);
  }
  elseif($_GET['get_param']=='editPerso'){
    makeResponseEdit($perso);
  }
  elseif($_GET['get_param']=='minTaches'){
    makeResponseMinTaches($perso,$tmanager);
  }
  elseif($_GET['get_param']=='bigTaches'){
    makeResponseBigTaches($perso,$tmanager,$_GET['idTask']);
  }
}
?>
