<?php ob_start(); ?>
<div class="accordion">
    <div class="accordion-element active">
        <h3 class="accordion-header">Ajouter un rôle</h3>
        <div class="accordion-content">
            <form action="index.php?action=ajouterRole" method="POST">
                <p>
                    <label>
                        Nom du rôle</br>
                        <input type="text" name="nom_role" required="required">
                    </label> 
                </p>
                <p>
                    <label>
                        Description du rôle</br>
                        <textarea type="textarea" name="desc_role" required="required"></textarea>
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
                        <input type="text" name="nom_genre" required="required">
                    </label> 
                </p>
                <p>
                    <label>
                        Description du genre</br>
                        <textarea type="textarea" name="desc_genre" required="required"></textarea>
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
        <h3 class="accordion-header">Ajouter un acteur</h3>
        <div class="accordion-content fl">
            <form action="index.php?action=ajouterActeur" method="POST">
                <p>
                    <label>
                        Nom</br>
                        <input type="text" name="nom" required="required">
                    </label> 
                </p>
                <p>
                    <label>
                        Prenom</br>
                        <input type="text" name="prenom" required="required"></input>
                    </label>
                </p>
              
                <p>
                    <label>
                        Sexe</br>
                        <input type="text" name="sexe" placeholder="Homme ou Femme" required="required"></input>
                    </label>
                </p>
                <p>
                    <label>
                        Date de naissance</br>
                        <input type="date" name="date_naissance" required="required"></input>
                    </label>
                </p>
                <p>
                    <label>
                        Photo</br>
                        <textarea type="textarea" name="photo" placeholder="Sous forme de lien" required="required"></textarea>
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
        <h3 class="accordion-header">Ajouter un realisateur</h3>
        <div class="accordion-content fl">
            <form action="index.php?action=ajouterRealisateur" method="POST">
                <p>
                    <label>
                        Nom</br>
                        <input type="text" name="nom" required="required">
                    </label> 
                </p>
                <p>
                    <label>
                        Prenom</br>
                        <input type="text" name="prenom" required="required"></input>
                    </label>
                </p>
                <p>
                    <label>
                        Date de naissance</br>
                        <input type="date" name="date_naissance" required="required"></input>
                    </label>
                </p>
                <p>
                    <label>
                        Sexe</br>
                        <input type="text" name="sexe" placeholder="Homme ou Femme" required="required"></input>
                    </label>
                </p>
                
                <p>
                    <label>
                        Photo</br>
                        <textarea type="textarea" name="photo" placeholder="Sous forme de lien" required="required"></textarea>
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
        <h3 class="accordion-header">Ajouter un film</h3>
        <div class="accordion-content fl">
            <form action="index.php?action=ajouterFilm" method="POST">
                <p>
                    <label>
                        Titre</br>
                        <input type="text" name="titre" required="required">
                    </label> 
                </p>
                <p>
                    <label>
                        Date de sortie</br>
                        <input type="date" name="date_sortie" required="required"></input>
                    </label>
                </p>
                <p>
                    <label>
                        Durée</br>
                        <input type="number" name="duree" placeholder="En minutes" required="required"></input>
                    </label>
                </p>
                <p>
                    <label>
                        Synopsis</br>
                        <textarea type="text" name="synopsis" required="required"></textarea>
                    </label>
                </p>
                
                <p>
                    <label>
                        Note</br>
                        <input type="number" min="0" max="5" name="note" placeholder="?/5" required="required"></textarea>
                    </label>
                </p>
                <p>
                    <label>
                        Réalisateur</br>
                        <select name="id_realisateur">
                            <?php
                            echo "<option value='default'>Par défaut</option>";
                            foreach($realisateurs AS $realisateur){
                                echo "<option value=".$realisateur['id_realisateur'].">".$realisateur['realisateur']."</option>";
                            }
                            ?>
                        </select>
                    </label>
                </p>
                <p>
                    <label>
                        Genre</br>
                       
                        <select name="genres[]" multiple>
                            <?php
                            foreach($genres AS $genre){
                                echo "<option value=".$genre['id_genre'].">".$genre['nom_genre']."</option>";
                            }
                            ?>
                        </select>
                    </label>
                </p>
                <p>
                    <label>
                        Affiche</br>
                        <textarea type="text" name="affiche" placeholder="Sous forme de lien"></textarea>
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