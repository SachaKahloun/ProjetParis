<?php
require('../_tools.php');

$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : NULL;
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$address = isset($_POST['address']) ? $_POST['address'] : NULL;

if (isset($_POST['save'])) {

    if (!empty($_POST['firstname']) AND !empty($_POST['lastname']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['address']) AND !empty($_POST['zip_code']) AND !empty($_POST['city']) AND !empty($_POST['phone_number'])) {

        $query_connection = $db->prepare('SELECT email FROM users WHERE email = :email'); // :c moi qui donnele nom et ca correspond en dessous a query_connection
        $query_connection->execute(
            [

                'email' => htmlspecialchars($_POST['email']),

            ]
        );

        $result_connection = $query_connection->fetch();

        if (isset($result_connection) AND $result_connection) {
            $error = "Cette adresse mail existe déjà";
        } else {
            $query_insert = $db->prepare('INSERT INTO users (firstname, lastname, phone_number, password, email, is_admin, address, zip_code, city ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $result_insert = $query_insert->execute(
                [

                    htmlspecialchars($_POST['firstname']),
                    htmlspecialchars($_POST['lastname']),
                    htmlspecialchars($_POST['phone_number']),
                    md5($_POST['password']),
                    htmlspecialchars($_POST['email']),
                    htmlspecialchars($_POST['is_admin']),
                    htmlspecialchars($_POST['address']),
                    htmlspecialchars($_POST['zip_code']),
                    htmlspecialchars($_POST['city']),

                ]
            );
            $message = "Utilisateur ajouté avec succès !";

            $firstname = null;
            $lastname = null;
            $email = null;
            $address = null;

            header('location:user_list.php');
            exit();
        }
    } else {
        $error = "Impossible d'ajouter, veuillez remplir les champs obligatoires.";
    }
}

if (isset($_GET['user_id'])) {
    $query_update = $db->prepare('SELECT * FROM users WHERE id = ?');
    $query_update->execute(array($_GET['user_id']));

    $infoUser = $query_update->fetch();
}

if (isset($_POST['update'])) {


    if (!empty($_POST['firstname']) AND !empty($_POST['lastname']) AND !empty($_POST['email']) AND !empty($_POST['address']) AND !empty($_POST['zip_code']) AND !empty($_POST['city']) AND !empty($_POST['phone_number'])) {

        $queryString = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, is_admin = :is_admin, address = :address, zip_code = :zip_code, city = :city, phone_number = :phone_number ';
        //début du tableau de paramètres de la requête de mise à jour
        $queryParameters = [
            'firstname' => htmlspecialchars($_POST['firstname']),
            'lastname' => htmlspecialchars($_POST['lastname']),
            'email' => htmlspecialchars($_POST['email']),
            'is_admin' => htmlspecialchars($_POST['is_admin']),
            'address' => htmlspecialchars($_POST['address']),
            'zip_code' => htmlspecialchars($_POST['zip_code']),
            'city' => htmlspecialchars($_POST['city']),
            'phone_number' => htmlspecialchars($_POST['phone_number']),
            'id' => $_POST['id']
        ];

        if (!empty($_POST['password'])) {
            //concaténation du champ password à mettre à jour
            $queryString .= ', password = :password ';
            //ajout du paramètre password à mettre à jour
            $queryParameters['password'] = hash('md5', $_POST['password']);
        }

        //fin de la chaîne de caractères de la requête de mise à jour
        $queryString .= 'WHERE id = :id';
        /*print_r($queryString);
        die();*/

        //préparation et execution de la requête avec la chaîne de caractères et le tableau de données
        $query = $db->prepare($queryString);
        $result = $query->execute($queryParameters);

        $message = 'Succés';

        if ($result) {
            $message = 'Utilisateur modifié avec succès.';
            header('location: user_list.php');
            exit;
        } else {
            $message = 'Erreur.';
        }
    }

}

if (isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $query = $db->prepare('SELECT * FROM users WHERE id = ?');
    $query->execute(array($_GET['user_id']));
    //$user contiendra les informations de l'utilisateur dont l'id a été envoyé en paramètre d'URL
    $user = $query->fetch();

}

?>


<!DOCTYPE html>
<html>
<head>

    <title>Administration des utilisateurs - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>


