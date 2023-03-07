<?php

$title = "Catalogue de cours";

include'partials/header.php';
/* Configuration base de données environnement */
define('DB_HOST', 'localhost');
define('DB_NAME', 'cesi-php-sql');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

/* Utilisation de PDO dans un try and catch afin de se connecter à la bdd */
// PHP se connecte au SQL s'il y arrive sinon il renvoie une erreur
try{
    $dbh = new PDO('mysql:host='.DB_HOST.';port=3306;dbname='.DB_NAME,DB_USER,DB_PASSWORD,[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // On veut un tableau associatif en résultat
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);
}catch(Exception $exception){
    echo '<h1>'.$exception->getMessage().'</h1>';
    echo '<a href="https://www.google.fr/search?='.$exception->getMessage().'" target="_blank">Recherche google</a>';
    die; // On arrête le code PHP
}
$req = "SELECT * FROM cours";
$stmt = $dbh->query($req);
$cours = $stmt->fetchAll();
?>
<div class="container-md mt-5">
    <h1>Liste des cours</h1>
    <section class="d-flex justify-content-around mt-5">
        <?php foreach($cours as $cour): ?>
            <div class="card" style="width: 18rem">
                <img src="assets/img/<?= $cour['image'] ?>" class="card-img-top" alt="<?= $cour['libelle'] ?>"/>
                <div class="card-body">
                    <h5 class="card-title"><?= $cour['libelle'] ?></h5>
                    <p class="card-text"><?= $cour['description'] ?></p>
                    <a href="#" class="btn btn-primary">Voir</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>

<?php include 'partials/footer.php';