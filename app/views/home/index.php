<link rel="stylesheet" href="../../../public/css/style.css">

<h1>/ Home / Index / Naam</h1>

Naam: <?= $data['name']; ?>

<?php pvd($data['name']); ?>

<?= dirname(__FILE__); ?>



<h1>Requirementanalyse _NAAM_</h1>
<p><hr></p>
<div class="opties"><input type="checkbox" checked disabled> MoSCoW | <input type="checkbox" disabled> FURPS</div>
<p><hr></p>
<div>
    <span class="moscow" style="border-radius: 0.25rem; background-color: red;">Must Have</span>
    <span class="moscow" style="border-radius: 0.25rem; background-color: aqua;">Should Have</span>
    <span class="moscow" style="border-radius: 0.25rem; background-color: orange;">Could Have</span>
    <span class="moscow" style="border-radius: 0.25rem; background-color: gray;">Won't Have</span>
</div>

<p><hr></p>