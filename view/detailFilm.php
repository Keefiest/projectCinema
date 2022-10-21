<?php ob_start(); ?>

        <?php

        $film = $filmrequete->fetch();
        $castings = $castingrequete->fetchAll();
        ?>
        <div class="film-header">
                <div>
                        <img class="affiche"src=" <?php echo $film['affiche']; ?> " alt="">
                        <h2> 
                                <?php echo "Réalisateur : ".$film['realisateur'];?>
                        </h2>
                 </div>
                 <div>
                        <h3>
                                Synopsis :
                        </h3>
                        <p>
                                <?php
                                        echo $film['synopsis'];
                                ?>
                        </p>
                        <h3>
                              Durée : <?php echo $film['duree_format'];?>  
                        </h3>
                </div>
        </div>
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
$titre_secondaire = $film['titre']." (".$film['date_sortie_format'].")";
$contenu = ob_get_clean();
require "view/template.php";

?>