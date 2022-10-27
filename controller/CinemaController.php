<?php
namespace Controller;
use Model\Connect;

class CinemaController {

    // LISTINGS //
    public function listFilms(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_film, titre, DATE_FORMAT(date_sortie, '%d/%m/%Y') AS date_sortie_format,  TIME_FORMAT(SEC_TO_TIME(duree * 60), '%Hh%i') AS duree_format, affiche
            FROM film f
            ORDER BY date_sortie DESC
        ");

        require "view/listFilms.php";
    }

    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_acteur, nom, prenom, photo
            FROM acteur
            ORDER BY nom
        ");
        
        require "view/listActeurs.php";
    }

    public function listRealisateurs(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_realisateur, nom, prenom, photo
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
            SELECT titre, CONCAT(r.prenom,' ',r.nom) AS realisateur, DATE_FORMAT(date_sortie, '%d/%m/%Y') AS date_sortie_format, note, TIME_FORMAT(SEC_TO_TIME(duree * 60), '%Hh%i') AS duree_format, affiche, synopsis, note
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
    // PAGE ADMIN
    public function Admin(){
        $pdo = Connect::seConnecter();
        $realisateurs = $pdo->prepare("
            SELECT CONCAT(nom, ' ', prenom) as realisateur, id_realisateur
            FROM realisateur r 
        ");
        $realisateurs->execute();
        $genres = $pdo->prepare("
            SELECT nom_genre, id_genre
            FROM genre g
        ");
        $genres->execute();
        $films = $pdo->prepare("
            SELECT titre, id_film
            FROM film f
        ");

        require "view/Admin.php";
    }
    // AJOUTER DES VALEURS EN BDD
    public function ajouterRole(){
        if(isset($_POST["submit"])){
            $nom_role = filter_input(INPUT_POST, "nom_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $desc_role = filter_input(INPUT_POST, "desc_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if($nom_role && $desc_role){
                $pdo = Connect::seConnecter();
                $insertRole = $pdo->prepare("INSERT INTO role(nom_role, desc_role) VALUES (:nom_role, :desc_role)");
                $insertRole->execute([
                    "nom_role" => $nom_role,
                    "desc_role" => $desc_role
                ]);

            }
            header('Location:index.php?action=listRoles');
        };    
    }
    public function ajouterGenre(){
        if(isset($_POST["submit"])){
            $nom_genre = filter_input(INPUT_POST, "nom_genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $desc_genre = filter_input(INPUT_POST, "desc_genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if($nom_genre && $desc_genre){
                $pdo = Connect::seConnecter();
                $insertGenre = $pdo->prepare("INSERT INTO genre(nom_genre, desc_genre) VALUES (:nom_genre, :desc_genre)");
                $insertGenre->execute([
                    "nom_genre" => $nom_genre,
                    "desc_genre" => $desc_genre
                ]);

            }
            header('Location:index.php?action=listGenres');
        }; 
    }
    public function ajouterActeur(){
        if(isset($_POST["submit"])){
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $photo = filter_input(INPUT_POST, "photo", FILTER_SANITIZE_URL);
            
            if($nom && $prenom && $sexe && $date_naissance && $photo ){
                $pdo = Connect::seConnecter();
                $insertActeur = $pdo->prepare("INSERT INTO acteur(nom, prenom, sexe, date_naissance, photo) VALUES (:nom, :prenom, :sexe, :date_naissance, :photo)");
                $insertActeur->execute([
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "sexe" => $sexe,
                    "date_naissance" => $date_naissance,
                    "photo" => $photo
                ]);

            }
            header('Location:index.php?action=listActeurs');
        }; 
    }
    public function ajouterRealisateur(){
        if(isset($_POST["submit"])){
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $photo = filter_input(INPUT_POST, "photo", FILTER_SANITIZE_URL);
            
            if($nom && $prenom && $sexe && $date_naissance && $photo ){
                $pdo = Connect::seConnecter();
                $insertActeur = $pdo->prepare("
                    INSERT INTO realisateur(nom, prenom, date_naissance, sexe, photo) 
                    VALUES (:nom, :prenom, :date_naissance, :sexe, :photo)
                ");
                $insertActeur->execute([
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "date_naissance" => $date_naissance,
                    "sexe" => $sexe,
                    "photo" => $photo
                ]);

                header('Location:index.php?action=listRealisateurs');
            }
        }; 
    }
    public function ajouterFilm(){

        if(isset($_POST["submit"])){
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date_sortie = filter_input(INPUT_POST, "date_sortie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);
            $affiche = filter_input(INPUT_POST, "affiche", FILTER_SANITIZE_URL);
            $id_realisateur = filter_input(INPUT_POST, "id_realisateur", FILTER_SANITIZE_NUMBER_INT);
            $genres = filter_input(INPUT_POST, "genres", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            
            if($titre && $date_sortie && $duree && $synopsis && $note && $affiche && $id_realisateur && $genres){
                $pdo = Connect::seConnecter();
                $insertFilm = $pdo->prepare("
                    INSERT INTO film(titre, date_sortie, duree, synopsis, note, affiche, id_realisateur) 
                    VALUES (:titre, :date_sortie, :duree, :synopsis, :note, :affiche, :id_realisateur)
                ");
                $insertFilm->execute([
                    "titre" => $titre,
                    "date_sortie" => $date_sortie,
                    "duree" => $duree,
                    "synopsis" => $synopsis,
                    "note" => $note,
                    "affiche" => $affiche,
                    "id_realisateur" => $id_realisateur
                ]);
                $last_film = $pdo->lastInsertId();
                foreach($genres as $genre){
                    $insertFilmGenres = $pdo->prepare("
                    INSERT INTO contient(id_film, id_genre)
                    VALUES (:last_film, :id_genre)
                    ");
                    $insertFilmGenres->execute([
                        "last_film" => $last_film,
                        "id_genre" => $genre
                        
                    ]);
                }
                
            }
            header('Location:index.php?action=listFilms');

                
            
        }; 
    }
    public function associerFilmGenre(){
        if(isset($_POST['submit'])){
            $id_film = filter_input(INPUT_POST, 'id_film', FILTER_SANITIZE_NUMBER_INT);
            $id_genre = filter_input(INPUT_POST, 'id_genre', FILTER_SANITIZE_NUMBER_INT);
            if($id_film && $id_genre){
                $pdo= Connect::seConnecter();
                $insertAssocierFilmGenre = $pdo->prepare("
                    INSERT INTO contient (id_film, id_genre)
                    VALUES (:id_film, :id_genre)
                ");
                $insertAssocierFilmGenre->execute([
                    "id_film" => $id_film,
                    "id_genre" => $id_genre
                ]);
            }
            header('Location:index.php?action=listGenres');
        }

    }
}

?>