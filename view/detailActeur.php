<?php ob_start(); ?>

        <?php

        $acteur = $acteurrequete->fetch();
        $films = $filmsrequete->fetchAll();
        
        ?>
        <img class="affiche"src=" <?php echo $acteur['photo']; ?> " alt="">

        <h2>
                <?php echo $acteur['acteur']." joue un rôle dans "?>
        </h2>
        <p>
                <?php 
                        foreach($films AS $film){
                                echo $film['titre']." dans le role : ".$film['nom_role']." <br>";
                        }
                ?>
                </p>
        
                




<?php

$titre = "Détail de l'acteur ".$acteur['acteur']." ";
$titre_secondaire = $acteur['acteur']." (".$acteur['date_naissance_format'].") ";
$contenu = ob_get_clean();
require "view/template.php";

?>