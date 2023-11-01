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
            if ($data['albums'][$i]['privacy'] === 'public') {
                echo '<a href="' . $data['albums'][$i]['url'] . '">
                    <img src="' . $data['albums'][$i]['cover'] . '" alt="">
                    <div class="overlay">
                        <span>' . $data['albums'][$i]['name'] . '</span>
                    </div>
                </a>';
            } else {
                echo '<a href="' . $data['albums'][$i]['url'] . '">
                    <img src="' . $data['albums'][$i]['cover'] . '" alt="">
                    <svg width="53" height="66" viewBox="0 0 53 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.6813 0.242432C17.503 0.242432 10.0859 7.65957 10.0859 16.8378V23.7525H4.55412C2.27982 23.7525 0.405273 25.6271 0.405273 27.9014V61.0921C0.405273 63.3664 2.27982 65.241 4.55412 65.241H48.8084C51.0827 65.241 52.9573 63.3664 52.9573 61.0921V27.9014C52.9573 25.6271 51.0827 23.7525 48.8084 23.7525H43.2766V16.8378C43.2766 7.65957 35.8595 0.242432 26.6813 0.242432ZM26.6813 3.00833C34.3793 3.00833 40.5108 9.13976 40.5108 16.8378V23.7525H12.8518V16.8378C12.8518 9.13976 18.9832 3.00833 26.6813 3.00833ZM4.55412 26.5184H48.8084C49.5755 26.5184 50.1914 27.1343 50.1914 27.9014V61.0921C50.1914 61.8592 49.5755 62.4751 48.8084 62.4751H4.55412C3.78701 62.4751 3.17117 61.8592 3.17117 61.0921V27.9014C3.17117 27.1343 3.78701 26.5184 4.55412 26.5184ZM26.6813 37.582C24.3313 37.582 22.5324 39.3809 22.5324 41.7309C22.5324 42.9734 23.0835 44.0646 23.9154 44.7561V48.6456C23.9154 50.169 25.1579 51.4115 26.6813 51.4115C28.2047 51.4115 29.4472 50.169 29.4472 48.6456V44.7561C30.2791 44.0646 30.8301 42.9734 30.8301 41.7309C30.8301 39.3809 29.0312 37.582 26.6813 37.582Z" fill="white"/>
                    </svg>
                    <div class="overlay">
                        <span>' . $data['albums'][$i]['name'] . '</span>
                    </div>
                </a>';
            }
        }
    } catch (Exception $e) {
        // Handle server errors with a 500 status code
        http_response_code(500);
        echo "Server Error: An error occurred while reading the JSON file.";
        exit();
    }
}

?>
