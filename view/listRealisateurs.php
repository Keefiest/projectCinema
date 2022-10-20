<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> réalisateurs</p>

<table>
    <thead>
        <tr>
            <th>NOM</th>
            <th>PRENOM</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $realisateur) { ?>
            <tr>
                <td><?= $realisateur["nom"] ?> </td>
                <td><?= $realisateur["prenom"] ?></td>
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