<?php
namespace Controller;
use Model\Connect;

class CinemaController {

    // LISTINGS //
    public function listFilms(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_film, titre, DATE_FORMAT(date_sortie, '%d/%m/%Y') AS date_sortie_format,  TIME_FORMAT(SEC_TO_TIME(duree * 60), '%Hh%i') AS duree_format
            FROM film f
            ORDER BY date_sortie DESC
        ");

        require "view/listFilms.php";
    }

    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_acteur, nom, prenom
            FROM acteur
            ORDER BY nom
        ");
        
        require "view/listActeurs.php";
    }

    public function listRealisateurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_realisateur, nom, prenom
            FROM realisateur 
            ORDER BY nom
        ");
        
        require "view/listRealisateurs.php";
    }

    public function listRoles(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT  id_role, nom_role
            FROM role 
            ORDER BY nom_role
        ");
        
        require "view/listRoles.php";
    }
    
    public function listGenres(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom_genre, id_genre
            FROM genre 
            ORDER BY nom_genre
        ");
        
        require "view/listGenres.php";
    }
    // DETAILS // 
    public function detailFilm($id){
        $pdo = Connect::seConnecter();
        $filmrequete = $pdo->prepare("
            SELECT titre, CONCAT(r.prenom,' ',r.nom) AS realisateur, DATE_FORMAT(date_sortie, '%d/%m/%Y') AS date_sortie_format, note, TIME_FORMAT(SEC_TO_TIME(duree * 60), '%Hh%i') AS duree_format, affiche, synopsis
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
            SELECT id_acteur, CONCAT(prenom, ' ',nom) AS acteur, photo, DATE_FORMAT(date_naissance, '%d/%m/%Y') as date_naissance_format
            FROM acteur a
            WHERE a.id_acteur = :id
        ");
        $acteurrequete->execute(["id" => $id]);
        $filmsrequete = $pdo->prepare("
            SELECT f.titre, r.nom_role
            FROM casting c
            INNER JOIN acteur a ON a.id_acteur = c.id_acteur
            INNER JOIN film f ON f.id_film = c.id_film
            INNER JOIN role r ON r.id_role = c.id_role
            WHERE a.id_acteur = :id
            
        ");
        $filmsrequete->execute(["id" => $id]);

        require "view/detailActeur.php";

    }

    public function detailGenre($id){
        $pdo = Connect::seConnecter();
        $genrerequete = $pdo->prepare("
            SELECT nom_genre, desc_genre
            FROM genre g
            WHERE g.id_genre = :id
        ");
        $genrerequete->execute(["id" => $id]);
        $filmsrequete = $pdo->prepare("
            SELECT g.nom_genre, c.id_genre, f.titre, DATE_FORMAT(date_sortie, '%d/%m/%Y') AS date_sortie_format
            FROM contient c
            INNER JOIN genre g ON g.id_genre = c.id_genre
            INNER JOIN film f ON f.id_film = c.id_film
            WHERE g.id_genre = :id
            
        ");
        $filmsrequete->execute(["id" => $id]);

        require "view/detailGenre.php";

    }
    public function detailRole($id){
        $pdo = Connect::seConnecter();
        $rolerequete = $pdo->prepare("
            SELECT nom_role, desc_role
            FROM role r
            WHERE r.id_role = :id
        ");
        $rolerequete->execute(["id" => $id]);
        $castingsrequete = $pdo->prepare("
            SELECT nom_role, titre, CONCAT(a.prenom, ' ', a.nom) AS acteur
            FROM casting c
            INNER JOIN role r ON r.id_role = c.id_role
            INNER JOIN film f ON f.id_film = c.id_film
            INNER JOIN acteur a ON a.id_acteur = c.id_acteur
            WHERE r.id_role = :id
            
        ");
        $castingsrequete->execute(["id" => $id]);

        require "view/detailRole.php";

    }
}

?>