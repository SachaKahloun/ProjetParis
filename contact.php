<?php
require_once('_tools.php');
require_once ('mail.php');


if (isset($_POST['firstSignal'])){
    if (empty($_POST['email']) OR empty($_POST['address']) OR empty($_POST['firstList']) OR empty($_POST['message']) OR empty($_POST['secondList']) OR $_POST['firstList']=='Objet' OR $_POST['secondList']=='Raison'){
        $messageError = 'Veuillez remplir les champs obligatoires.';
    }
    else{
        $messageValidate = 'Votre demande a bien été transmise. Un mail de confirmation vous a été envoyé.';
        mailTo($_POST['email']);
    }
}


if (isset($_POST['secondSignal'])){
    if (empty($_POST['firstName']) OR empty($_POST['lastName']) OR empty($_POST['phone']) OR empty($_POST['message'])){
        $messageError = 'Veuillez remplir les champs obligatoires.';
    }
    else{
        $messageValidate = 'Votre demande a bien été transmise.';
    }
}

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php require_once 'partials/header.php' ?>

<section class="container">
    <div class="generaleAll">
        <p class="presentation">Contactez-nous</p>
    </div>
</section>


<section class="ongletContact">
    <ul class="tabs">
        <li class="active"><a href="#home">Déclaration</a></li>
        <li><a href="#mentions">Nous écrire</a></li>
    </ul>

    <div class="tab-content active" id="home">
        <form action="" class="problemSignal" method="post">
            <input id="" type="text" name="address" value="<?php if (isset($_SESSION['user'])): ?><?php echo $_SESSION['user']['address'];?> <?php endif; ?>" placeholder="Adresse" class="namadress"/><br>
            <input id="" type="email" name="email" value="<?php if (isset($_SESSION['user'])): ?><?php echo $_SESSION['user']['email'];?> <?php endif; ?>" placeholder="votre email"/><br>
            <select name="firstList" onchange="arrReason.getSelect('secondList', this.value);">
                <option>Objet</option>
                <option value="voirie">Voirie</option>
                <option value="signalisation">Signalisation</option>
                <option value="espacesVerts">Espaces verts</option>
                <option value="proprete">Propreté</option>
                <option value="autre">Autre</option>
            </select><br>
            <span id="secondList"></span>
            <textarea id="" placeholder="Message" name="message"></textarea><br>
            <button class="send" name="firstSignal">Envoyer</button>
            <div style="color: #CD0018; margin-top: 10px">
                <?php if (isset($messageError)): ?>
                    <?php echo $messageError ;?>
                <?php endif; ?>
            </div>
            <div style="color: white; margin-top: 10px">
                <?php if (isset($messageValidate)): ?>
                    <?php echo $messageValidate ;?>
                <?php endif; ?>
            </div>
        </form>
    </div>


    <div class="tab-content" id="mentions">
        <form action="" class="contact" method="post">
            <input id="first_name" type="text" name="firstName" value="<?php if (isset($_SESSION['user'])): ?><?php echo $_SESSION['user']['firstname'];?> <?php endif; ?>" placeholder="Votre nom" class="namadress"/><br>
            <input id="last_name" type="text" name="lastName" value="<?php if (isset($_SESSION['user'])): ?><?php echo $_SESSION['user']['lastname'];?> <?php endif; ?>" placeholder="Votre prénom"/><br>
            <input type="number" id="phone_number" name="phone" value="<?php if (isset($_SESSION['user'])): ?><?php echo $_SESSION['user']['phone_number'];?> <?php endif; ?>" placeholder="Votre numèro de téléphone" required><br>
            <input id="email" type="email" name="email" value="<?php if (isset($_SESSION['user'])): ?><?php echo $_SESSION['user']['email'];?> <?php endif; ?>" placeholder="Votre email"/><br>
            <textarea id="description" placeholder="Message" name="message"></textarea><br><br>
            <button class="send" name="secondSignal">Envoyer</button>
            <div style="color: #CD0018; margin-top: 10px">
                <?php if (isset($messageError)): ?>
                    <?php echo $messageError ;?>
                <?php endif; ?>
            </div>
            <div style="color: white; margin-top: 10px">
                <?php if (isset($messageValidate)): ?>
                    <?php echo $messageValidate ;?>
                <?php endif; ?>
            </div>
        </form>

    </div>
</section>

<?php require_once 'partials/footer.php' ?>

<script src="./assets/js/contact.js"></script>
</body>
</html>