<?php
require('../_tools.php');

if (isset($_POST['save'])) {

    if (!empty($_POST['title']) AND !empty($_POST['summary']) AND !empty($_POST['content']) AND !empty($_POST['is_publish']) AND !empty($_POST['publish_at']) AND !empty($_FILES['image']['name'])) {


        $query = $db->prepare('INSERT INTO news (title, summary, content, is_publish, publish_at) VALUES (?, ?, ?, ?, NOW())');
        $insertNew = $query->execute(
            [
                htmlspecialchars($_POST['title']),
                htmlspecialchars($_POST['summary']),
                htmlspecialchars($_POST['content']),
                $_POST['is_publish'],

            ]
        );

        //on récupère l'id du dernier enregistrement en base de données (ici l'article inséré ci-dessus)
        $lastInsertedNewId = $db->lastInsertId();


        //redirection après enregistrement
        //si $newArticle alors l'enregistrement a fonctionné
        //if($newArticle){
        if ($insertNew) {

            //upload de l'image si image envoyée via le formulaire
            if (!empty($_FILES['image']['name'])) {
                //tableau des extentions que l'on accepte d'uploader
                $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');
                //extension dufichier envoyé via le formulaire
                $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                //si l'extension du fichier envoyé est présente dans le tableau des extensions acceptées
                if (in_array($my_file_extension, $allowed_extensions)) {

                    //je génrère une chaîne de caractères aléatoires qui servira de nom de fichier
                    //le but étant de ne pas écraser un éventuel fichier ayant le même nom déjà sur le serveur
                    $new_file_name = md5(rand());

                    //destination du fichier sur le serveur (chemin + nom complet avec extension)
                    $destination = '../img/' . $new_file_name . '.' . $my_file_extension;

                    //déplacement du fichier à partir du dossier temporaire du serveur vers sa destination
                    $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    if (!$result) {
                        $message = 'Une erreur est survenue';
                    } else {
                        //mise à jour de l'article enregistré ci-dessus avec le nom du fichier image qui lui sera associé
                        $query = $db->prepare('INSERT INTO medias (img, new_id) VALUES (?, ?) ');
                        $resultImage = $query->execute(
                            [
                                $new_file_name . '.' . $my_file_extension,
                                $lastInsertedNewId
                            ]
                        );
                    }

                }
            }

            //redirection après enregistrement
            header('location:news_list.php');
            exit;
        } else { //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
            $message = "Impossible d'enregistrer la nouvelle actualité...";
        }
    } else {
        $message = 'Veuillez remplir tous les champs obligatoires';
    }
}

if (isset($_POST['update'])) {

    if (!empty($_POST['title']) AND !empty($_POST['summary']) AND !empty($_POST['content']) AND !empty($_POST['is_publish']) AND !empty($_POST['publish_at']) AND !empty($_FILES['image']['name'])) {

        $query = $db->prepare('UPDATE news SET
		title = :title,
		summary = :summary,
		content = :content,
		is_publish = :is_publish,
		publish_at =:publish_at
		WHERE id = :id'
        );

        //mise à jour avec les données du formulaire
        $resultNew = $query->execute([
            'title' => htmlspecialchars($_POST['title']),
            'summary' => htmlspecialchars($_POST['summary']),
            'content' => htmlspecialchars($_POST['content']),
            'is_publish' => $_POST['is_publish'],
            'publish_at' => $_POST['publish_at'],
            'id' => $_POST['id'],
        ]);


        //si enregistrement ok
        if ($resultNew) {
            if (!empty($_FILES['image']['name'])) {

                $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');
                $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                if (in_array($my_file_extension, $allowed_extensions)) {

                    //si un fichier est soumis lors de la mise à jour, je commence par supprimer l'ancien du serveur s'il existe
                    if (isset($_POST['current-image'])) {
                        unlink('../img/' . $_POST['current-image']);
                    }

                    $new_file_name = md5(rand());
                    $destination = '../img/' . $new_file_name . '.' . $my_file_extension;
                    $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                    $query = $db->prepare('DELETE FROM medias WHERE new_id = ?');
                    $result = $query->execute([
                        $_POST['id']
                    ]);

                    $query = $db->prepare('INSERT INTO medias (img, new_id) VALUES (?, ?)');
                    $resultUpdateImage = $query->execute([

                        $new_file_name . '.' . $my_file_extension,
                        $_POST['id']
                    ]);
                }
            }

            header('location:news_list.php');
            exit;
        } else {
            $message = 'Erreur.';
        }

    } else {
        $message = 'Veuillez remplir tous les champs obligatoires';
    }

}

