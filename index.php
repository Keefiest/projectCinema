            <nav>
                <ul>
                    <a href="?action=listFilms">Films</a>
                    <a href="?action=listActeurs">Acteurs</a>
                    <a href="?action=listRealisateurs">Réalisateurs</a>
                    <a href="?action=listRoles">Rôles</a>
                    <a href="?action=listGenres">Genres</a>
                </ul>
            </nav>

<?php
use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
        case "listRoles" : $ctrlCinema->listRoles(); break;
        case "listGenres" : $ctrlCinema->listGenres(); break;
        case "listFilms" : $ctrlCinema->listRoles(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;
        case "detailRealisateur" : $ctrlCinema->detailRealisateur($id); break;
        case "detailActeur" : $ctrlCinema->detailActeur($id); break;
        case "detailGenre" : $ctrlCinema->detailGenre($id); break;
        case "detailRole" : $ctrlCinema->detailRole($id); break;
    }
}


?>