<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> réalisateurs</p>

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
        foreach($requete->fetchAll() as $realisateur) { ?>
            <tr>
                <td><?= $realisateur["nom"] ?> </td>
                <td><?= $realisateur["prenom"] ?></td>
                <!-- BOUTON QUI REDIRIGE AU REALISATEUR SOUHAITé -->
                <td><a href="index.php?action=detailRealisateur&id=<?php echo $realisateur['id_realisateur']; ?>"><i class="fa-solid fa-circle-info"></i></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Listes des realisateurs";
$titre_secondaire = "Listes des realisateurs";
$contenu = ob_get_clean();
require "view/template.php";

?>