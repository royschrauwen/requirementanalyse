<div>
    <h2>New Requirement</h2>

    <div>
        <form action="#" method="post">
            <label>Project: </label><input type="text" name="projectID" value= "1"><br>
            <label>Requirement: </label><input type="text" name="requirement"><br>

            <select name="priority"><br>
                <option value="1">Must Have</option>
                <option value="2">Should Have</option>
                <option value="3">Could Have</option>
                <option value="4">Won't Have</option>
            </select><br>

            <select name="category"><br>
                <option value="1">Functionality</option>
                <option value="2">Useability</option>
                <option value="3">Reliability</option>
                <option value="4">Performance</option>
                <option value="5">Supportability</option>
            </select><br>

            <!-- Deadline moet default de Project-Deadline zijn -->
            <input type="datetime-local" name="deadline"><br>

        <button submit>Submit</button>
        </form>
    </div>



</div>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $arguments[] = $_POST['requirement'];

    $arguments[] = $_POST['projectID'];
    $arguments[] = $_POST['priority'];
    $arguments[] = $_POST['category'];

    $query = "INSERT INTO `requirements` (`requirement_name`, `projectID`, `priority_id`, `category_id`) VALUES (?, ?, ?, ?)";
    pvd($query);
    pvd($arguments);

    //$project = $db->insert($query, $arguments);
}
?>