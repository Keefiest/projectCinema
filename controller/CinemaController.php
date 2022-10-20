<?php
namespace Controller;
use Model\Connect;

class CinemaController {

    // Lister les films
    public function listFilms(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, date_sortie
            FROM film
        ");

        require "view/listFilms.php";
    }

    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom, prenom
            FROM acteur 
        ");
        
        require "view/listActeurs.php";
    }

    public function listRealisateurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom, prenom
            FROM realisateur 
        ");
        
        require "view/listRealisateurs.php";
    }

    public function listRoles(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom_role
            FROM role 
        ");
        
        require "view/listRoles.php";
    }
    
    public function listGenres(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom_genre
            FROM genre 
        ");
        
        require "view/listGenres.php";
    }

    public function detailFilm($id){
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT * 
            FROM film   
            WHERE id_film = :id
        ");
        $requete->execute(["id" => $id]);

        require "view/detailFilm.php";

    }
}

?>