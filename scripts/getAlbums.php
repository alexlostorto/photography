<?php

header('Access-Control-Allow-Origin: http://localhost');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the request method is POST
    getAlbums();
} else {
    // Handle non-POST requests with a 405 status code
    http_response_code(405);
    echo "Method Not Allowed: This endpoint only accepts POST requests.";
    exit();
}

function getAlbums() {
    try {
        // Read the JSON file
        $jsonFile = '../gallery/data.json';
        $data = json_decode(file_get_contents($jsonFile), true);

        $albums = [];

        for ($i = 0; $i < count($data['albums']); $i++) {
            echo '<a href="' . $data['albums'][$i]['url'] . '">
                <img src="' . $data['albums'][$i]['cover'] . '" alt="">
                <div class="overlay">
                    <span>' . $data['albums'][$i]['name'] . '</span>
                </div>
            </a>';
        }
    } catch (Exception $e) {
        // Handle server errors with a 500 status code
        http_response_code(500);
        echo "Server Error: An error occurred while reading the JSON file.";
        exit();
    }
}

?>