if (isset($_GET['new_id'])) {
    $query_update = $db->prepare('SELECT news.*, medias.img, medias.video
    FROM news
    INNER JOIN medias
    ON news.id = medias.new_id
    WHERE news.id = ?');

    $query_update->execute(array($_GET['new_id']));
    $infoNew = $query_update->fetch();

}

?>

<!DOCTYPE html>
<html>
<head>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>

    <title>Administration des actualités - Mon premier blog !</title>
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
                <h4>Ajouter une actualité</h4>
            </header>

            <!-- Si $user existe, chaque champ du formulaire sera pré-remplit avec les informations de l'utilisateur -->

            <form action="new_form.php" method="post" enctype="multipart/form-data">
                <?php if (isset($message)): ?>
                    <div style="color: #CD0018"><?php echo $message; ?></div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="title">Titre :</label>
                    <textarea class="form-control" type="text" placeholder="Titre" name="title"
                              id="title"><?php if (isset($_GET['new_id'])) echo $infoNew['title'] ?></textarea>

                    <?php if (isset($_POST['title']) AND (empty($_POST['title']))) : ?>
                        <div style="color: #CD0018"><?php echo "Le titre est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="summary">Résumé : </label>
                    <textarea class="form-control" type="text" placeholder="Résumé" name="summary"
                              id="summary"><?php if (isset($_GET['new_id'])) echo $infoNew['summary'] ?></textarea>

                    <?php if (isset($_POST['summary']) AND (empty($_POST['summary']))) : ?>
                        <div style="color: #CD0018"><?php echo "Le résumé est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label for="content">Contenu : </label>
                    <textarea class="form-control" type="text" placeholder="Contenu" name="content"
                              id="content"><?php if (isset($_GET['new_id'])) echo $infoNew['content'] ?></textarea>

                    <?php if (isset($_POST['content']) AND (empty($_POST['content']))) : ?>
                        <div style="color: #CD0018"><?php echo "Le contenu est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label for="image">Image :</label>
                    <input class="form-control" type="file" name="image" id="image"/>
                    <?php if (isset($_GET['new_id']) && $infoNew['img']): ?>
                        <img class="img-fluid py-4" src="../img/<?= $infoNew['img']; ?>" alt=""/>
                        <input type="hidden" name="current-image" value="<?= $infoNew['img']; ?>"/>
                    <?php endif; ?>


                    <?php if (isset($_FILES['image']) AND (empty($_FILES['image']))) : ?>
                        <div style="color: #CD0018">
                            <?php echo "L'image est obligatoire "; ?></div>
                    <?php endif; ?>
                </div>


                <div class="form-group">
                    <label for="publish_at">Date de publication : </label>
                    <input class="form-control" type="date" placeholder="" name="publish_at" id="publish_at"
                           value="<?php if (isset($_GET['new_id'])) echo $infoNew['publish_at'] ?>"/>

                    <?php if (isset($_POST['publish_at']) AND (empty($_POST['publish_at']))) : ?>
                        <div style="color: #CD0018"><?php echo "La date de publication est obligatoire "; ?></div>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label for="is_publish"> Publié ?</label>
                    <select class="form-control" name="is_publish" id="is_publish">
                        <?php if ($infoNew['is_publish'] == 1): ?>
                            <option value="0">Non</option>
                            <option selected="selected" value="1">Oui</option>
                        <?php else : ?>
                            <option selected="selected" value="0">Non</option>
                            <option value="1">Oui</option>
                        <?php endif; ?>
                    </select>
                </div>


                <div class="text-right">
                    <?php if (isset($_GET['new_id'])): ?>
                        <input class="btn btn-success" type="submit" name="update" value="Mettre à jour"/>
                    <?php else: ?>
                        <!-- Si $user existe, on affiche un lien de mise à jour -->
                        <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                    <?php endif; ?>
                </div>


                <!-- Si $user existe, on ajoute un champ caché contenant l'id de l'utilisateur à modifier pour la requête UPDATE -->
                <input type="hidden" name="id" value="<?php if (isset($_GET['new_id'])) echo $infoNew['id']; ?>">

            </form>

        </section>
    </div>

</div>
</body>
</html>
