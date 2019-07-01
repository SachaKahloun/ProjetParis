<?php require './assets/header.php'; ?>

<link rel="stylesheet" href="./css/datepicker.css">
<section class="imgUp">
    <div class="forTitleUp">
        <span class="pageHomeEvent">Événements</span>
    </div>
</section>

<h1 class="eventPages">Nos événements</h1>
<div class="dateSelected"></div>

<section class="eventContainer">
<div class="secondContainer">
    <div id="calendar2">
        <div id="calendar1-wrapper2"></div>
        <span class="calendar2-msg"></span>
    </div>
</div>
<section class="forEvents"></section>
</section>
<div class="onMap">
    <div class="forCloser">
        <span class="closerOnMap">
            <i class="fas fa-times"></i>
        </span>
    </div>
    <div class="insideOnMap">
        <div class="insideLeft">
            <img class="imgOnMap">
            <div class="titleOnMap">Mairie</div>
            <div class="adrressOnMap">12 rie fvzs ko,</div>
        </div>
        <div class="insideRight"></div>
    </div>

</div>
<script src="./js/datepicker.js"></script>


<?php require './assets/footer.php'; ?>
