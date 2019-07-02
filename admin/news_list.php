<?php
require('../_tools.php');

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

if (isset($_GET['new_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {

    $query = $db->prepare('DELETE FROM medias WHERE new_id = ?');
    $result = $query->execute([
        $_GET['new_id']
    ]);

    $query = $db->prepare('DELETE FROM news WHERE id = ?');
    $result = $query->execute([
        $_GET['new_id']
    ]);
    //générer un message à afficher plus bas pour l'administrateur
    if ($result) {
        $message = "Suppression efféctuée.";
    } else {
        $message = "Impossible de supprimer la séléction.";
    }
}

$query = $db->query('SELECT * FROM news');
$news = $query->fetchall();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Administration des actualités - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>


</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>


        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des actualités</h4>
                <a class="btn btn-primary" href="new_form.php">Ajouter une actualité</a>
            </header>


            <?php if (isset($_GET['action'])): ?>
                <div class="bg-success text-white p-2 mb-4">Suppression effectuée avec succès.</div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Publié</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($news as $key => $new) : ?>
                    <tr>
                        <td><?php echo $new['id'] ?></td>
                        <td><?php echo html_entity_decode($new['title']) ?></td>
                        <th><?php echo $new['is_publish'] ?></th>
                        <td>
                            <a onclick="return confirm('Are you sure?')"
                               href="news_list.php?new_id=<?php echo $new['id']; ?>&action=delete"
                               class="btn btn-danger">Supprimer</a>
                            <a href="new_form.php?new_id=<?php echo $new['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>

                        </td>
                    </tr>


                <?php endforeach; ?>

                </tbody>
            </table>

        </section>

    </div>
</div>
</body>
</html>