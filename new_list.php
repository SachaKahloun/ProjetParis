<?php require_once('_tools.php');

$query = $db->query('SELECT news.*, medias.img, medias.video
FROM news
INNER JOIN medias
ON news.id = medias.new_id');

$news = $query->fetchAll();

?>


<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Actualités</title>
</head>
<body>

<?php require_once 'partials/header.php' ?>

<section class="container">
    <div class="generaleAll">
        <p class="presentation">Toute l'actualité de votre ville<br>se trouve ici</p>
    </div>
</section>
<section class="bigNews">
    <h1>Les grandes actualités</h1>
</section>
<?php foreach ($news as $new): ?>
    <section class="<?php if ($new['id'] % 2 != 0) {
        echo 'primary grey';
    } else {
        echo 'primary';
    }; ?>">
        <h2 class="h2NewList"><?= html_entity_decode($new['title']); ?></h2>
        <section class="secondContainerNewList">
            <div class="globalPictureNewList"><img class="pictureNewList" alt="" src="img/<?php echo $new['img']; ?>">
            </div>
            <div class="summaryNewList"><?php echo html_entity_decode($new['summary']); ?></div>
        </section>
        <div class="learnNewList">
            <a href="new.php?new_id=<?php echo $new['id']; ?>">Lire l'actu...</a>
        </div>
    </section>
<?php endforeach; ?>

<?php require_once 'partials/footer.php'; ?>

</body>
</html>