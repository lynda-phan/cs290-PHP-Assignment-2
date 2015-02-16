<?php

include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require 'models/Video.php';

    $videoObject = new Video($pdo);

    // http://php.net/manual/en/function.filter-input.php
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    switch ($_GET['action']) {
        case "toggleRented":
            $video = $videoObject->getVideo($id);

            if ($video['rented']) {
                $videoObject->checkInVideo($id);
            } else {
                $videoObject->checkOutVideo($id);
            }

            break;
        case "deleteVideo":
            $videoObject->deleteVideo($id);
            break;

        case "deleteAllVideos":
            $videoObject->deleteAllVideos();
            break;
    }
}

header('Location: index.php');
exit;