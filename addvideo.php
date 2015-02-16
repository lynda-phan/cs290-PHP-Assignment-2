<?php

include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'models/Video.php';

    $videoObject = new Video($pdo);

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $length = filter_input(INPUT_POST, 'length', FILTER_SANITIZE_NUMBER_INT);

    $videoObject->addvideo($name, $category, $length);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <script src="assets/js/main.js"></script>
    </head>
    <body>
        <h1>Add Video</h1>
        <!-- https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Forms_in_HTML#HTML_Syntax_for_Constraint_Validation -->
        <form action="addvideo.php" method="POST">
            <label for="name">Name:</label>
            <input id="name" type="text" name="name" placeholder="Name" required>
            <br/>
            <label for="category">Category:</label>
            <input id="category" type="text" name="category" placeholder="Name" required>
            <br/>
            <label for="length">Length:</label>
            <input id="length" type="number" min="0" name="length" placeholder="Length" required>
            <br/>
            <input type="submit" value="Add">
        </form>
        <br/>
        <p><a class="btn" href="index.php">Back to inventory page</a>
    </body>
</html>