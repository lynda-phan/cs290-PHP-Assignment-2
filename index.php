<?php

include 'includes/db.php';

require 'models/Video.php';

$category_selection = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);

if (empty($category_selection)) {
    $category_selection = 'all';
}

$videoObject = new Video($pdo);
$videos = $videoObject->getAllVideos($category_selection);
$categories = $videoObject->getAllCategories();

function makeSelected($category, $category_selection)
{
    if ($category == $category_selection) {
        echo "selected";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Video Inventory Page</title>
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <script src="assets/js/main.js"></script>
    </head>
    <body>
        <p>Category Filter:</p>
        <p>
            <select id="category_selection" name="category_selection">
                <option value="all">all</option>
                <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category; ?>" <?php makeSelected($category, $category_selection); ?>><?php echo $category; ?></option>
                <?php } ?>
            </select>
        </p>
        <table border="5" width="75%" cellpadding="4" cellspacing="3">
            <tr>
                <th colspan="5">
                    <h3><br>Video Inventory Log</h3>
                </th>
            </tr>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Length</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($videos as $video) { ?>
            <tr>
                <td><?php echo $video['name']; ?></td>
                <td><?php echo $video['category']; ?></td>
                <td><?php echo $video['length']; ?></td>
                <td align="center"><a class="btn btn-toggle" href="managevideos.php?id=<?php echo $video['id']; ?>&action=toggleRented"><?php echo $video['rentedLabel']; ?></td>
                <td align="center"><a class="btn btn-delete confirmationAlert" href="managevideos.php?id=<?php echo $video['id']; ?>&action=deleteVideo">Delete</a></td>
            </tr>
            <?php } ?>
        </table>
        <p>
            <a href="addvideo.php" class="btn">Add a video</a>
            <a href="managevideos.php?action=deleteAllVideos" class=" btn btn-delete confirmationAlert">Delete all videos</a>
        </p>
    </body>
</html>