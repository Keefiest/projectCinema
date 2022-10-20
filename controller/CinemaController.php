<?php
namespace Controller;
use Model\Connect;

class CinemaController {

    // Lister les films
    public function listFilms(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_film, titre, date_sortie
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
            SELECT id_realisateur, nom, prenom
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
        $filmrequete = $pdo->prepare("
            SELECT titre, CONCAT(r.prenom,' ',r.nom) AS realisateur, DATE_FORMAT(date_sortie, '%d/%m/%Y') AS date_sortie_format, note, TIME_FORMAT(SEC_TO_TIME(duree * 60), '%Hh%i') AS duree_format, affiche
            FROM film f
            INNER JOIN realisateur r ON r.id_realisateur = f.id_realisateur
            WHERE f.id_film = :id
        ");
        $filmrequete->execute(["id" => $id]);
        $castingrequete = $pdo->prepare("
            SELECT CONCAT(a.prenom, ' ',a.nom) AS acteur, nom_role
            FROM casting c
            INNER JOIN acteur a ON a.id_acteur = c.id_acteur
            INNER JOIN role r ON r.id_role = c.id_role
            WHERE c.id_film = :id
            
        ");
        $castingrequete->execute(["id" => $id]);

        require "view/detailFilm.php";

    }
    public function detailRealisateur($id){
        $pdo = Connect::seConnecter();
        $realrequete = $pdo->prepare("
            SELECT CONCAT(prenom, ' ', nom) AS realisateur, DATE_FORMAT(date_naissance, '%d/%m/%Y'), photo
            FROM realisateur r
            WHERE r.id_realisateur = :id
        ");
        $realrequete->execute(["id" => $id]);
        $filmsrequete = $pdo->prepare("
            SELECT titre, note
            FROM realisateur r
            INNER JOIN film f ON r.id_realisateur = f.id_realisateur
            WHERE r.id_realisateur = :id
            
        ");
        $filmsrequete->execute(["id" => $id]);

        require "view/detailRealisateur.php";

    }
    public function detailActeur($id){
        $pdo = Connect::seConnecter();
        $acteurrequete = $pdo->prepare("
            SELECT CONCAT(prenom, ' ',nom) AS acteur, photo, DATE_FORMAT(date_naissance, '%d/%m/%Y')
            FROM acteur a
            WHERE a.id_acteur = :id
        ");
        $acteurrequete->execute(["id" => $id]);
        $filmsrequete = $pdo->prepare("
            SELECT titre, note
            FROM acteur a
            INNER JOIN film f ON r.id_realisateur = f.id_realisateur
            WHERE r.id_realisateur = :id
            
        ");
        $filmsrequete->execute(["id" => $id]);

        require "view/detailActeur.php";

    }
}

?>