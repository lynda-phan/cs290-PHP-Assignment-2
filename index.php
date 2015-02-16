<?php

include 'includes/db.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Video Inventory Page</title>
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <script src="assets/js/main.js"></script>
    </head>
    <body>
        <table border="5" width="75%" cellpadding="4" cellspacing="3">
            <tr>
                <th colspan="5">
                    <h3><br>Video Inventory Log</h3>
                </th>
            </tr>
                <th>Name</th>
                <th>Category</th>
                <th>Length</th>
                <th>Status</th>
                <th>Action</th>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><button type="delete" value="Delete">Delete</button></td>
            </tr>
        </table>
    </body>
</html>
