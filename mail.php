<?php
function mailTo($destination){
    $mail = $destination; // Déclaration de l'adresse de destination.
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }
//=====Déclaration des messages au format texte et au format HTML.
        $message_txt = "Bonjour, votre message nous a bien été transmis. Celui-ci sera traité dans les plus brefs délais. Merci de votre confiance.";
        $message_html = "<html><head></head><body>Bonjour,<br>votre message nous a bien été transmis. Celui-ci sera traité dans les plus brefs délais.<br>Merci de votre confiance.</body></html>";

//==========

//=====Création de la boundary
    $boundary = "-----=".md5(rand());
//==========

//=====Définition du sujet.
    $sujet = "Cher Parisien";
//=========

//=====Création du header de l'e-mail.
    $header = "From: \"Ville de Paris\"<contact@sachakahloun.fr>".$passage_ligne;
    $header.= "Reply-to: \"Client\" <$destination>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
    $message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
//==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========

//=====Envoi de l'e-mail.
    return mail($mail,$sujet,$message,$header);
//==========
}
?>