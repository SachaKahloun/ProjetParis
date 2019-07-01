<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        footer {
            padding: 20px;
            background-color: #929497;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            overflow-x: hidden;


        }

        .logoUe {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .secondLogoUe {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            width: 150px;
            text-align: center;
        }

        .secondLogoUe img {
            width: 150px;
        }

        .mairie {
            font-size: 25px;
            margin-top: 0;
        }

        .mairie:after {
            content: '';
            width: 35px;
            height: 3px;
            display: block;
            background-color: black;
            margin-top: 10px;
        }
        iframe{
            width: 500px;
            height: 250px;
            border: 0;
        }

        .adresse a {
            color: black;
        }

        .adresse a:hover {
            text-decoration: underline;
        }

        .nousSuivre {
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .nousSuivre p {
            font-size: 25px;
            margin-top: 0;
        }

        .nousSuivre i {
            padding: 10px 0 10px 0;
            font-size: 30px;
        }

        .nousSuivre a {
            color: black;
        }

        .facebook:hover {
            color: rgb(59, 89, 152);
        }

        .instagram:hover {
            color: rgb(188, 42, 141);
        }

        .twitter:hover {
            color: rgb(29, 202, 255);
        }

        .linkedin:hover {
            color: rgb(0, 160, 220);
        }

        .secondFooter {
            display: none;
        }
        @media (max-width: 768px) {
            .firstFooter{
                display: none;
            }
            .secondFooter{
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
            }
            .third{
                width: 100%;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                padding: 5px;
            }
            .logoUe{
                display: flex;
                flex-direction: row;
                justify-content: space-around;
            }
            .nousSuivre {
                width: 50%;
                display: flex;
                flex-direction: column;
                text-align: center;
            }
            .social{
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
            }
            .secondAdresse a {
                color: black;
            }

            .secondAdresse a:hover {
                text-decoration: underline;
            }
            iframe{
                width: 100%;
                border: 0;
            }
            .nousSuivre {
                padding: 10px 0;
            }
            .nousSuivre i{
                padding: 15px;
            }
        }

        @media (min-width: 320px) and (max-width: 750px) {
            .firstFooter{
                display: none;
            }
            .secondFooter{
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
            }
            .third{
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                align-items: center;
                padding: 15px;
            }
            .nousSuivre {
                width: 100%;
            }
            .nousSuivre p{
                margin: 0;
            }
            .secondAdresse{
                padding: 20px 0 10px 0;
            }
            .logoUe{
                padding: 0 0 10px 0;
            }
        }

    </style>
    <title>Document</title>
</head>
<body>
<footer class="firstFooter">
    <section class="logoUe">
        <div class="secondLogoUe">
            <img src="./assets/img/partials/logo.png">
            <p style="margin-top:0">Ville de Paris</p>
        </div>
        <div class="secondLogoUe">
            <img src="./assets/img/partials/ue.png">
            <p style="margin: 0">L'Europe s'engage à Paris</p>
        </div>
    </section>
    <div class="iframe">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20994.340123533773!2d2.344439019568149!3d48.87169997446701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671fdb38f5b8b%3A0xc0345272f10c1f6e!2sH%C3%B4tel+de+Ville!5e0!3m2!1sfr!2sfr!4v1557156601115!5m2!1sfr!2sfr"
                frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <section class="adresse">
        <p class="mairie">Mairie de Paris</p>
        <p>40 rue du Louvre<br>75001 Paris</p>
        <p>Ouvert du Lundi au samedi <br> <i class="far fa-clock"></i> 9h-12h / 14h-17h</p>
        <p><a href="./mentions_legales.php">Mentions légales</a></p>
        <p><a href="./faq.php">FAQ</a></p>
    </section>
    <section class="nousSuivre">
        <p>Nous suivre</p>
        <a href="#"><i class="fab fa-facebook facebook"></i></a>
        <a href="#"><i class="fab fa-instagram instagram"></i></a>
        <a href="#"><i class="fab fa-twitter-square twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin linkedin"></i></a>
    </section>
</footer>

<footer class="secondFooter">
    <section class="third">
        <section class="secondAdresse">
            <p class="mairie">Mairie de Paris</p>
            <p>40 rue du Louvre<br>75001 Paris</p>
            <p>Ouvert du Lundi au samedi <br> <i class="far fa-clock"></i> 9h-12h / 14h-17h</p>
            <p><a href="./mentions_legales.php">Mentions légales</a></p>
            <p><a href="./faq.php">FAQ</a></p>
        </section>
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20994.340123533773!2d2.344439019568149!3d48.87169997446701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671fdb38f5b8b%3A0xc0345272f10c1f6e!2sH%C3%B4tel+de+Ville!5e0!3m2!1sfr!2sfr!4v1557156601115!5m2!1sfr!2sfr"
                    width="400" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section>
    <section class="third">
        <section class="logoUe">
            <div class="secondLogoUe">
                <img src="./assets/img/partials/logo.png">
                <p style="margin-top:0">Ville de Paris</p>
            </div>
            <div class="secondLogoUe">
                <img src="./assets/img/partials/ue.png" width="150">
                <p style="margin: 0">L'Europe s'engage à Paris</p>
            </div>
        </section>
        <section class="nousSuivre">
            <p>Nous suivre</p>
            <div class="social">
                <a href="#"><i class="fab fa-facebook facebook"></i></a>
                <a href="#"><i class="fab fa-instagram instagram"></i></a>
                <a href="#"><i class="fab fa-twitter-square twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin linkedin"></i></a>
            </div>
        </section>
    </section>
</footer>


</body>
</html>




