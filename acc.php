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
elseif (isset($_POST['annuler'])) // Si on a voulu utiliser un Client.
{//ne pas oublier d'ajouter la verif de password...
  header('Location: acc.php');
}



//utilisateur connecté
if (isset($perso)){
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
    elseif($_GET['get_param']=='tache'){
      makeResponseEditTaches($perso,$tmanager);
    }
  }
  elseif(isset($_GET['ed']) && !isset($_POST['editerTacheOK']) && !isset($_POST['annuler']) )
  {
    $RService->renderEditTache();
  }
  else
  {
    if (isset($_POST['editer']))
    {
      editRender($RService);
    }
    elseif(isset($_POST['editerOK']))
    {//mise à jour du perso
      editSending($perso,$manager);
    }
    elseif (isset($_POST['creeTache'])) // Si on utilise un personnage (nouveau ou pas).
    {
      tacheForm($RService);
    }
    elseif (isset($_POST['creeTacheOK'])) // Si on utilise un personnage (nouveau ou pas).
    {
      creeSendTask($tmanager,$perso->id());
    }
    elseif(isset($_POST['editerTache']))
    {
      setEditTask();
    }
    elseif(isset($_POST['editerTacheOK']))
    {//mise à jour du perso
      editSendTask($tmanager,$perso->id());
    }
    elseif(isset($_POST['delTask']))
    {//mise à jour du perso
      delTask($tmanager,$perso->id());
    }
    else// Si on utilise un personnage (nouveau ou pas).
    {
      userRender($RService,$manager,$perso);
    }
  }


}



//formulaire de connection si l'utilisateur n'est pas connecter
if(!(isset($_SESSION['perso'])))
{
  //formulaire de connection
  $RService->renderForn(); 
}


?>
