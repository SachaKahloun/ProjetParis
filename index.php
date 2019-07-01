<?php require_once('_tools.php');

$query = $db->query('SELECT news.*, medias.img, medias.video
FROM news
INNER JOIN medias
ON news.id = medias.new_id');

$homeNews = $query->fetchAll();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Accueil</title>
</head>
<body>
<?php require_once 'partials/header.php' ?>
<section class="container">
    <div class="generale">
        <section class="haut">
            <div class="image">
                <img src="./assets/img/partials/logo.png" alt="">
            </div>
            <div class="title">
                <h1>Bienvenue à Paris</h1>
            </div>
        </section>
        <h2 class="adj"></h2>
    </div>
</section>
<section class="globalActu">
    <div class="actu">
        <h2>Actualités</h2>
    </div>
    <!-- The dots/circles -->
    <div class="slideshow-container">
        <?php foreach ($homeNews as $key => $homeNew) : ?>
            <div class="mySlides fade">
                <!--  <div class="numbertext"><?php // echo $event['title'] ;?></div>-->
                <img src="img/<?php echo $homeNew['img']; ?>">
                <div class="text">
                    <a href="new.php?new_id=<?php echo $homeNew['id']; ?>"><h3> <?php echo $homeNew['title']; ?></h3>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- Next and previous buttons -->
        <a class="prev">&#10094;</a>
        <a class="next">&#10095;</a>
    </div>

    <div style="text-align:center; margin-bottom: 50px">
        <?php for ($i = 0; $i < sizeof($homeNews); $i++): ?>
            <?php echo '<span class="dot"></span>'; ?>
        <?php endfor; ?>
    </div>
</section>


<?php require_once 'partials/footer.php'; ?>
<script src="./assets/js/js.js"></script>
</body>
</html>