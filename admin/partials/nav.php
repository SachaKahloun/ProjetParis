<?php

$query = $db->query('SELECT COUNT(*) FROM faq_questions');
$nbFaq = $query->fetch();

$query = $db->query('SELECT COUNT(*) FROM news');
$nbNews = $query->fetch();

$query = $db->query('SELECT COUNT(*) FROM users');
$nbUsers = $query->fetch();

$query = $db->query('SELECT COUNT(*) FROM bills');
$nbBills = $query->fetch();




?>


<nav class="col-3 py-2 categories-nav">
    <a class="d-block btn btn-warning mb-4 mt-2" href="../index.php">Site</a>
    <ul>
        <li><a href="user_list.php">Gestion des utilisateurs(<?php echo $nbUsers[0]; ?>)</a></li>
        <li><a href="news_list.php">Gestion des actualités (<?php echo $nbNews[0]; ?>)</a></li>
        <li><a href="faq_list.php">Gestion des FAQ (<?php echo $nbFaq [0]; ?>)</a></li>
        <li><a href="bill_list.php">Gestion des factures (<?php echo $nbBills [0]; ?>)</a></li>

    </ul>
</nav>