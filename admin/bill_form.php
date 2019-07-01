<?php

require('../_tools.php');

if (isset($_POST['save'])) {


    if (!empty($_POST['bill_from']) AND !empty($_POST['amount_due']) AND !empty($_POST['bill_date']) AND !empty($_FILES['image']['name'])) {

        $allowed_extensions = array( 'pdf' );
        $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

        if (in_array($my_file_extension , $allowed_extensions)) {
            $new_file_name = md5(rand());
            $destination = '../assets/pdf/' . $new_file_name . '.' . $my_file_extension;
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);


            $query_insert_bill = $db->prepare('INSERT INTO bills (bill_from, amount_due, bill_date, is_payed, user_id, image) VALUES (?, ?, ?, ?, ?, ?)');
            $result_insert = $query_insert_bill->execute(
                [

                    htmlspecialchars($_POST['bill_from']),
                    htmlspecialchars($_POST['amount_due']),
                    htmlspecialchars($_POST['bill_date']),
                    htmlspecialchars($_POST['is_payed']),
                    $_POST['id'],
                    htmlspecialchars($new_file_name)

                ]
            );

            $message = "Facture ajoutée avec succès !";
            header('location:bill_list.php');
            exit();
        }
        else{
            $error = 'Le fichier ne repond pas aux critères demandés.';
        }
    } else {
        $error = 'Veuillez remplir les champs obligatoires';
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Administration des factures - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>


</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>

    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>


        <section class="col-9">
            <header class="pb-3">
                <h4>Ajouter une facture</h4>
            </header>


            <form action="bill_form.php" method="post" enctype="multipart/form-data">
                <?php if (isset($error)): ?>
                    <div style="color: #CD0018"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if (isset($message)): ?>
                    <div style="color: green"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="bill_from">Facture de : </label>
                    <input class="form-control" type="text" placeholder="" name="bill_from" id="bill_from"
                           value=""/>

                    <?php if (isset($_POST['bill_from']) AND (empty($_POST['bill_from']))) : ?>
                        <div style="color: #CD0018">
                            <?php echo "La provenance est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="bill_date">Date : </label>
                    <input class="form-control" type="date" placeholder="" name="bill_date" id="bill_date"
                           value=""/>

                    <?php if (isset($_POST['bill_date']) AND (empty($_POST['bill_date']))) : ?>
                        <div style="color: #CD0018">
                            <?php echo "La date est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label for="amount_due">Montant : </label>
                    <input class="form-control" type="number" placeholder="" name="amount_due" id="amount_due"
                           value=""/>

                    <?php if (isset($_POST['amount_due']) AND (empty($_POST['amount_due']))) : ?>
                        <div style="color: #CD0018">
                            <?php echo "Le prix est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="image">Image :</label>
                    <input class="form-control" type="file" name="image" id="image" />

                    <?php if (isset($_POST['image']) AND (empty($_POST['image']))) : ?>
                        <div style="color: #CD0018">
                            <?php echo "L'image est obligatoire "; ?></div>
                    <?php endif; ?>
                </div>


                <div class="form-group">
                    <label for="is_payed"> Statut ?</label>
                    <select class="form-control" name="is_payed" id="is_payed">
                        <option selected="selected" value="0">A Payer</option>
                        <option value="1">Payée</option>
                    </select>
                </div>


                <div class="text-right">
                        <!-- Si $user existe, on affiche un lien de mise à jour -->
                        <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                </div>


                <input type="hidden" name="id" value="<?php if (isset($_GET['user_id'])) echo $_GET['user_id']; ?>">

            </form>

        </section>
    </div>

</div>
</body>
</html>