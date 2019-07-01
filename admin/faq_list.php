<?php
require('../_tools.php');

if (isset($_GET['faq_questions_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {

    $query = $db->prepare('DELETE FROM faq_questions WHERE id = ?');
    $result = $query->execute([
        $_GET['faq_questions_id']
    ]);

    if ($result) {
        $message = "Suppression efféctuée.";
    } else {
        $message = "Impossible de supprimer la séléction.";
    }

}

$query = $db->query('SELECT * FROM faq_questions');
$faqs = $query->fetchall();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Administration des questions/réponses - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>


</head>
<body class="index-body">
<div class="container-fluid">

    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>


        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des questions</h4>
                <a class="btn btn-primary" href="faq_form.php">Ajouter une question/réponse</a>
            </header>


            <?php if (isset($_GET['action'])): ?>
                <div class="bg-success text-white p-2 mb-4">Suppression effectuée avec succès.</div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($faqs as $key => $faq) : ?>
                    <tr>
                        <td><?php echo $faq['id'] ?></td>
                        <td><?php echo html_entity_decode($faq['question']); ?></td>
                        <td>
                            <a href="faq_form.php?faq_questions_id=<?php echo $faq['id']; ?>&action=edit"
                               class="btn btn-warning">Modifier</a>
                            <a onclick="return confirm('Are you sure?')"
                               href="faq_list.php?faq_questions_id=<?php echo $faq['id']; ?>&action=delete"
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