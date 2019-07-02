<?php
require('../_tools.php');

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

if (isset($_POST['save'])) {
//print_r($_POST);
//die();
    if (!empty($_POST['question']) AND !empty($_POST['answer']) AND !empty($_POST['categories'])) {
        $query = $db->prepare('INSERT INTO faq_questions (id_faq_category, question, answer) VALUES (?, ?, ?)');
        $newQuestion = $query->execute(
            [
                $_POST['categories'],
                htmlspecialchars($_POST['question']),
                htmlspecialchars($_POST['answer']),
            ]
        );
    } else {
        $error = 'Veuillez remplir les champs obligatoires';
    }
}

if (isset($_POST['update'])) {
    if (!empty($_POST['question']) AND !empty($_POST['answer']) AND !empty($_POST['categories'])){

        $query = $db->prepare('UPDATE faq_questions SET
		id_faq_category = :id_faq_category,
		question = :question,
		answer = :answer
		WHERE id = :id'
        );

        $resultUpdate = $query->execute([
            'id_faq_category' => htmlspecialchars($_POST['categories']),
            'question' => htmlspecialchars($_POST['question']),
            'answer' => htmlspecialchars($_POST['answer']),
            'id' => $_POST['id']
        ]);

        $message = 'Question/réponse mis à jour avec succés.';
        header('location:faq_list.php');
        exit();
    } else {
        $message = 'Veuillez rentrer les champs obligatoires.';
    }
}

if (isset($_GET['faq_questions_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

    $query = $db->prepare('SELECT * FROM faq_questions WHERE id = ?');
    $query->execute(array($_GET['faq_questions_id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $faq_question = $query->fetch();

    $query = $db->prepare('SELECT * FROM faq_category WHERE id = ?');
    $query->execute(array($_GET['faq_questions_id']));
    $faqCategories = $query->fetchAll();

}


?>

<!DOCTYPE html>
<html>
<head>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>

    <title>Administration des questions/réponses - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>

</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>


        <section class="col-9">
            <header class="pb-3">
                <!-- Si $user existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                <h4>Ajouter une question/réponse</h4>
            </header>

            <!-- Si $user existe, chaque champ du formulaire sera pré-remplit avec les informations de l'utilisateur -->

            <form action="faq_form.php" method="post">
                <?php if (isset($error)): ?>
                    <div style="color: #CD0018"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="question">Question :</label>
                    <textarea class="form-control" type="text" placeholder="Question" name="question"
                              id="question"><?php if (isset($_GET['faq_questions_id'])) echo $faq_question['question'] ?></textarea>

                    <?php if (isset($_POST['question']) AND (empty($_POST['question']))) : ?>
                        <div style="color: #CD0018"><?php echo "La question est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="answer">Réponse : </label>
                    <textarea class="form-control" type="text" placeholder="Réponse" name="answer"
                              id="answer"><?php if (isset($_GET['faq_questions_id'])) echo $faq_question['answer'] ?></textarea>

                    <?php if (isset($_POST['answer']) AND (empty($_POST['answer']))) : ?>
                        <div style="color: #CD0018"><?php echo "La réponse est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>


                <div class="form-group">
                    <label for="categories"> Catégorie </label>
                    <select class="form-control" name="categories" id="categories">
                        <?php
                        $queryCategory = $db->query('SELECT * FROM faq_category');
                        $categories = $queryCategory->fetchAll();
                        ?>
                        <?php foreach ($categories as $key => $category) : ?>

                            <?php
                            $selected = '';

                            if ($category['id'] == $faq_question['id_faq_category']) {
                                $selected = 'selected="selected"';
                            }
                            ?>
                            <option value="<?= $category['id']; ?>" <?= $selected; ?>> <?= $category['name']; ?> </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="text-right">
                    <?php if (isset($_GET['faq_questions_id'])): ?>
                        <input class="btn btn-success" type="submit" name="update" value="Mettre à jour"/>
                    <?php else: ?>
                        <!-- Si $user existe, on affiche un lien de mise à jour -->
                        <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                    <?php endif; ?>
                </div>


                <input type="hidden" name="id"
                       value="<?php if (isset($_GET['faq_questions_id'])) echo $faq_question['id']; ?>">

            </form>

        </section>
    </div>

</div>

</body>
</html>