<?php ob_start(); ?>
<p></p>


        <?php

        $film = $requete->fetch();
        echo $film["titre"];

   
        ?> 
                




<?php

$titre = "Listes des films";
$titre_secondaire = "Listes des films";
$contenu = ob_get_clean();
require "view/template.php";

?>