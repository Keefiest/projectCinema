<?php ob_start(); ?>

        <?php

        $film = $filmrequete->fetch();
        $castings = $castingrequete->fetchAll();
        ?>
        <img class="affiche"src=" <?php echo $film['affiche']; ?> " alt="">
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

$titre = "Détail du film ".$film['titre']." ";
$titre_secondaire = $film['titre']." ";
$contenu = ob_get_clean();
require "view/template.php";

?>