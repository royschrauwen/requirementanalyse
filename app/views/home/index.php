<link rel="stylesheet" href="./style.css">

<h1>RA</h1>

Naam: <?= $data['name']; ?>

<?php pvd($data['name']); ?>

<?php echo dirname(__FILE__) . '\\' . basename(__FILE__); ?>



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