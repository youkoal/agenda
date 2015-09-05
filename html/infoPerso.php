<link rel="stylesheet" type="text/css" href="css/perso.css">

<p><a href="?deconnexion=1"><button>Déconnexion</button></a></p>
    
    <fieldset id="info_self">
      <legend>Mes informations</legend>
      <p>
        <label class="lb1">Nom  :&nbsp; </label> <label class="lb2"><?= htmlspecialchars($perso->pseudo()) ?></label><br />
        <label class="lb1">mail  :&nbsp; </label> <label class="lb2"><?= htmlspecialchars($perso->mail()) ?></label><br />
        <label class="lb1">tel   :&nbsp; </label> <label class="lb2"><?= htmlspecialchars($perso->tel1()) ?></label><br />
        <label class="lb1">tel2  :&nbsp; </label> <label class="lb2"><?= htmlspecialchars($perso->tel2()) ?></label><br />
      </p>

    <p><a  href="?editer=1"><button id="modifButt">modifier info</button></a></p>
    </fieldset>
    
