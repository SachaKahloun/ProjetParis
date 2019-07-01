<?php require_once('_tools.php'); ?>


<?php

$query = $db->query('SELECT *
FROM faq_category');

$categories = $query->fetchAll();

$query = $db->query('SELECT *
FROM faq_questions');

$questions = $query->fetchAll();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>FAQ</title>
    <style>
        .active, .otherColl:hover {
            background-color: #ccc;
        }
        .active:after {
            content: "\2796"; /* Unicode character for "minus" sign (-) */
        }

    </style>
</head>
<body>
<?php require_once 'partials/header.php'; ?>

<section class="container">
    <div class="generaleAll">
        <p class="presentation">Foire aux questions de votre ville</p>
    </div>
</section>

<section class="containQuestion">
<?php foreach ($categories as $category): ?>
    <button class="otherColl">
        <?php echo $category['name']; ?>
    </button>
    <div class="contentColl">
        <?php foreach ($questions as $question) : ?>

            <?php if ($question['id_faq_category'] == $category['id'])  : ?>
                <p><?php echo html_entity_decode($question['question']); ?></p>
                <div class="answer"><?php echo html_entity_decode($question['answer']); ?></div>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
</section>


<?php require_once 'partials/footer.php'; ?>
<script src="./assets/js/faq.js"></script>
</body>
</html>