<?php require_once('_tools.php');

if (isset($_GET['new_id']) AND ctype_digit($_GET['new_id'])) {

    $query = $db->prepare('SELECT news.*, medias.img, medias.video
    FROM news
    INNER JOIN medias
    ON news.id = medias.new_id    
    WHERE news.id = ?');

    $query->execute(array($_GET['new_id']));
    $newSimple = $query->fetch();

    //si aucun article n'a été trouvé je redirige
    if ($newSimple == false) {
        header('location:index.php');
        exit;
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">

    <title><?php echo $newSimple['title'] ?></title>
</head>

<?php require_once 'partials/header.php' ?>

<body>
<div class="containerNew">
    <div class="titleNew">
        <h1><?php echo html_entity_decode($newSimple['title']); ?></h1>
    </div>
    <img class="pictureNew" alt="" src="img/<?php echo $newSimple['img']; ?>">
    <div class="textNew">
        <?php echo html_entity_decode($newSimple ['summary']); ?><br>
        <?php echo html_entity_decode($newSimple ['content']); ?>
    </div>
    <a href="new_list.php" class="returnNew">Retour aux actualités</a>
</div>
<?php require_once 'partials/footer.php'; ?>

</body>
</html>