<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> rôles</p>

<table>
    <thead>
        <tr>
            <th>ROLE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $role) { ?>
            <tr>
                <td><?= $role["nom_role"] ?> </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Listes des roles";
$titre_secondaire = "Listes des roles";
$contenu = ob_get_clean();
require "view/template.php";

?>