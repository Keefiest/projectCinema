<?php ob_start(); ?>

        <?php

        $genre = $genrerequete->fetch();
        $films = $filmsrequete->fetchAll();
        ?>
        
        <p> 
                <?php echo $genre['desc_genre'];?>
        </p> 
        <h2>
                Films de ce genre :
        </h2>
        <p>
                <?php 
                        foreach($films AS $film){
                                echo $film['titre']." (".$film['date_sortie_format'].") <br>";
                        }
                ?>
                </p>
        
                




<?php

$titre = "Détail du genre ".$genre['nom_genre']." ";
$titre_secondaire = "Détail du genre ".$genre['nom_genre']." ";
$contenu = ob_get_clean();
require "view/template.php";

?>