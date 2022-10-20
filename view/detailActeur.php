<?php ob_start(); ?>

        <?php

        $acteur = $acteurrequete->fetch();
        $castings = $castingrequete->fetchAll();
        ?>
        <img class="affiche"src=" <?php echo $acteur['photo']; ?> " alt="">
        <h2> 
                <?php echo "Réalisateur : ".$film['realisateur'];?>
        </h2> 
        <h2>
                Casting 
        </h2>
        <p>
                <?php 
                        foreach($castings AS $casting){
                                echo $casting['acteur']." dans le rôle de ".$casting['nom_role']." <br>";
                        }
                ?>
                </p>
        
                




<?php

$titre = "Détail de l'acteur ".$acteur['acteur']." ";
$titre_secondaire = $acteur['acteur']." ";
$contenu = ob_get_clean();
require "view/template.php";

?>