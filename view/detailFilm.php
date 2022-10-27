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

                        <h3>
                                Note : 
                                <?php 
                                        if ($film['note'] == '1'){
                                                echo '<span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>';
                                        }
                                        elseif($film['note'] == '2'){
                                                echo '<span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>';
                                        }
                                        elseif($film['note'] == '3'){
                                                echo '<span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>';
                                        }
                                        elseif($film['note'] == '4'){
                                                echo '<span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>';
                                        }
                                        elseif($film['note'] == '5'){
                                                echo '<span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>';
                                        }
                                
                                ?>
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