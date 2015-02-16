<!DOCTYPE html>
<html>
    <head>
        <title>Add Video</title>
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <script src="assets/js/main.js"></script>
    </head>
    <body>
        <h1>Add Video</h1>
        <form action="addvideo.php" method="POST">
            <label for="name">Name:</label>
            <input id="name" type="text" name="name" placeholder="Name" required>
            <br/>
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="" selected="selected">Select a category</option>
                <option value="action">Action</option>
                <option value="comedy">Comedy</option>
                <option value="drama">Drama</option>
                <option value="kids">Kids</option>
                <option value="romance">Romance</option>
                <option value="suspense">Suspense</option>
            </select>
            <br/>
            <label for="length">Length:</label>
            <input id="length" type="number" name="length" placeholder="Length" required>
            <br/>
            <input type="submit" value="Add">
        </form>
        <br/>
        <p><a href="index.php">Back</a>
    </body>
</html>