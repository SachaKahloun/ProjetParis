<?php require_once('_tools.php');

if (isset($_POST['login'])) {

    if (!empty($_POST['email']) AND !empty($_POST['password'])) {

        $query_user = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
        $query_user->execute(array($_POST['email'], md5($_POST['password'])));
        $result_user = $query_user->fetch();


        print_r($result_user);

        if ($result_user) {
            $_SESSION['user'] = $result_user;

            header('location:espace_personnel.php');
            exit();
        } else {
            $message = 'Email ou mot de passe incorrect.';
        }
    } else {
        $message = 'Veuillez remplir tous les champs obligatoires.';

    }

} else {
    $email = NULL;
    $password = NULL;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('location:index.php');
}


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

    <title>Connexion</title>
</head>
<body>
<?php require_once 'partials/header.php' ?>

<section class="container">
    <div class="generaleAll">
        <p class="presentation">Un seul compte pour tout gérer</p>
    </div>
</section>
<section class="compte">
    <h1><i class="fas fa-user logocompte"></i>Mon compte</h1>
</section>
<section class="center">
    <section class="secondCenter">
        <form method="post" class="formConnexion">
            <div class="thirdCenter">
                <label for="inputLogin" class="login">Identifiant(obligatoire)</label>
                <input type="text" id="inputLogin" name="email" placeholder="" value="" class="inputConnexion">
            </div>
            <div class="thirdCenter">
                <label for="inputMdp" class="mdp">Mot de passe(obligatoire)</label>
                <input type="password" id="inputMdp" name="password" placeholder="" value="" class="inputConnexion">
            </div>
            <div class="button">
                <button name="login" class="btn">Connexion</button>
            </div>
            <div style="color: #CD0018">
                <?php if (isset($message)): ?>
                    <?php echo $message; ?>
                <?php endif; ?>
            </div>
        </form>
    </section>
</section>
<?php require_once 'partials/footer.php'; ?>

</body>
</html>