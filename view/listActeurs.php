<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> acteurs</p>

    <section></section>
        <?php
        foreach($requete->fetchAll() as $acteur) { ?>
                <a href="index.php?action=detailActeur&id=<?php echo $acteur['id_acteur']; ?>">
                    <?= $acteur["nom"] ?> 
                    <?= $acteur["prenom"] ?>
                </a>
        <?php } ?>
    

<?php

$titre = "Listes des acteurs";
$titre_secondaire = "Listes des acteurs";
$contenu = ob_get_clean();
require "view/template.php";

?>