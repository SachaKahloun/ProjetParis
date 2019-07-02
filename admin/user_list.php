<?php
require('../_tools.php');

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

//supprimer l'utilisateur dont l'ID est envoyé en paramètre URL
if (isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {

    $query = $db->prepare('DELETE FROM users WHERE id = ?');
    $result = $query->execute([
        $_GET['user_id']
    ]);
    //générer un message à afficher plus bas pour l'administrateur
    if ($result) {
        $message = "Suppression efféctuée.";
    } else {
        $message = "Impossible de supprimer la séléction.";
    }
}

//séléctionner tous les utilisateurs pour affichage de la liste
$query = $db->query('SELECT * FROM users');
$users = $query->fetchall();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administration des utilisateurs - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>


</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>


        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des utilisateurs</h4>
                <a class="btn btn-primary" href="user_form.php">Ajouter un utilisateur</a>
            </header>

            <?php if (isset($error)) : ?>
                <div class="bg-success text-white p-2 mb-4"><?php //echo $error ; ?></div>
            <?php endif; ?>


            <?php if (isset($_GET['action'])): ?>
                <div class="bg-success text-white p-2 mb-4">Suppression effectuée avec succès.</div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $key => $user) : ?>
                    <tr>
                        <td><?php echo $user['id'] ?></td>
                        <td><?php echo $user['firstname'] ?></td>
                        <th><?php echo $user['lastname'] ?></th>
                        <th><?php echo $user['email'] ?></th>
                        <th>
                            <?php if ($user['is_admin'] == 0): ?>
                                0
                            <?php else: ?>
                                1
                            <?php endif; ?>
                        </th>
                        <td>
                            <a href="user_form.php?user_id=<?php echo $user['id']; ?>&action=edit"
                               class="btn btn-warning">Modifier</a>
                            <a onclick="return confirm('Are you sure?')"
                               href="user_list.php?user_id=<?php echo $user['id']; ?>&action=delete"
                               class="btn btn-danger">Supprimer</a>
                            <a href="bill_form.php?user_id=<?php echo $user['id']; ?>&action=edit" class="btn btn-info">Ajouter
                                une facture</a>

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