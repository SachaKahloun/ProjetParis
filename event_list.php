<?php
require_once('_tools.php');

$query = $db->query('SELECT *
FROM events
INNER JOIN events_medias
ON events.id = events_medias.event_id
INNER JOIN medias
ON events_medias.media_id = medias.id');

$events = $query->fetchAll();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Evenements</title>
    <style>


    </style>
</head>
<body>
<?php require_once 'partials/header.php' ?>
<section class="container">
    <div class="generaleAll">
        <p class="presentation">Venez assister à tous les evènements<br>de votre ville</p>
    </div>
</section>

<section class="titleEvent">
    <h1 class="eventPages">Evénements</h1>
</section>

<section class="picker">
    <input type="date" id="myID">
</section>
<?php foreach ($events as $event): ?>
    <section class="<?php if ($event['id'] % 2 != 0) {
        echo 'primary grey';
    } else {
        echo 'primary';
    }; ?>">
        <h2 class="h2EventList"><?= $event['title']; ?></h2>
        <section class="thirdContainer">
            <div class="globalPictureEventList"><img class="pictureEventList" alt=""
                                                     src="img/<?php echo $event['img']; ?>"></div>
            <div class="summary">
                <?php echo $event['summary']; ?><br><br>
                Date: <?php echo $event['event_date']; ?><br><br>
                Heure: <?php echo $event['event_time']; ?><br><br>
                Lieu: <?php echo $event['address']; ?>
            </div>
        </section>
        <div class="learn">
            <a href="event.php?event_id=<?php echo $event['event_id']; ?>">En savoir plus...</a>
        </div>
    </section>
<?php endforeach; ?>

<?php require_once 'partials/footer.php'; ?>

<script>


    document.querySelector('.picker input').addEventListener('change', function () {
        console.log(document.querySelector('.picker input').value)
    })

</script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr@4.5.7/dist/l10n/fr.js"></script>
<script src="./assets/js/evenements.js"></script>

</body>
</html>