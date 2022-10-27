<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> acteurs</p>

    <section class="acteur-cards">
        <?php
        foreach($requete->fetchAll() as $acteur) { ?>
            <div class="acteur-card">
                <a href="index.php?action=detailActeur&id=<?php echo $acteur['id_acteur']; ?>">
                    <figure>
                        <img class="mini-img-acteur"src="<?php echo $acteur['photo']?>" alt="">
                        <figcaption>
                            <?= $acteur["prenom"] ?>
                            <?= $acteur["nom"] ?> 
                        </figcaption>
                    </figure>
                </a>
            </div>
        <?php } ?>
    </section>

<?php

$titre = "Listes des acteurs";
$titre_secondaire = "Listes des acteurs";
$contenu = ob_get_clean();
require "view/template.php";

?>