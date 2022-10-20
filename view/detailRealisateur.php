<?php ob_start(); ?>

        <?php

        $real = $realrequete->fetch();
        $films = $filmsrequete->fetchAll();
        ?>
        <img class="affiche"src=" <?php echo $real['photo']; ?> " alt="">
        <p> 
                <?php echo "Réalisateur : ".$real['realisateur'];?>
        </p> 
        <h2>
                Films 
        </h2>
        <p>
                <?php 
                        foreach($films AS $film){
                                echo $film['titre']." : ".$film['note']."/5 <br>";
                        }
                ?>
                </p>
        
                




<?php

$titre = "Détail du film ".$film['titre']." ";
$titre_secondaire = $real['realisateur']." ";
$contenu = ob_get_clean();
require "view/template.php";

?>