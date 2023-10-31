<?php

header('Access-Control-Allow-Origin: http://localhost');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the request method is POST
    $themes = getGallery();

    for ($i = 0; $i < count($themes); $i++) {
        echo '<div class="images-container">';
        for ($j = 0; $j < count($themes[$i]); $j++) {
            echo '<img src="' . $themes[$i][$j] . '" alt="">';
        }
        echo '</div>';
    }
} else {
    // Handle non-POST requests with a 405 status code
    http_response_code(405);
    echo "Method Not Allowed: This endpoint only accepts POST requests.";
    exit();
}

function getGallery() {
    try {
        // Read the JSON file
        $jsonFile = '../gallery/data.json';
        $data = json_decode(file_get_contents($jsonFile), true);

        $themes = [];

        for ($i = 0; $i < count($data['home']['themes'][0]['images']); $i++) {
            $images = [];

            for ($j = 0; $j < count($data['home']['themes']); $j++) {
                array_push($images, $data['home']['themes'][$j]['images'][$i]);
            }

            array_push($themes, $images);
        }

        return $themes;
    } catch (Exception $e) {
        // Handle server errors with a 500 status code
        http_response_code(500);
        echo "Server Error: An error occurred while reading the JSON file.";
        exit();
    }
}

?>
