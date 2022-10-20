<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> genres</p>

<table>
    <thead>
        <tr>
            <th>GENRE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $genre) { ?>
            <tr>
                <td><?= $genre["nom_genre"] ?> </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Listes des genres";
$titre_secondaire = "Listes des genres";
$contenu = ob_get_clean();
require "view/template.php";

?>