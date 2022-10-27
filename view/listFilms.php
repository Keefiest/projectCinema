<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> films</p>

    <section class="cards">
        <?php
        foreach($requete->fetchAll() as $film) { ?>
            <div class="card">
                <figure>
                    <a href="index.php?action=detailFilm&id=<?php echo $film['id_film'] ?>">
                        <img class="mini-img" src="<?php echo $film['affiche'];?>" alt="">
                        <figcaption>                        
                            <?= $film["titre"] ?>
                            (<?= $film["date_sortie_format"] ?>) 
                        </figcaption>
                    </a>            
                </figure>
            </div>
        <?php } ?>
    </section>

<?php

$titre = "Listes des films";
$titre_secondaire = "Listes des films";
$contenu = ob_get_clean();
require "view/template.php";

?>