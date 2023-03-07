<?php

$title = "Catalogue de cours";

include'partials/header.php';
require'request/catalogue.dao.php';

$cours = getCours();
// Fonction permettant de tronquer le texte
function truncate($text, $ending = '...') {
    if (strlen($text) > 50) {
        return substr($text, 0, 50).$ending;
    }
    return $text;
}
?>
<div class="container-md mt-5">
    <h1>Liste des cours</h1>
    <section class="d-flex justify-content-around mt-5">
        <?php foreach($cours as $cour): ?>
            <div class="card" style="width: 18rem">
                <img src="assets/img/<?= $cour['image'] ?>" class="card-img-top" alt="<?= $cour['libelle'] ?>"/>
                <div class="card-body">
                    <h5 class="card-title"><?= $cour['libelle'] ?></h5>
                    <p class="card-text"><?= truncate($cour['description']) ?></p>
                    <?php
                        $type = getCoursType($cour['idType']);
                    ?>
                    <span class="badge bg-primary"><?= $type['libelle'] ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>

<?php include 'partials/footer.php';