</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>


        <section class="col-9">
            <header class="pb-3">
                <!-- Si $user existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                <h4>Ajouter un utilisateur</h4>
            </header>

            <!-- Si $user existe, chaque champ du formulaire sera pré-remplit avec les informations de l'utilisateur -->

            <form action="user_form.php" method="post">
                <?php if (isset($error)): ?>
                    <div style="color: #CD0018"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="firstname">Prénom :</label>
                    <input class="form-control" type="text" placeholder="Prénom" name="firstname" id="firstname"
                           value="<?php if (isset($_GET['user_id'])) echo $infoUser['firstname'] ?>"/>

                    <?php if (isset($_POST['firstname']) AND (empty($_POST['firstname']))) : ?>
                        <div style="color: #CD0018"><?php echo "Le prénom est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="lastname">Nom de famille : </label>
                    <input class="form-control" type="text" placeholder="Nom de famille" name="lastname" id="lastname"
                           value="<?php if (isset($_GET['user_id'])) echo $infoUser['lastname'] ?>"/>

                    <?php if (isset($_POST['lastname']) AND (empty($_POST['lastname']))) : ?>
                        <div style="color: #CD0018"><?php echo "Le nom de famille est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label for="phone_number">Numéro de téléphone : </label>
                    <input class="form-control" type="number" placeholder="Numéro de téléphone" name="phone_number"
                           id="phone_number"
                           value="<?php if (isset($_GET['user_id'])) echo $infoUser['phone_number'] ?>"/>

                    <?php if (isset($_POST['phone_number']) AND (empty($_POST['phone_number']))) : ?>
                        <div style="color: #CD0018"><?php echo "Le numéro de téléphone est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="address">Adresse : </label>
                    <input class="form-control" type="text" placeholder="Adresse" name="address" id="address"
                           value="<?php if (isset($_GET['user_id'])) echo $infoUser['address'] ?>"/>

                    <?php if (isset($_POST['address']) AND (empty($_POST['address']))) : ?>
                        <div style="color: #CD0018"><?php echo "L'adresse est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label for="zip_code">Code postal : </label>
                    <input class="form-control" type="number" placeholder="Code postal" name="zip_code" id="zip_code"
                           value="<?php if (isset($_GET['user_id'])) echo $infoUser['zip_code'] ?>"/>

                    <?php if (isset($_POST['zip_code']) AND (empty($_POST['zip_code']))) : ?>
                        <div style="color: #CD0018"><?php echo "Le code postal est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="zip_code">Ville : </label>
                    <input class="form-control" type="text" placeholder="Ville" name="city" id="city"
                           value="<?php if (isset($_GET['user_id'])) echo $infoUser['city'] ?>"/>

                    <?php if (isset($_POST['city']) AND (empty($_POST['city']))) : ?>
                        <div style="color: #CD0018"><?php echo "Le nom de la ville est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input class="form-control" type="email" placeholder="Email" name="email" id="email"
                           value="<?php if (isset($_GET['user_id'])) echo $infoUser['email'] ?>"/>

                    <?php if (isset($_POST['email']) AND (empty($_POST['email']))) : ?>
                        <div style="color: #CD0018"><?php echo "L'email est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="password">Mot de passe ( uniquement si vous souhaitez modifier le mot de passe actuel )
                        : </label>
                    <input class="form-control" type="password" placeholder="Mot de passe" name="password"
                           id="password"/>

                    <?php if (isset($_POST['password']) AND (empty($_POST['password']))) : ?>
                        <div style="color: #CD0018"><?php echo "Le mot de passe est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>


                <div class="form-group">
                    <label for="is_admin"> Admin ?</label>
                    <select class="form-control" name="is_admin" id="is_admin">
                        <?php if ($infoUser['is_admin'] == 1): ?>
                            <option value="0">Non</option>
                            <option selected="selected" value="1">Oui</option>
                        <?php else : ?>
                            <option selected="selected" value="0">Non</option>
                            <option value="1">Oui</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="text-right">
                    <?php if (isset($_GET['user_id'])): ?>
                        <input class="btn btn-success" type="submit" name="update" value="Mettre à jour"/>
                    <?php else: ?>
                        <!-- Si $user existe, on affiche un lien de mise à jour -->
                        <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                    <?php endif; ?>
                </div>


                <!-- Si $user existe, on ajoute un champ caché contenant l'id de l'utilisateur à modifier pour la requête UPDATE -->
                <input type="hidden" name="id" value="<?php if (isset($_GET['user_id'])) echo $infoUser['id']; ?>">

            </form>

        </section>
    </div>

</div>
</body>
</html>