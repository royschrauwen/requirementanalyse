<div class="moscow-main">
<div class="form-container">
    <h2>New Requirement</h2>
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

    
        <form action="#" method="post">



            <p>
            <label for="form-add-requirement">Requirement<sup class="form-required">*</sup>: </label>
            <input type="text" id="form-add-requirement" class="form-add-requirement" name="form-add-requirement" title="What requirement do you want to add?" required="required" aria-required="true" placeholder="New Requirement">
            </p>

            <p>
            <label for="form-add-priority">Priority<sup class="form-required">*</sup>: </label>
            <select name="priority">
                <option value="1">Must Have</option>
                <option value="2">Should Have</option>
                <option value="3">Could Have</option>
                <option value="4">Won't Have</option>
            </select>
            </p>

            <p>
            <label for="form-add-category">Category<sup class="form-required">*</sup>: </label>
            <select name="category">
                <option value="1">Functionality</option>
                <option value="2">Useability</option>
                <option value="3">Reliability</option>
                <option value="4">Performance</option>
                <option value="5">Supportability</option>
            </select>
            </p>

            <p>
            <label for="form-add-deadline">Deadline: </label>
            <!-- Deadline moet default de Project-Deadline zijn -->
            <input type="datetime-local" name="deadline">
            </p>

        <button submit>Add new requirement</button>
        </form>
    </div>



</div>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $arguments[] = $_POST['form-add-requirement'];

    $arguments[] = $project->getId();
    $arguments[] = $_POST['priority'];
    $arguments[] = $_POST['category'];

    $query = "INSERT INTO `requirements` (`requirement_name`, `project_id`, `priority_id`, `category_id`) VALUES (?, ?, ?, ?)";
    //pvd($query);
    pvd($arguments);

    $project->getDatabase()->insert($query, $arguments);
}   
?>