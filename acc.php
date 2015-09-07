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
//si on veut se deco, pas la peine de continuer
if (isset($_GET['deconnexion']))
{
  session_destroy();
  header('Location: acc.php');
  exit();
}

$db = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.

$manager  = new ClientManager($db);
$tmanager = new TacheManager($db);
$RService = new RenderService();
$UService = new utilService($db);


// Si la session perso existe, on restaure l'objet.
if (isset($_SESSION['perso'])) 
{
  $perso = $_SESSION['perso'];
}


//creation\utilisation d'un utilisateur
if (isset($_POST['creer']) && isset($_POST['nom'])) // Si on a voulu créer un Client.
{
  $UService->creeNewClient($manager);
}
elseif (isset($_POST['utiliser']) && isset($_POST['nom'])) // Si on a voulu utiliser un Client.
{//ne pas oublier d'ajouter la verif de password...
  $UService->connectUser($RService,$manager,$_POST['nom'],$tmanager);
}



//utilisateur connecté
if (isset($perso) && isset($_POST['editer']))
{
  $UService->editRender($RService,$manager,$perso);
}
elseif(isset($perso) && isset($_POST['editerOK']))
{//mise à jour du perso
  $UService->editSending($perso,$manager);
}
elseif (isset($perso) && !(isset($_POST['utiliser']))) // Si on utilise un personnage (nouveau ou pas).
{
  $UService->userRender($RService,$manager,$perso);
}


//formulaire de connection si l'utilisateur n'est pas connecter
if(!(isset($_SESSION['perso'])))
{
  //formulaire de connection
  $RService->renderForn(); 
}
?>

</body>
</html>