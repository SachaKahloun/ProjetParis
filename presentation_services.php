<?php require_once('_tools.php');

$query = $db->query('SELECT *
FROM services
INNER JOIN medias_services
ON services.id = medias_services.service_id
INNER JOIN medias
ON medias_services.media_id = medias.id');

$services = $query->fetchAll();

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
    <title>Présentation & Services</title>
    <style>
        .active, .collapsiblePresentation:hover {
            background-color: white;
        }

        .active:after {
            content: "\2212";
        }
    </style>
</head>
<body>
<?php require_once 'partials/header.php' ?>

<section class="container">
    <div class="generaleAll">
        <p class="presentation">Présentation et services<br>de votre ville</p>
    </div>
</section>
<section class="globalPresentation">
    <section class="presentationCountry">
        <h2 class="h2Presentation">Présentation de la ville</h2>
    </section>
    <section class="secondContainerPresentation">
        <section class="thirdContainerPresentation">
            <div>
                <img class="historyimg" src="./img/mairieparis.jpg">
            </div>
            <div class="historytext">
                <p class="paris">Paris a été fondée au 1er siècle av.J.C. par la tribu celtique des Parisii. À l'origine
                    c'était un petit
                    village
                    de pêcheurs, situé sur la plus grande île de la Seine, l'Île de la Cité, actuellement le cœur de
                    Paris.
                    En 508, Clovis, après avoir chassé les romain de Paris, s'y installe et en fait la capitale du
                    royaume
                    des
                    Francs. Le royaume a rapidemment été divisé, suite à l'invasion Vikking, et Paris est pratiquement
                    laissée à
                    l'abandon sous les règnes de Pépin le Bref et de Charlemagne notamment.</p>

                <button class="collapsiblePresentation"></button>

                <div class="contentPresentation">
                    <p>C'est Hugues Capet qui y
                        rétablit sa
                        résidence sur l'île de la Cité au début de son règne en 987. Auguste,...)</p>
                    <p>L’histoire de Paris remonte autour de l’an 259 avant J-C, lorsque la petite tribu des Parisii
                        fonda
                        la ville sur la rive droite de la Seine. Ce premier peuple de pêcheurs tomba entre les mains des
                        Romains qui fondèrent la ville de Lutèce en l’an 52 avant J-C. <br><br>
                        La ville ne prendra le nom de Paris qu’au IVème siècle. Durant cette époque, la légende raconte
                        que
                        la ville résista à l’invasion d’Attila grâce à l’intervention de Sainte Geneviève (la sainte
                        patronne de la ville).

                        Clovis, roi des Francs, décida de faire de Paris la capitale du pays en l’an 508. Et c’est en
                        l’an
                        987 que s’installa la dynastie capétienne jusqu’en 1328.<br><br>
                        Le 14 juillet 1789, les Parisiens attaquèrent la Bastille, symbole de l’absolutisme monarchique,
                        et
                        ce fut le 3 septembre 1791 que la première Constitution fut promulguée dans l’histoire de
                        France.
                        Celle-ci ne conférait plus qu’au roi le pouvoir exécutif et le droit de véto contre les lois
                        approuvées par l’Assemblée Législative.</p>

                </div>
            </div>
        </section>
    </section>
</section>
<section class="service">
    <h2 class="h2Presentation">Services de la ville</h2>
</section>
<section class="allService">
    <?php foreach ($services as $service): ?>
        <section class="serviceContainer">

            <div class="globalPictureService"><img class="pictureService" alt=""
                                                   src="img/<?php echo $service['img']; ?>"></div>
            <div class="titleService"><?php echo $service['title']; ?></div>
            <div class="placeService"><?php echo $service['address']; ?></div>
            <div class="openService"><?php echo $service['opening_days']; ?></div>
            <div class="hoursService">Horaires :
                <?php echo $service['open_at']; ?>
                <?php echo $service['close_at'] ?>
            </div>
            <div class="telService">Téléphone : <a
                        href="tel:<?php echo $service['phone_number']; ?>"><?php echo $service['phone_number']; ?></a>
            </div>
            <div class="viewService">
                <button id="<?php echo $service['service_id']; ?>" class="mapService">En savoir plus...</button>
            </div>
        </section>

    <?php endforeach; ?>
</section>


<section class="modal">
    <div class="btnClose">
        <i id="closer" class="fas fa-window-close"></i>
    </div>
    <div class="titre"></div>
    <div class="contentMap">
        <div class="globalPictureMap">
            <img src="" alt="" class="pictureMap">
        </div>
        <div class="globalFrame" id="globalFrame">
            <!--<iframe src="" class="secondGlobalFrame" frameborder="0" style="border:0" allowfullscreen></iframe>!-->
        </div>
    </div>
    <section class="contentInformations">
        <div class="informationAddress"></div>
        <div class="informationDays"></div>
        <div class="informationOpening"></div>
        <div class="informationPhone"></div>

    </section>

</section>
<?php require_once 'partials/footer.php'; ?>
<script src="./assets/js/presentation_services.js"></script>
</body>
</html>