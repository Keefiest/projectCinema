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

if(isset($_GET["action"])){
    switch ($_GET["action"]){
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
        case "listRoles" : $ctrlCinema->listRoles(); break;
        case "listGenres" : $ctrlCinema->listGenres(); break;
        case "listFilms" : $ctrlCinema->listRoles(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;
    }
}


?>