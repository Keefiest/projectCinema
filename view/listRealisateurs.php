<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> réalisateurs</p>

<section class="realisateur-cards">
        <?php
        foreach($requete->fetchAll() as $realisateur) { ?>
            <div class="realisateur-card">
                <a href="index.php?action=detailRealisateur&id=<?php echo $realisateur['id_realisateur']; ?>">
                    <figure>
                        <img class="mini-img-realisateur"src="<?php echo $realisateur['photo']?>" alt="">
                        <figcaption>
                            <?= $realisateur["prenom"] ?>
                            <?= $realisateur["nom"] ?> 
                        </figcaption>
                    </figure>
                </a>
            </div>
        <?php } ?>
    </section>

<?php

$titre = "Listes des realisateurs";
$titre_secondaire = "Listes des realisateurs";
$contenu = ob_get_clean();
require "view/template.php";

?>