<?php
require_once('_tools.php');

if (isset($_GET['event_id']) AND ctype_digit($_GET['event_id'])) {
    $query = $db->prepare('SELECT *
    FROM events
    INNER JOIN events_medias 
    ON events.id = events_medias.event_id
    INNER JOIN medias
    ON events_medias.media_id = medias.id
    WHERE events.id = ?');
    $query->execute(array($_GET['event_id']));
    $eventSimple = $query->fetch();


    //si aucun article n'a été trouvé je redirige
    if ($eventSimple == false) {
        header('location:index.php');
        exit;
    }
} else { //sinon je redirige
    header('location:index.php');
    exit;
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $eventSimple['title'] ?></title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<?php require_once 'partials/header.php'; ?>

<body>
<div class="titleofEvent">
    <h1><?php echo $eventSimple['title']; ?></h1>
</div>
<section class="all">
    <div class="globalPicture">
        <img class="picture" alt="" src="img/<?php echo $eventSimple['img']; ?>">
        <div class="textofEvent">
            <?php echo $eventSimple['summary']; ?>
            <?php echo $eventSimple['content']; ?><br><br>
            Adresse: <?php echo $eventSimple['address']; ?><br><br>
            Date: <?php echo $eventSimple['event_date']; ?><br><br>
            Heure: <?php echo $eventSimple['event_time']; ?>
        </div>
    </div>
    <div class="map">
        <iframe class="secondMap" src="<?php echo $eventSimple['coordonates'] ?>" frameborder="0" style="border:0"
                allowfullscreen></iframe>
    </div>
</section>
<div class="globalReturn">
    <a href="event_list.php" class="return">Retour aux evenements</a>
</div>
<?php require_once 'partials/footer.php'; ?>

</body>
</html>