<?php
require_once('_tools.php');

$query = $db->prepare('SELECT *
FROM bills
WHERE user_id = ? ');


$query->execute(array($_SESSION['user']['id']));

$bills = $query->fetchAll();

$query = $db->prepare('SELECT *
FROM bills
WHERE user_id = ? ');


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
    <title>Bienvenue dans votre espace personnel</title>
</head>
<body>
<?php require_once 'partials/header.php' ?>

<section class="container">
    <div class="generaleAll">
        <p class="presentation">Un seul compte pour vous faciliter la vie</p>
    </div>
</section>
<section class="compte">
    <h1>Bienvenue dans votre espace personnel</h1>
</section>
<section class="firstInformation">
    <section class="secondInformation">
        <h2>Mes informations</h2>
        <h4>Nom: <?php echo $_SESSION['user']['lastname']; ?></h4>
        <h4>Prénom: <?php echo $_SESSION['user']['firstname']; ?></h4>
        <h4>Téléphone: <?php echo $_SESSION['user']['phone_number']; ?></h4>
        <h4>
            Adresse: <?php echo $_SESSION ['user']['address'] . ' ' . $_SESSION ['user']['zip_code'] . ' ' . $_SESSION ['user']['city']; ?></h4>
    </section>
</section>

<section class="firstBills">
    <section class="secondBills">
        <h2>Mes factures</h2>
        <?php foreach ($bills as $bill): ?>
            <section class="thirdBills">

                <div class="informationBillAll"><h4><?php echo $bill['bill_from']; ?></h4></div>
                <div class="informationBillAll"><?php echo $bill['bill_date']; ?></div>
                <div class="informationBillAll"><?php echo $bill['amount_due']; ?>€</div>
                <div>
                    <?php if ($bill['is_payed'] == 0): ?>
                        <button class="payement"><?php echo 'Payer'; ?></button>
                    <?php else: ?>
                        <p style="color: green" class="payee"><?php echo 'Payée'; ?></p>
                    <?php endif; ?>
                </div>
                <button class="toView"><a href="./assets/pdf/<?= $bill['image']; ?>.pdf" target="_blank">Visualiser</a>
                </button>
            </section>
        <?php endforeach; ?>
    </section>
</section>
<?php require_once 'partials/footer.php'; ?>

</body>
</html>