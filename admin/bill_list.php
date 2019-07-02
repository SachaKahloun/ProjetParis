<?php
require('../_tools.php');

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}
//supprimer l'utilisateur dont l'ID est envoyé en paramètre URL
if (isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {

    $query = $db->prepare('DELETE FROM bills WHERE id = ?');
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
$query = $db->query('SELECT * FROM bills');
$bills = $query->fetchall();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Administration des factures - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>


</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>


        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des factures</h4>
            </header>

            <?php if (isset($error)) : ?>
                <div class="bg-success text-white p-2 mb-4"><?php //echo $error ; ?></div>
            <?php endif; ?>

            <!--            --><?php //if (isset($_SESSION['user']['message'])) : ?>
            <!--                <div class="bg-success text-white p-2 mb-4">-->
            <?php //echo $_SESSION['user']['message'] ; ?><!--/div>-->
            <!--            --><?php //endif; ?>

            <?php if (isset($_GET['action'])): ?>
                <div class="bg-success text-white p-2 mb-4">Suppression effectuée avec succès.</div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Bill From</th>
                    <th>Date of bill</th>
                    <th>Amount</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($bills as $key => $bill) : ?>
                    <tr>
                        <td><?php echo $bill['id'] ?></td>
                        <td><?php echo $bill['bill_from'] ?></td>
                        <th><?php echo $bill['bill_date'] ?></th>
                        <th><?php echo $bill['amount_due'] . '' . '€' ?></th>
                        <th><?php echo $bill['is_payed'] ?></th>

                        <td>
                            <a onclick="return confirm('Are you sure?')"
                               href="bill_list.php?user_id=<?php echo $bill['id']; ?>&action=delete"
                               class="btn btn-danger">Supprimer</a>
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