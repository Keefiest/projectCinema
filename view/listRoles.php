<?php ob_start(); ?>
<p> Il y a <?= $requete->rowCount() ?> rôles</p>

<table>
    <thead>
        <tr>
            <th>ROLE</th>
            <th>INFO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requete->fetchAll() as $role) { ?>
            <tr>
                <td><?= $role["nom_role"] ?> </td>
                <td><a href="index.php?action=detailRole&id=<?php echo $role['id_role'] ?>"><i class="fa-solid fa-circle-info"></i></a></td>
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