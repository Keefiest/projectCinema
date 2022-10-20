<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> acteurs</p>

<table>
    <thead>
        <tr>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>INFO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $acteur) { ?>
            <tr>
                <td><?= $acteur["nom"] ?> </td>
                <td><?= $acteur["prenom"] ?></td>
                <!-- BOUTON QUI REDIRIGE L'ACTEUR SOUHAITé -->
                <td><a href="index.php?action=detailActeur&id=<?php echo $acteur['id_acteur']; ?>"><i class="fa-solid fa-circle-info"></i></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Listes des acteurs";
$titre_secondaire = "Listes des acteurs";
$contenu = ob_get_clean();
require "view/template.php";

?>