<div class="moscow-main">
<div class="form-container">
    <h2>MyTasks</h2>
<!-- <p><strong style="color: red;">Geen input in database want diabled voor testing.</strong></p> -->

<style>
    .moscow-main {
        width: 100%;
    }
    .form-container {
        /* background: whitesmoke; */
        padding: 2rem;
        border-radius: 0.25rem;
        width: 100%;
    }

    form {
        background: none;
        padding: 1rem;
    }

    input,
    select,
    button {
        background: whitesmoke;
        font-size: 1rem;
        padding: 0.35rem;
        border-radius: 0.25rem;
        margin: 0.25rem;
    }

    button {
        background-color: #3E4685;
        color: white;
        cursor: pointer;
    }

    form p {
        display: flex;
        flex-direction: column;
        background-color: none;
        font-size: 1rem;
        font-weight: 800;
    }

    .form-required {
        color: red;
        font-size: 0.75rem;
        
    }

</style>

    
    
<?php

for ($i=0; $i < count($project->getRequirements()); $i++) { 
    if($project->getRequirements()[$i]->getUserTaskId() == $_SESSION["userid"]) {
    // pvd($project->getRequirements()[$i]->getName());
    $project->displayRequirementCard($project->getRequirements()[$i]);
    }
}




?>


    </div>



</div>

