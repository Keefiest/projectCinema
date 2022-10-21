<?php ob_start(); ?>

        <?php

        $role = $rolerequete->fetch();
        $castings = $castingsrequete->fetchAll();
        ?>
        
        <p> 
                <?php echo $role['desc_role'];?>
        </p> 
        <h2>
                Acteur ayant joué ce rôle :
        </h2>
        <p>
                <?php 
                        foreach($castings AS $casting){
                                echo $casting['acteur']." dans le film ".$casting['titre']." <br>";
                        }
                ?>
                </p>
        
                




<?php

$titre = "Détail du rôle ".$role['nom_role']." ";
$titre_secondaire = "Détail du rôle ".$role['nom_role']." ";
$contenu = ob_get_clean();
require "view/template.php";

?>