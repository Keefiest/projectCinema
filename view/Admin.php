<?php ob_start(); ?>
<div class="accordion">
    <div class="accordion-element active">
        <h3 class="accordion-header">Ajouter un rôle</h3>
        <div class="accordion-content">
            <form action="index.php?action=ajouterRole" method="POST">
                <p>
                    <label>
                        Nom du rôle</br>
                        <input type="text" name="nom_role">
                    </label> 
                </p>
                <p>
                    <label>
                        Description du rôle</br>
                        <textarea type="textarea" name="desc_role"></textarea>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="submit" name="submit" value="Ajouter">
                    </label>
                </p>
            </form>
        </div>
    </div>
    <div class="accordion-element">
        <h3 class="accordion-header">Ajouter un genre</h3>
        <div class="accordion-content">
            <form action="index.php?action=ajouterGenre" method="POST">
                <p>
                    <label>
                        Nom du genre</br>
                        <input type="text" name="nom_genre">
                    </label> 
                </p>
                <p>
                    <label>
                        Description du genre</br>
                        <textarea type="textarea" name="desc_genre"></textarea>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="submit" name="submit" value="Ajouter">
                    </label>
                </p>
            </form>
        </div>
    </div>
</div>


<?php

$titre = "Panel Admin";
$titre_secondaire = "Panel Admin";
$contenu = ob_get_clean();
require "view/template.php";

?>